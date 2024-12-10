<?php

namespace Guava\Onboarding\Filament;

use Closure;
use Filament\Facades\Filament;
use Filament\Panel;
use Filament\Support\Concerns\Configurable;
use Filament\Support\Concerns\EvaluatesClosures;
use Guava\Onboarding\Collections\StepCollection;
use Guava\Onboarding\Concerns\HasDescription;
use Guava\Onboarding\Concerns\HasId;
use Guava\Onboarding\Concerns\HasLabel;
use Guava\Onboarding\ValueObjects\ContentData;
use Illuminate\Support\Str;
use Livewire\Livewire;
use Livewire\Wireable;

class Scenario implements Wireable
{
    use Configurable;
    use EvaluatesClosures;
    use HasDescription;
    use HasId;
    use HasLabel;

    protected StepCollection $steps;

    protected string $prefix = 'onboarding';

    protected bool | Closure $completed = false;

    protected bool | Closure $requiresCompletion = false;

    protected ?ContentData $widgetContent = null;

    protected ?ContentData $alertContent = null;

    public function widgetContent(ContentData $content): static
    {
        $this->widgetContent = $content;

        return $this;
    }

    public function alertContent(ContentData $content): static
    {
        $this->alertContent = $content;

        return $this;
    }

    public function getWidgetContent(): ?ContentData
    {
        return $this->evaluate($this->widgetContent) ?? $this->getDefaultContent();
    }

    public function getAlertContent(): ?ContentData
    {
        return $this->evaluate($this->alertContent) ?? $this->getDefaultContent();
    }

    protected function getDefaultContent(): ContentData
    {
        return (new ContentData)
            ->label($this->getLabel())
            ->description($this->getDescription())
        ;
    }

    public function __construct()
    {
        $this->steps = new StepCollection;
    }

    public function prefix(string $prefix)
    {
        $this->prefix = $prefix;

        return $this;
    }

    public function getPrefix(): string
    {
        return $this->prefix;
    }

    public function steps(array $steps): static
    {
        $this->steps = new StepCollection($steps);

        return $this;
    }

    public function getSteps(): StepCollection
    {
        return $this->steps;
    }

    public static function make(): static
    {
        return app(static::class)
            ->completed(function(Scenario $scenario) {
                foreach ($scenario->getSteps() as $step) {
                    if (!$step::isCompleted()) {
                        return false;
                    }
                }
                return true;
            })
            ->configure()
        ;
    }

    public function registerRoutes(Panel $panel)
    {
        $panel->authenticatedTenantRoutes(function () {
            \Route::get($this->prefix . '/{scenario}', function (Scenario $scenario) {
                return redirect($scenario->getSteps()->first()::getUrl([
                    'scenario' => $scenario,
                ]));
            })
                ->name($this->prefix . '.' . $this->getId())
            ;
        });

        foreach ($this->getSteps() as $step) {
            $panel->authenticatedTenantRoutes(function () use ($step) {
                \Route::get($this->prefix . '/{scenario}/' . $step::getRoutePath(), $step)
                    ->name($this->prefix . '.' . $this->getId() . '.' . $step::getRouteName())
                ;
            });

            Livewire::component($this->getId() . '-' . class_basename($step), $step);
        }
    }

    public function resolveRouteBinding($value, $field = null)
    {
        if ($value instanceof Scenario) {
            return $value;
        }

        $scenario = filament('guava-onboarding')->getCachedScenario($value);

        return $scenario;
    }

    public function toLivewire()
    {
        return ['id' => $this->getId()];
    }

    public static function fromLivewire($value)
    {
        return filament('guava-onboarding')->getCachedScenario(
            data_get($value, 'id')
        );
    }

    public function getStepOrder(Onboard $step)
    {
        return array_search($step::class, $this->getSteps()->values()->all());
    }

    public function getTotalSteps()
    {
        return count($this->getSteps());
    }

    public function getLabel(): string
    {
        return $this->label ?? Str::headline($this->id);
    }

    public function completed(bool | Closure $closure = true): static
    {
        $this->completed = $closure;

        return $this;
    }

    public function isCompleted()
    {
        return $this->evaluate($this->completed, [
            'scenario' => $this,
        ]);
    }

    public function __toString(): string
    {
        return $this->getId();
    }

    public function getRoute()
    {
        return Filament::getCurrentPanel()->generateRouteName('onboarding.' . $this->getId());
    }

    public function getUrl()
    {
        $panel = Filament::getCurrentPanel();

        $parameters = [
            'scenario' => $this,
        ];

        if ($panel->hasTenancy()) {
            $parameters['tenant'] = Filament::getTenant();
        }

        return Filament::getCurrentPanel()->route('onboarding.' . $this->getId(), $parameters);
    }

    public function requiresCompletion(bool | Closure $closure = true): static
    {
        $this->requiresCompletion = $closure;

        return $this;
    }

    public function isCompletionRequired(): bool
    {
        return $this->evaluate($this->requiresCompletion);
    }
}
