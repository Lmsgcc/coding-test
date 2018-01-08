<?php 
class discount_worker_two 
{
    public function calc(&$order)
    {
        $calc_discounts = new Data_access();
        $items = array();
        $discounts_applied = "";
        
        foreach($order->items as $i)
        {
            $attr = "product-id";
            $id = $i->$attr;
            $product = $calc_discounts->getProduts($id);
            $i->description = $product->description;
            $items[$product->category][] = $i;

            // if product is category 2 for every five gets one for free
            if($product->category == 2)
            {
                $n = intval($i->quantity / 5);
				if($n > 0){
					$order->total -= $product->price * $n;
					$discounts_applied .= "A total number of $n $product->description have been discounted<br/>";
				}
            }
        }
        return empty($discounts_applied) ? false : $discounts_applied;
  }
}

?>