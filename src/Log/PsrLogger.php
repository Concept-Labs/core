<?pphp
namespace Cl\Log;

class PsrLogger extends \Psr\Log\AbstractLogger
{
    public function log($level, string|\Stringable $message, array $context = []): void
    {
        echo $message;
    }

}