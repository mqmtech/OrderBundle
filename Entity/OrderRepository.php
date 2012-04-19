<?php
namespace MQM\OrderBundle\Entity;

use Doctrine\ORM\EntityRepository;
use MQM\SortBundle\Sort\SortManagerInterface;

class OrderRepository extends EntityRepository
{
    public function findByPublicId($publicId)
    {
        $em = $this->getEntityManager();        
        $sql = "SELECT o FROM MQMOrderBundle:Order o WHERE o.publicId = '".$publicId."' ";
        $q = $em->createQuery($sql);
        $entity = $q->getSingleResult();
        
        return $entity;
    }
    
    /**
     * return array
     */
    public function findDeliveredOrdersByUserId($userId, SortManagerInterface $sortManager = null)
    {
        $em = $this->getEntityManager();
        $sql = "SELECT o FROM MQMOrderBundle:Order o JOIN o.user u WHERE o.status LIKE '" . Order::STATUS_2_DELIVERED . "' AND u.id ='". $userId . "'";
        if ($sortManager) {
            $sql = $sortManager->sortQuery($sql, 'o');
        }
        $q = $em->createQuery($sql);
        $orders = $q->getResult();
        
        return $orders;
    }
    
    /**
     * return array
     */
    public function findInProcessOrdersByUserId($userId, SortManagerInterface $sortManager = null)
    {
        $em = $this->getEntityManager();
        $sql = "SELECT o FROM MQMOrderBundle:Order o JOIN o.user u WHERE o.status <> '" . Order::STATUS_2_DELIVERED . "' AND u.id ='". $userId . "'";
        if ($sortManager) {
            $sql = $sortManager->sortQuery($sql, 'o');
        }
        $q = $em->createQuery($sql);
        $orders = $q->getResult();
        
        return $orders;
    }
}