<?php declare(strict_types = 1);

namespace App\Multitenancy;

use App\Multitenancy\Exception\TenantNotSet;

class TenantContext
{
    private $tenant;
    private $isInitialized = false;

    public function initialize(Tenant $tenant)
    {
        if ($this->isInitialized) {
            throw new \Exception("Tenant Context already initialized");
        }

        $this->isInitialized = true;
        $this->tenant = $tenant;
    }

    /**
     * @throws TenantNotSet
     */
    public function getCurrentTenant(): Tenant
    {
        if (is_null($this->tenant)) {
            throw new TenantNotSet("No tenant yet!");
        }

        return $this->tenant;
    }
}
