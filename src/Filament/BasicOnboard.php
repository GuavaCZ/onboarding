<?php

namespace Guava\Onboarding\Filament;

use Filament\Forms\Form;
use Filament\Support\Concerns\EvaluatesClosures;
use Guava\Onboarding\Concerns\HasContent;
use Guava\Onboarding\Concerns\HasDescription;
use Guava\Onboarding\Concerns\HasLabel;

abstract class BasicOnboard extends Onboard
{
    use EvaluatesClosures;
    use HasContent;
    use HasDescription;
    use HasLabel;

    protected static string $view = 'guava-onboarding::steps.basic';

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
}
