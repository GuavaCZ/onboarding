<?php

namespace Guava\Onboarding\Filament;

use Filament\Actions\Action;
use Filament\Support\Components\ViewComponent;
use Filament\Support\Concerns\Configurable;
use Filament\Support\Concerns\EvaluatesClosures;
use Guava\Onboarding\Concerns\HasContent;
use Guava\Onboarding\Concerns\HasDescription;
use Guava\Onboarding\Concerns\HasLabel;
use Guava\Onboarding\Concerns\HasPrompt;
use Guava\Onboarding\Facades\Onboarding;
use Livewire\Wireable;

class Step extends ViewComponent implements Wireable
{
    use Configurable;
    use EvaluatesClosures;
    use HasLabel;
    use HasDescription;
    use HasContent;

    protected Scenario $scenario;


    public function id(string $id) {
        $this->id = $id;
        return $this;
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function scenario(Scenario $scenario) {
        $this->scenario = $scenario;
        return $this;
    }

    public function getScenario() {
        return $this->scenario;
    }

    public function __construct(
        protected ?string $id = null
    )
    {
    }

//    public static string $scenario;

    public static function make(string $id = null): static
    {
        return app(static::class, [
            'id' => $id,
        ])
            ->configure()
        ;
    }

    public function resolveRouteBinding(mixed $value)
    {
        if ($value instanceof Step) {
            return $value;
        }

        $step = Onboarding::findStep($value);

        if (! $step) {
            return null;
        }

        $step->id = $value;
        Onboarding::setStep($step);
        Onboarding::setScenario($step->getScenario());

        return $step;
    }

    public function toLivewire()
    {
        return [];
    }

    public static function fromLivewire($value)
    {
        return app(static::class);
    }

    public function getOrder(): int
    {
        $index = 0;
        foreach (Onboarding::getScenario()->getSteps() as $step) {
            if ($step->getId() === $this->getId()) {
                break;
            }
            $index++;
        }
        return $index;
    }

    public function getFormActions() {
        return [
            $this->getNextStepAction(),
        ];
    }

    public function getNextStepAction() {
        return Action::make('next')
            ->label('Next')
            ->hidden(! $this->getScenario()->getNextStep())
            ->url($this->getScenario()->getNextStep()?->getUrl());
    }

    public function getUrl() {
        return Prompt::getUrl([
            'step' => $this,
        ]);
    }

    public function __toString(): string
    {
        return $this->id;
    }
}
