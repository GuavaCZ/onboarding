<?php

namespace Guava\Onboarding\Filament;

use Filament\Forms\Form;
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

    public static string | Alignment $formActionsAlignment = Alignment::Right;

    protected static string $view = 'guava-onboarding::steps.form';

    public array $data = [];

    public function mount()
    {
        parent::mount();
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form->statePath('data');
    }

    public function getNextStepAction()
    {
        return parent::getNextStepAction()
            ->action($this->submitAction(...))
        ;
    }

    abstract public function submitAction(array $data): void;
}
