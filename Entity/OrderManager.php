<?php

namespace MQM\OrderBundle\Entity;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;

use MQM\OrderBundle\Model\OrderManagerInterface;
use MQM\OrderBundle\Model\OrderFactoryInterface;
use MQM\OrderBundle\Model\OrderInterface;
use MQM\SortBundle\Sort\SortManagerInterface;
use MQM\PaginationBundle\Pagination\PaginationInterface;

class OrderManager implements OrderManagerInterface
{
    private $orderFactory;
    private $entityManager;
    private $orderRepository;
   
    public function __construct(EntityManager $entityManager, OrderFactoryInterface $orderFactory)
    {
        $this->entityManager = $entityManager;
        $this->orderFactory = $orderFactory;
        $orderClass = $orderFactory->getOrderClass();
        $this->orderRepository = $this->entityManager->getRepository($orderClass);
    }
    
    /**
     * {@inheritDoc} 
     */
    public function createOrder()
    {
        return $this->getOrderFactory()->createOrder();
    }
    
    /**
     * {@inheritDoc} 
     */
    public function createOrderItem()
    {
        return $this->getOrderFactory()->createOrderItem();
    }
    
    /**
     * {@inheritDoc} 
     */
    public function saveOrder(OrderInterface $order, $andFlush = true)
    {
        $this->getEntityManager()->persist($order);
        if ($andFlush) {
            $this->getEntityManager()->flush();
        }
    }
    
    /**
     * {@inheritDoc} 
     */
    public function deleteOrder(OrderInterface $order, $andFlush = true)
    {
        $this->getEntityManager()->remove($order);
        if ($andFlush) {
            $this->getEntityManager()->flush();
        }
    }
    
    /**
     * {@inheritDoc} 
     */
    public function flush()
    {
        $this->getEntityManager()->flush();
    }
    
    /**
     * {@inheritDoc} 
     */
    public function findOrderByPublicId($publicId)
    {
        return $this->getOrderRepository()->findByPublicId($publicId);
    }
    
    /**
     * {@inheritDoc} 
     */
    public function findOrderBy(array $criteria)
    {
        return $this->getOrderRepository()->findOneBy($criteria);
    }

    /**
     * {@inheritDoc} 
     */
    public function findOrders(PaginationInterface $pagination = null)
    {
        return $this->getOrderRepository()->findAll($pagination);
    }
    
    /**
     * {@inheritDoc} 
     */
    public function findDeliveredOrdersByUserId($userId, SortManagerInterface $sortManager = null)
    {
        $orders = $this->getOrderRepository()->findDeliveredOrdersByUserId($userId, $sortManager);
        if ($orders == null) {
            return null;
        }
        
        return $orders;
    }
    
    /**
     * {@inheritDoc} 
     */
    public function findInProcessOrdersByUserId($userId, SortManagerInterface $sortManager = null)
    {
        $orders = $this->getOrderRepository()->findInProcessOrdersByUserId($userId, $sortManager);
        if ($orders == null) {
            return null;
        }
        
        return $orders;
    }
    
    /**
     *
     * @return OrderFactoryInterface
     */
    protected function getOrderFactory()
    {
        return $this->orderFactory;
    }

    /**
     *
     * @return EntityManager
     */
    protected function getEntityManager()
    {
        return $this->entityManager;
    }
    
    /**
     *
     * @return EntityRepository
     */
    protected function getOrderRepository()
    {
        return $this->orderRepository;
    }
}