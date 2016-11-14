<?php

namespace Lv\LibraryBundle\Method;

use JMS\Serializer\SerializationContext;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class BaseMethod implements ContainerAwareInterface
{
    use ContainerAwareTrait;

    /* @var \Symfony\Component\DependencyInjection\Container $container */
    protected $container;

    /**
     * Gets a service.
     *
     * @param string $id              The service identifier
     * @param int    $invalidBehavior The behavior when the service does not exist
     *
     * @return object The associated service
     *
     * @see Reference
     */
    public function get($id, $invalidBehavior = ContainerInterface::EXCEPTION_ON_INVALID_REFERENCE)
    {
        return $this->container->get($id, $invalidBehavior);
    }

    /**
     * Gets a parameter.
     *
     * @param string $name The parameter name
     *
     * @return mixed The parameter value
     */
    public function getParameter($name)
    {
        return $this->container->getParameter($name);
    }

    /**
     * Get user from token storage.
     *
     * @return Company|Person
     */
    public function getUser()
    {
        return $this->container->get('security.token_storage')->getToken()->getUser();
    }

    /**
     * Serialize mixed value to array
     *
     * @param mixed             $data
     * @param null|array|string $groups
     * @param bool              $serializeNull
     *
     * @return mixed
     */
    protected function serialize($data, $groups = null, $serializeNull = true)
    {
        if (!is_array($data) && !is_object($data)) {
            return $data;
        }

        if ($groups === 'all') {
            $groups = ['list', 'details', 'all'];
        }

        if ($groups === null) {
            if (is_object($data)) {
                $groups = ['details'];
            } else {
                $groups = ['list'];
            }
        }

        return $this->container
            ->get('jms_serializer')
            ->toArray(
                $data,
                SerializationContext::create()
                    ->enableMaxDepthChecks()
                    ->setSerializeNull($serializeNull)
                    ->setGroups((array)$groups)
            );
    }
}
