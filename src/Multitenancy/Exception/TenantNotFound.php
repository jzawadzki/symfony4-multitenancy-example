<?php declare(strict_types = 1);


namespace App\Multitenancy\Exception;

use Throwable;

class TenantNotFound extends \Exception
{
    public function __construct($message = "Tenant not found", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
