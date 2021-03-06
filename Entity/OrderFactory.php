<?php

namespace MQM\OrderBundle\Entity;

use MQM\UserBundle\Helper\UserAuthenticatedResolverInterface;
use MQM\OrderBundle\Model\OrderFactoryInterface;

class OrderFactory implements OrderFactoryInterface
{
    const UID_PADDING = 99;
    
    private $userResolver;
    private $orderClass;
    private $orderItemClass;
    
    public function __construct($orderClass, $orderItemClass, UserAuthenticatedResolverInterface $userResolver) {
        $this->orderClass = $orderClass;
        $this->orderItemClass = $orderItemClass;
        $this->userResolver = $userResolver;
    }
    
    /**
     * {@inheritDoc} 
     */
    public function createOrder()
    {
        $order = new $this->orderClass();
        $publicId = $this->generateCode();
        $order->setPublicId($publicId);
        
        return $order;
    }

    /**
     * {@inheritDoc} 
     */
    public function getOrderClass()
    {
        return $this->orderClass;
    }
    
    /**
     * {@inheritDoc} 
     */
    public function createOrderItem() {
        return new $this->orderItemClass();
    }

    /**
     * {@inheritDoc} 
     */
    public function getOrderItemClass() {
        return $this->orderItemClass;
    }
    
    /**
     * {@inheritDoc} 
     */
    private function generateCode()
    {
        $stamp = strtotime("now");
        $stamp = str_replace(".", "", $stamp);
        $user = $this->userResolver->getCurrentUser();
        $userId = $user->getId() + self::UID_PADDING;        
        $code = $userId ."t". $stamp;
        
        return $code;
    }  
}