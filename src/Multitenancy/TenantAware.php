<?php declare(strict_types = 1);

namespace App\Multitenancy;

interface TenantAware
{
    public function setTenant(Tenant $tenant);
    public function getTenant(): ?Tenant;
}
