<?php 
class discount_worker_three 
{
    public function calc(&$order)
    {
        $calc_discounts = new Data_access();
        $discounts_applied = "";
		$nProducts = 0;
		$cheapest = null;
        foreach($order->items as $i)
        {
            $attr = "product-id";
            $id = $i->$attr;
            $product = $calc_discounts->getProduts($id);
            $i->description = $product->description;
			if($product->category == 1)
			{
				++$nProducts ;
				if($cheapest == null)
				{
					$cheapest = $i;
				}else if ($cheapest->total > $i->total)
				{
					$cheapest = $i;
				}
			}
        }
		if($nProducts > 1 && !empty($cheapest)){
			$order->total -= $cheapest->total *0.2;
			$discounts_applied .= "A 20% discount was applied on {$cheapest->description} <br/>";
        }
        return empty($discounts_applied) ? false : $discounts_applied;
    }
}

?>