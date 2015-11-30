<?php
namespace Application\Model;

use Zend\Session\Container;
class CartModel
{

    private $cart;

    public function __construct(Container $cart)
    {
        $this->cart = $cart;
        if(!isset($this->cart->item))
            $this->cart->item= array();
        //var_dump($cart);
    }

    public function addItem($item)
    {
        $id = $item['id'];
        unset($item['id']);
        $this->cart->item[$id] = $item;
    }

    public function updateItem($id, $item)
    {
        unset($item['id']);
        $this->cart->item[$id] = $item;
    }

    public function deleteItem($id)
    {
        unset($this->cart->item[$id]);
    }

    public function getItem($id)
    {
        if(isset($this->cart->item[$id])){
            return $this->cart->item[$id] ;
        }else {
            return false;
        }
        
    }

    public function getCart()
    {
        
        if (! $this->cart->item) {
            $this->cart->item = array();
        }
        return $this->cart->item;
    }

    public function getTotalAmount()
    {
        $total = 0;
        foreach ($this->cart->item as $item) {
            $total += $item['price'] * $item['qty'];
        }
        return $total;
    }

    public function cleanCart()
    {
        $this->cart->item = null;
    }
}