<?php

namespace Guava\Onboarding\Enums;

enum ProgressState: string
{
    case Previous = 'previous';
    case Current = 'current';
    case Next = 'next';
}
