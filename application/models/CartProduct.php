<?php

class Application_Model_CartProduct extends Zend_Db_Table_Abstract
{
    protected $_name = 'cart_product';

    function checkExistence($cart_id,$product_id) {

      $select =  $this->select()
      ->from('cart_product',array())
      ->where("cart_product.cartID = $cart_id")
      ->where("cart_product.productID = $product_id");
      $stmt = $select->query();
      $result= $stmt->fetchAll();
      if (empty($result)) {
            return TRUE;
        }
        return FALSE;
    }

    function addNewItemToCart($cart_id,$product_id,$quantity,$price,$total){
        $data = array(
              'cartID' => $cart_id ,
              'productID'  => $product_id,
              'quantity'   => $quantity,
              'price' => $price,
              'total' => $total
            );

        $this->insert($data);
    }

}
