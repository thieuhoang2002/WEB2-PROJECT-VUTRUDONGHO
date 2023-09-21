<?php
    function get_product_by_id ($productID){

        $product = mysqli_query(connectDatabase(), "select * from product where ProductID ='$productID' and Status = 1");

        if($product){
            $product = mysqli_fetch_array($product);
            return $product;
        }

        return false;
    }
?>