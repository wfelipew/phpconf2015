<?php
use Application\Model\CartModel;
use Zend\Session\Container;

class CartTest extends \Codeception\TestCase\Test
{

    /**
     *
     * @var \UnitTester
     */
    protected $model;

    protected function _before()
    {
        $container = new Container();
        $this->model = new CartModel($container);
    }

    protected function _after()
    {
        
    }
    
    // tests
    public function testAddItem()
    {
        $item = array(
            'id' => '212',
            'price' => '42.42',
            'qty' => 1
        );
        $this->model->addItem($item);
        $this->assertInternalType("array", $this->model->getCart());
        $this->assertCount(1, $this->model->getCart());
    }

    public function testUpdateItem()
    {
        $item = array(
            'id' => '212',
            'price' => '42.42',
            'qty' => 3
        );
        $this->model->updateItem(212, $item);
        $this->assertCount(1, $this->model->getCart());
        $updatedItem = $this->model->getItem(212);
        $this->assertEquals(3, $updatedItem['qty']);
    }

    public function testDeleteItem()
    {
        $this->model->deleteItem(212);
        $this->assertCount(0, $this->model->getCart());
        $this->assertArrayNotHasKey(212,$this->model->getCart());
    }
    
    public function testTotalCart()
    {
        $item1 = array(
            'id' => '212',
            'price' => 1,
            'qty' => 3
        );
        
        $item2 = array(
            'id' => '32',
            'price' => 5.50,
            'qty' => 1
        );
        
        $this->model->addItem($item1);
        $this->model->addItem($item2);
        
        $this->assertCount(2, $this->model->getCart());
        $this->assertEquals(8.50, $this->model->getTotalAmount());
    }
    
    
    public function testCleanCart()
    {
        $this->model->cleanCart();
        $this->assertCount(0, $this->model->getCart());
    }
    
}