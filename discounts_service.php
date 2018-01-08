<?php
// to be received via request 
$_POST["order"] = '{
    "id": "1",
    "customer-id": "1",
    "items": [
        {
        "product-id": "A102",
        "quantity": "1",
        "total": "100",
        "price": "100"
      },
      {
        "product-id": "A101",
        "quantity": "1",
        "total": "10",
        "unit-price": "10"
      }
    ],
    "total": "110"
  }';

require_once("data_access.php");
require_once("calc_discounts.php");
$calculator = new Calc_discounts();
$order = json_decode($_POST["order"]);
$ret = $calculator->calculate($order);
echo $order->total."<br/>";
foreach($ret as $discounts)
{
    echo $discounts."<br/>";
}
array(
    "order" => $order,
    "discounts" => $ret
);





?>
