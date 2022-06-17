<?php

namespace main;

require_once 'shopping/ShippingCost.php';
require_once 'fee/Charge.php';
require_once 'fee/FeeFactory.php';
require_once 'customer/Customer.php';
require_once 'customer/Customers.php';

use customer\Customer;
use customer\Customers;
use fee\Charge;
use fee\FeeFactory;
use shopping\ShippingCost;

shopping();
fee();
customers();

function customers()
{
    $customerA = new Customer("hagiwara");
    $customerB = new Customer("ogawa");
    $customerC = new Customer("suyama");

    // 3通りの構文あり
    $customers = Customers::construct($customerA, $customerB);
    $customers = Customers::construct(...[$customerA, $customerB]);
    $customers = new Customers($customerA, $customerB);

    $addedCustomers = $customers->add($customerC);
    foreach ($addedCustomers->getCustomers() as $customer) {
        echo $customer->getName() . "\n";
    }
}

function shopping()
{
    $basePrice = 2000;

    $shippingCost = new ShippingCost($basePrice);

    $itemPrice = ($basePrice + $shippingCost->amount());

    echo $itemPrice . "\n";
}

function fee()
{
    $adultFee = FeeFactory::feeByName('adult');
    $charge = new Charge($adultFee);
    echo $charge->yen() . "\n";
}
