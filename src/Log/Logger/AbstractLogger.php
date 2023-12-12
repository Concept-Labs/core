<?php
namespace Cl\Log\Logger;

use Cl\Log\Logger\LoggerInterface;
use Cl\Log\LogLevelEnum;

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