<?php

namespace SimpleBus\Asynchronous\Routing;

class PrefixBasedResolver implements RoutingKeyResolver
{
    /**
     * @var RoutingKeyResolver
     */
    private $parent;

    /**
     * @var string
     */
    private $prefix;

    /**
     * @var string
     */
    private $suffix;

    /**
     * @param RoutingKeyResolver $parent
     * @param string $prefix
     * @param string $suffix
     */
    public function __construct(RoutingKeyResolver $parent, $prefix = null, $suffix = null)
    {
        $this->parent = $parent;
        if (is_string($prefix)) {
            $this->prefix = $prefix;
        }
        if (is_string($suffix)) {
            $this->suffix = $suffix;
        }
    }

    public function resolveRoutingKeyFor($message)
    {
        $routingKey = '';

        if (isset($this->prefix)) {
            $routingKey .= $this->prefix;
        }

        $routingKey .= $this->parent->resolveRoutingKeyFor($message);

        if (isset($this->suffix)) {
            $routingKey .= $this->suffix;
        }

        return $routingKey;
    }
}
