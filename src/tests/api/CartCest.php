<?php
use \ApiTester;

class CartCest
{

    private $cookie;

    private function getCookie()
    {
        $cookie = $this->cookie;
        $cookie = implode(' ', $this->cookie);
        $cookie = preg_replace('/path=\//', '', $cookie);
        return $cookie;
    }

    public function _before(ApiTester $I)
    {
        // Clean cart
        // $I->sendDELETE('api/cart');
    }

    public function _after(ApiTester $I)
    {}
    
    // tests
    public function tryToTest(ApiTester $I)
    {}

    public function testAddItemCart(ApiTester $I)
    {
        $I->wantTo('Insert add item to cart');
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->sendPOST('api/cart', array(
            'id' => 212,
            'qty' => 3,
            'price' => 3.5
        ));
        
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        $this->cookie = $I->grabHttpHeader('Set-Cookie', false);
    }

    public function testGetCart(ApiTester $I)
    {
        $I->wantTo('Get all item of a cart');
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->haveHttpHeader('Cookie', $this->getCookie());
        $I->sendGET('api/cart');
        
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson(array(
            '212' => array(
                'qty' => 3,
                'price' => 3.5
            )
        ));
    }

    public function testUpdateItem(ApiTester $I)
    {
        $I->wantTo('Update item on cart');
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->haveHttpHeader('Cookie', $this->getCookie());
        $I->sendPUT('api/cart/212', array(
            'id' => 212,
            'qty' => 9,
            'price' => 3.5
        ));
        
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson(array(
            '212' => array(
                'qty' => 9,
                'price' => 3.5
            )
        ));
    }

    public function testGetItem(ApiTester $I)
    {
        $I->wantTo('Get item from cart');
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->haveHttpHeader('Cookie', $this->getCookie());
        $I->sendGET('api/cart/212');
        
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson(array(
            'qty' => 9,
            'price' => 3.5
        ));
    }

    public function testDeleteItem(ApiTester $I)
    {
        $I->wantTo('Remove item from cart');
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->haveHttpHeader('Cookie', $this->getCookie());
        $I->sendDELETE('api/cart/212');
        
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson(array());
    }
    
    public function testClearCart(ApiTester $I)
    {
        $I->wantTo('Clear cart');
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->haveHttpHeader('Cookie', $this->getCookie());
        $I->sendPOST('api/cart', array(
            'id' => 212,
            'qty' => 3,
            'price' => 3.5
        ));
        $I->sendPOST('api/cart', array(
            'id' => 214,
            'qty' => 1,
            'price' => 7.5
        ));
        $I->sendDELETE('api/cart');
    
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson(array());
    }
    
    
    public function testGetInvalidItem(ApiTester $I)
    {
        $I->wantTo('Get invalid item from cart');
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->haveHttpHeader('Cookie', $this->getCookie());
        $I->sendGET('api/cart/500');
        
        $I->seeResponseCodeIs(400);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson(array());
        
    }
    
    
}
