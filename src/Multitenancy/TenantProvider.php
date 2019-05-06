<?php declare(strict_types = 1);

namespace App\Multitenancy;

interface TenantProvider
{
    public function findBySubdomain(string $subdomain): ?Tenant;
}
