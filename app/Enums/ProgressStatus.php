<?php

namespace App\Enums;

enum ProgressStatus: string
{
    case IN_PROGRESS = 'in_progress';
    case COMPLETED = 'completed';
    case NOT_STARTED = 'not_started';
}
