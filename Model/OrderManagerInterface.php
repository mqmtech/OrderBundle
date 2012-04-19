<?php

namespace MQM\OrderBundle\Model;

use MQM\OrderBundle\Model\OrderInterface;
use MQM\OrderBundle\Model\OrderItemInterface;
use MQM\SortBundle\Sort\SortManagerInterface;

interface OrderManagerInterface
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
     *
     * @param OrderInterface $order
     * @param boolean $andFlush 
     */
    public function saveOrder(OrderInterface $order, $andFlush = true);
    
    /**
     * TODO: careful, do we really want to be able to delete real orders ?
     * 
     * @param OrderInterface $order
     * @param boolean $andFlush 
     */
    public function deleteOrder(OrderInterface $order, $andFlush = true);
    
    /**
     * @return OrderManagerInterface
     */
    public function flush();
    
    /**
     * @param string $publicId
     * @return OrderInterface 
     */
    public function findOrderByPublicId($publicId);
    
    /**
     * @param array $criteria
     * @return OrderInterface 
     */
    public function findOrderBy(array $criteria);
    
    /**
     * @return array 
     */
    public function findOrders();
    
    /**
     * @return array 
     */
    public function findDeliveredOrdersByUserId($userId, SortManagerInterface $sortManager = null);
    
    /**
     * @return array 
     */
    public function findInProcessOrdersByUserId($userId, SortManagerInterface $sortManager = null);
}