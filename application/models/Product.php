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
      // use Zend\Db\Sql\Sql;
      // $sql = new Sql($adapter);
      // $select = $this->_dbTable->select()
      // ->from($this->_name,array('ArName','EnName','photo'))
      // ->order('no_purchase DESC')
      // ->LIMIT(5);
      $select =  $this->select()
      ->from('product',array('ArName','EnName','photo'))
      ->order('product.no_purchase DESC')
      ->limit(5);

      $stmt = $select->query();
      return $stmt->fetchAll();


  }
}
