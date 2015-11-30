<?php
namespace Application\Service\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Session\Container;
use Application\Model\CartModel;

class CartModelFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $container = new Container();
        $cartModel = new CartModel($container);
        return $cartModel;
    }
       
}