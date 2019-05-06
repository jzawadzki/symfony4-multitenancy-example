<?php declare(strict_types=1);

namespace App\Multitenancy\Doctrine\Filter;

use App\Multitenancy\TenantAware;
use App\Multitenancy\Tenant;
use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\ORM\Query\Filter\SQLFilter;

class TenantFilter extends SQLFilter
{
    /** @var Tenant|null */
    private $tenant;

    public function setTenant(Tenant $tenant)
    {
        $this->tenant = $tenant;
    }

    public function addFilterConstraint(ClassMetadata $targetEntity, $targetTableAlias)
    {
        if (!$this->tenant) {
            return "";
        }

        // Check if the entity implements the TenantAware interface
        if (!$targetEntity->reflClass->implementsInterface(TenantAware::class)) {
            return "";
        }

        //add sql condition
        $condition = $targetTableAlias . '.TenantID = ' . $this->tenant->getId(); // getParameter applies quoting automatically

        return $condition;
    }
}
