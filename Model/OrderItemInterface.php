<?php

namespace MQM\OrderBundle\Model;

interface OrderItemInterface
{
    public function getId();
    
    public function setId($id);
    
    public function getCreatedAt();
    
    public function setCreatedAt($createdAt);
    
    public function getModifiedAt();
    
    public function setModifiedAt($modifiedAt);
    
    public function getBasePrice();
    
    public function setBasePrice($basePrice);
    
    public function getQuantity();
    
    public function setQuantity($quantity);
    
    public function getTotalBasePrice();
    
    public function setTotalBasePrice($totalBasePrice);
    
    public function getProduct();
    
    public function setProduct($product);
    
    public function getOrder();
    
    public function setOrder($order);
}