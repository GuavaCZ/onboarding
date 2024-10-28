<?php

namespace Guava\Onboarding\Filament;

use Filament\Forms\Form;
use Filament\Pages\Concerns\InteractsWithFormActions;
use Filament\Support\Concerns\EvaluatesClosures;
use Filament\Support\Enums\Alignment;
use Guava\Onboarding\Concerns\HasContent;
use Guava\Onboarding\Concerns\HasDescription;
use Guava\Onboarding\Concerns\HasLabel;

abstract class FormOnboard extends Onboard
{
    use EvaluatesClosures;
    use HasContent;
    use HasDescription;
    use HasLabel;

    protected static string $view = 'guava-onboarding::steps.form';

    public function mount(): void
    {
        parent::mount();
        $this->form->fill();
    }

    public function getNextStepAction()
    {
        return parent::getNextStepAction()
            ->url(null)
            ->action($this->submitAction(...))
        ;
    }

    abstract public function submitAction(array $data): void;
}
