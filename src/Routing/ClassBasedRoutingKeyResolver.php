<?php

namespace SimpleBus\Asynchronous\Routing;

class ClassBasedRoutingKeyResolver implements RoutingKeyResolver
{

    /**
     * @var string
     */
    private $separator;

    /**
     * @param string $separator
     */
    public function __construct($separator = '.')
    {
        $this->separator = $separator;
    }

    /**
     * @param object | string $message
     *
     * @return string
     */
    public function resolveRoutingKeyFor($message)
    {
        return str_replace(
            '\\',
            $this->separator,
            is_object($message) ? get_class($message) : $message
        );
    }
}
