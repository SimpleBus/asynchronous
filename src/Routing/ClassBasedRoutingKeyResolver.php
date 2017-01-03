<?php

namespace SimpleBus\Asynchronous\Routing;

class ClassBasedRoutingKeyResolver implements RoutingKeyResolver
{
    /**
     * @var string
     */
    private $prefix;

    /**
     * @var string
     */
    private $separator;

    /**
     * @var string
     */
    private $suffix;

    /**
     * @param string $separator
     * @param string $prefix
     * @param string $suffix
     */
    public function __construct($separator = '.', $prefix = null, $suffix = null)
    {
        $this->separator = $separator;
        if ($prefix !== null) {
            $this->prefix = $prefix;
        }
        if ($suffix !== null) {
            $this->suffix = $suffix;
        }
    }

    public function resolveRoutingKeyFor($message)
    {
        $components = explode('\\', is_object($message) ? get_class($message) : $message);

        if(isset($this->prefix)){
            array_unshift($components, $this->prefix);
        }
        if(isset($this->suffix)){
            $components[] = $this->suffix;
        }

        return implode($this->separator, $components);
    }
}
