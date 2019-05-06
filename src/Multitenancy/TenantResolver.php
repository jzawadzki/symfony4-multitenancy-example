<?php declare(strict_types = 1);

namespace App\Multitenancy;

use Symfony\Component\HttpFoundation\Request;

interface TenantResolver
{
    /**
     * @throws Exception\TenantNotFound
     */
    public function resolve(Request $request): Tenant;
}
