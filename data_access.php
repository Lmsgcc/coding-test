<?php


 
class Data_access
{
	
	public function getProduts($id)
    {
        $products = file_get_contents("./data/products.json");
        $products = json_decode($products);
        foreach($products as $p)
        {
            $attr= "product-id";
            if($p->id == $id)
                return $p;
        }
        return null;
    }

    public function getClient($id)
    {
        $clients = file_get_contents("./data/customers.json");
        $clients = json_decode($clients);
        foreach($clients as $c)
        {
            if($c["id"] == $id)
                return $c;
        }
        return null;
    }
	
}



?>