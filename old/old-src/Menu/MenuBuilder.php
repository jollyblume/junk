<?php

namespace OldApp\Menu;

use Knp\Menu\FactoryInterface;

class MenuBuilder
{
    private $factory;

    /**
     * @param FactoryInterface $factory
     *
     * Add any other dependency you need
     */
    public function __construct(FactoryInterface $factory)
    {
        $this->factory = $factory;
    }

    public function createTestMenu(array $options)
    {
        $menu = $this->factory->createItem('root');

        $menu->addChild('Home', ['route' => 'landingpage']);
        // ... add more children

        return $menu;
    }
}
