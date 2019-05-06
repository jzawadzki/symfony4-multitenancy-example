<?php declare(strict_types=1);

namespace App\Multitenancy\Doctrine\Listener;

use App\Multitenancy\Exception\TenantNotSet;
use App\Multitenancy\TenantAware;
use App\Multitenancy\TenantContext;
use Doctrine\ORM\Event\LifecycleEventArgs;

class TenantListener
{

    /**
     * @var TenantContext
     */
    private $tenantContext;

    public function __construct(TenantContext $tenantContext)
    {
        $this->tenantContext = $tenantContext;
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        if ($entity instanceof TenantAware) {
            try {
                $tenant = $this->tenantContext->getCurrentTenant();
                $entity->setTenant($tenant);
            } catch (TenantNotSet $exception) {
                if (is_null($entity->getTenant())) {
                    throw new \InvalidArgumentException("Tenant has to be set before you try to add entity related to it");
                }
            }
        }
    }
}
