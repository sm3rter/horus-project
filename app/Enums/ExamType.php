<?php

namespace App\Enums;

enum ExamType: string
{
    case FORM = 'form';
    case DRAWING = 'drawing';
    case WRITTEN = 'written';
}
