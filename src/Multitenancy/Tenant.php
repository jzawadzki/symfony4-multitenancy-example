<?php declare(strict_types = 1);


namespace App\Multitenancy;

interface Tenant
{
    public function getId(): ?int;
}
