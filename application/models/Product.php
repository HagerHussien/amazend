<?php

class Application_Model_Product extends Zend_Db_Table_Abstract
{
    protected $_name = 'product';

    function productDetails($prod_id) {
        return $this->find($prod_id)->toArray()[0];
    }

    function listProducts(){
        return $this->fetchAll()->toArray();
    }

	function productSearch($prod_name) {

        return $this->fetchAll("EnName like \"$prod_name%\"")->toArray();
    }

  function maxPurchased(){
      $select =  $this->select()
      ->from('product',array('ArName','EnName','photo'))
      ->order('product.no_purchase DESC')
      ->limit(5);

      $stmt = $select->query();
      return $stmt->fetchAll();
  }
  function prouduct_price($product_id){
      $select =  $this->select()
      ->from('product',array('price'))
      ->where('productID=?',$product_id);
      $stmt = $select->query();
      return $stmt->fetchAll();
  }

  function category_products($category_id){
      $select =  $this->select()
      ->from('product',array())
      ->where('product.categoryID=?',$category_id);
      $stmt = $select->query();
      return $stmt->fetchAll();
  }
}
