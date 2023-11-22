<?php
namespace Cl\Core\Log\Logger;

use Cl\Core\Log\Logger\LoggerInterface;
use Cl\Core\Log\LogLevelEnum;

abstract class AbstractLogger 
    implements 
        LoggerInterface, 
        LoggerNotifyInterface, 
        LoggerInterpolateInterface
{
    use LoggerTrait;
    use LoggerInterpolateTrait;
    use LoggerNotifyTrait;
}