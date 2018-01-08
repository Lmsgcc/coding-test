<?php 

class Calc_discounts
{


    public function calculate(&$order)
    {
        $files = scandir("./workers");
        $discounts_applied = array();
        
        foreach($files as $f)
        {
            $pos = strpos($f, ".php");

            if($pos === false)
            {
                continue;
            }
            $file_name = substr($f, 0, $pos);
            require_once "./workers/$f";
            $obj = new $file_name();
            $ret = $obj->calc($order);
            if($ret !== false)
            {
                $discounts_applied[] = $ret;
            }
        }
        return $discounts_applied;
        
    }
}




?>