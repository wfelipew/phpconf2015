<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;

class CartController extends AbstractRestfulController
{

    public function create($data)
    {
        $cartModel = $this->serviceLocator->get('CartModel');
        $cartModel->addItem($data);
        return new JsonModel($cartModel->getCart());
    }

    public function update($id, $data)
    {
        $cartModel = $this->serviceLocator->get('CartModel');
        $cartModel->updateItem($id, $data);
        return new JsonModel($cartModel->getCart());
    }

    public function delete($id)
    {
        $cartModel = $this->serviceLocator->get('CartModel');
        $cartModel->deleteItem($id);
        return new JsonModel($cartModel->getCart());
    }

    public function get($id)
    {
        $cartModel = $this->serviceLocator->get('CartModel');
        $item = $cartModel->getItem($id);
        if (!$item) {
            $this->response->setStatusCode(400);
            $item = array();
        }
        
        return new JsonModel($item);
    }

    public function getList()
    {
        $cartModel = $this->serviceLocator->get('CartModel');
        $cart = $cartModel->getCart();
        return new JsonModel($cart);
    }

    public function deleteList()
    {
        $cartModel = $this->serviceLocator->get('CartModel');
        $cartModel->cleanCart();
        $cart = $cartModel->getCart();
        return new JsonModel($cart);
    }
}
