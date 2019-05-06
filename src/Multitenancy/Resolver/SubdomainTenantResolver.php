<?php declare(strict_types = 1);


namespace App\Multitenancy\Resolver;

use App\Multitenancy\Exception\TenantNotFound;
use App\Multitenancy\Tenant;
use App\Multitenancy\TenantProvider;
use App\Multitenancy\TenantResolver;
use Symfony\Component\HttpFoundation\Request;

class SubdomainTenantResolver implements TenantResolver
{
    private $tenantProvider;

    public function __construct(TenantProvider $tenantProvider)
    {
        $this->tenantProvider = $tenantProvider;
    }

    public function resolve(Request $request): Tenant
    {
        // example - simple get subdomain
        $stubs=explode(".", $request->getHost());
        $subdomain=$stubs[0];

        $tenant = $this->tenantProvider->findBySubdomain($subdomain);

        if (!$tenant) {
            throw new TenantNotFound();
        }

        return $tenant;
    }
}
