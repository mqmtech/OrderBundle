<?php

namespace MQM\OrderBundle\Model;

use MQM\OrderBundle\Model\OrderItemInterface;

interface OrderInterface
{
    const RECEIVED = "RECEIVED";       //order saved in database
    const IN_PROCESS = "IN_PROCESS";   //order being processed by staff
    const DELIVERED = "DELIVERED";     //order delivered
    
    public function getProductsQuantity();
    
    public function getPublicId();
    
    public function setPublicId($publicId);
    
    public function getItems();
    
    public function setItems($items);
    
    public function addItem(OrderItemInterface $item);
    
    public function getId();
    
    public function setId($id);
    
    public function getStatus();
    
    public function setStatus($status);
    
    public function getName();
    
    public function setName($name);
    
    public function getDescription();
    
    public function setDescription($description);
    
    public function getCreatedAt();
    
    public function setCreatedAt($createdAt);
    
    public function getModifiedAt();
    
    public function setModifiedAt($modifiedAt);
    
    public function getCheckoutAt();
    
    public function setCheckoutAt($checkoutAt);
    
    public function getShippingBasePrice();
    
    public function setShippingBasePrice($shippingBasePrice);
    
    public function getTotalProductsBasePrice();
    
    public function setTotalProductsBasePrice($totalProductsBasePrice);
    
    public function getTotalBasePrice();
    
    public function setTotalBasePrice($totalBasePrice);
    
    public function getTax();
    
    public function setTax($tax);
    
    public function getTaxPrice();
    
    public function setTaxPrice($taxPrice);
    
    public function getTotalPrice();
    
    public function setTotalPrice($totalPrice);
    
    public function getShippingMethod();
    
    public function setShippingMethod($shippingMethod);
    
    public function getOrderState();
    
    public function setOrderState($orderState);
    
    public function getUser();
    
    public function setUser($user);    
}