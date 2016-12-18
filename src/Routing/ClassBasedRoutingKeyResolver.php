<?php

namespace SimpleBus\Asynchronous\Routing;

class ClassBasedRoutingKeyResolver implements RoutingKeyResolver
{
    public function resolveRoutingKeyFor($message, $separator = '.')
    {
        return str_replace(
            '\\',
            $separator,
            get_class($message)
        );
    }
}
