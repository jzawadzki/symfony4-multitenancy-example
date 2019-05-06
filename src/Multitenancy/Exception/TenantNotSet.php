<?php declare(strict_types = 1);


namespace App\Multitenancy\Exception;

use Throwable;

class TenantNotSet extends \Exception
{
    public function __construct($message = "Tenant not set", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
