<?php

namespace App\Entity;

use App\Multitenancy\Tenant;

trait TenantAwareTrait
{
    /**
     * @ORM\ManyToOne(targetEntity="Organization")
     * @ORM\JoinColumn(name="TenantID", referencedColumnName="id")
     */
    protected $tenant;

    public function setTenant(Tenant $tenant)
    {
        $this->tenant = $tenant;
    }

    public function getTenant(): Tenant
    {
        return $this->tenant;
    }
}
