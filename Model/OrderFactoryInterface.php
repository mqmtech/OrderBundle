<?php

namespace MQM\OrderBundle\Model;

use MQM\OrderBundle\Model\OrderInterface;
use MQM\OrderBundle\Model\OrderItemInterface;

interface OrderFactoryInterface
{    
    /**
     * @return OrderInterface
     */
    public function createOrder();
    
    /**
     * @return OrderItemInterface
     */
    public function createOrderItem();
    
    /**
     * @return string 
     */
    public function getOrderClass();
    
    /**
     * @return string 
     */
    public function getOrderItemClass();
}