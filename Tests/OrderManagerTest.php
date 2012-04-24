<?php

namespace MQM\OrderBundle\Test\Order;





class OrderManagerTest extends \Symfony\Bundle\FrameworkBundle\Test\WebTestCase
{   
    protected $_container;
    private $orderManager;

    public function __construct()
    {
        parent::__construct();
        
        $client = static::createClient();
        $container = $client->getContainer();
        $this->_container = $container;  
    }
    
    protected function setUp()
    {
        $this->orderManager = $this->get('mqm_order.order_manager');
    }

    protected function tearDown()
    {
        $this->resetOrders();
    }

    protected function get($service)
    {
        return $this->_container->get($service);
    }
    
    public function testGetAssertManager()
    {
        $this->assertNotNull($this->orderManager);
    }
    
    private function resetOrders()
    {
        $categories = $this->orderManager->findOrders();
        foreach ($categories as $order) {
            $this->orderManager->deleteOrder($order, false);
        }
        $this->orderManager->flush();
    }
}
