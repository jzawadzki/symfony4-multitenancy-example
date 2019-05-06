<?php declare(strict_types = 1);


namespace App\Multitenancy\Provider;

use App\Multitenancy\Tenant;
use App\Multitenancy\TenantProvider;
use App\Repository\OrganizationRepository;

class OrganizationTenantProvider implements TenantProvider
{
    /**
     * @var OrganizationRepository
     */
    private $organizationRepository;

    public function __construct(OrganizationRepository $organizationRepository)
    {
        $this->organizationRepository = $organizationRepository;
    }

    public function findBySubdomain(string $subdomain): ?Tenant
    {
        $organization = $this->organizationRepository->findOneBySubdomain($subdomain);

        // add here additional logic - e.g. if organization is active

        return $organization;
    }
}
