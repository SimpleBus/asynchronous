<?php

namespace SimpleBus\Asynchronous\Tests\Routing;

use SimpleBus\Asynchronous\Routing\ClassBasedRoutingKeyResolver;
use SimpleBus\Asynchronous\Routing\PrefixBasedResolver;
use SimpleBus\Asynchronous\Tests\Routing\Fixtures\MessageDummy;

class PrefixBasedResolverTest extends \PHPUnit_Framework_TestCase
{
    private $prefix = 'DummyPrefix';

    private $suffix = 'DummySuffix';

    /**
     * @test
     */
    public function it_returns_the_fqcn()
    {
        $message = new MessageDummy();
        $parentResolver = new ClassBasedRoutingKeyResolver();
        $resolver = new PrefixBasedResolver($parentResolver);

        $routingKey = $resolver->resolveRoutingKeyFor($message);

        $this->assertSame('SimpleBus.Asynchronous.Tests.Routing.Fixtures.MessageDummy', $routingKey);
    }

    /**
     * @test
     */
    public function it_returns_the_fqcn_with_prefix()
    {
        $message = new MessageDummy();
        $parentResolver = new ClassBasedRoutingKeyResolver();
        $resolver = new PrefixBasedResolver($parentResolver, $this->prefix);

        $routingKey = $resolver->resolveRoutingKeyFor($message);

        $this->assertSame($this->prefix . 'SimpleBus.Asynchronous.Tests.Routing.Fixtures.MessageDummy', $routingKey);
    }

    /**
     * @test
     */
    public function it_returns_the_fqcn_with_prefix_and_suffix()
    {
        $message = new MessageDummy();
        $parentResolver = new ClassBasedRoutingKeyResolver();
        $resolver = new PrefixBasedResolver($parentResolver, $this->prefix, $this->suffix);

        $routingKey = $resolver->resolveRoutingKeyFor($message);

        $this->assertSame($this->prefix . 'SimpleBus.Asynchronous.Tests.Routing.Fixtures.MessageDummy' . $this->suffix, $routingKey);
    }

    /**
     * @test
     */
    public function it_returns_the_fqcn_with_suffix()
    {
        $message = new MessageDummy();
        $parentResolver = new ClassBasedRoutingKeyResolver();
        $resolver = new PrefixBasedResolver($parentResolver, null, $this->suffix);

        $routingKey = $resolver->resolveRoutingKeyFor($message);

        $this->assertSame('SimpleBus.Asynchronous.Tests.Routing.Fixtures.MessageDummy' . $this->suffix, $routingKey);
    }

}
