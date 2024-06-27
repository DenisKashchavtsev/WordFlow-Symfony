<?php

namespace App\Words\Domain\Aggregate;

enum LearningStep: int
{
    case MATCH_TRANSLATION = 1;

    case CHOOSE_CORRECT_OPTION = 2;

    case CHOOSE_LETTERS = 3;

    case WRITE = 4;
}