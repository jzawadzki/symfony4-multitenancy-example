<?php

namespace App\Multitenancy\Http\Listener;

use App\Multitenancy\Doctrine\Filter\TenantFilter;
use App\Multitenancy\Exception\TenantNotFound;
use App\Multitenancy\TenantContext;
use App\Multitenancy\TenantResolver;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;

class RequestListener
{
    /**
     * @var TenantResolver
     */
    private $resolver;
    /**
     * @var TenantContext
     */
    private $tenantContext;
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(TenantResolver $resolver, TenantContext $tenantContext, EntityManagerInterface $entityManager)
    {
        $this->resolver = $resolver;
        $this->tenantContext = $tenantContext;
        $this->entityManager = $entityManager;
    }

    public function onKernelRequest(GetResponseEvent $event)
    {
        if (!$event->isMasterRequest()) {
            // don't do anything if it's not the master request
            return;
        }
        try {
            $tenant = $this->resolver->resolve($event->getRequest());
            $this->tenantContext->initialize($tenant);
            /** @var TenantFilter $filter */
            $filter = $this->entityManager->getFilters()->getFilter('tenant_filter');
            $filter->setTenant($tenant);
        } catch (TenantNotFound $exception) {
            $event->setResponse(new Response("Tenant not found", Response::HTTP_NOT_FOUND));
        }
    }
}
