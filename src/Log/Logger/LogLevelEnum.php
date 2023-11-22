<?php

namespace Cl\Core\Log\Logger;

use Cl\Core\Enum\EnumJsonSerializableTrait;

enum LogLevelEnum: string
{
    use EnumJsonSerializableTrait;
    case EMERGENCY = 'emergency';
    case ALERT = 'ALERT';
    case CRITICAL = 'CRITICAL';
    case ERROR = 'ERROR';
    case WARNING = 'WARNING';
    case NOTICE = 'NOTICE';
    case INFO = 'INFO';
    case DEBUG = 'DENBUG';
}