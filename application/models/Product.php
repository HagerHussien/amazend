<?php

class Application_Model_Product extends Zend_Db_Table_Abstract
{
    protected $_name = 'product';

    function productDetails($prod_id) {
        return $this->find($prod_id)->toArray();
    }

    function listProducts(){
        return $this->fetchAll()->toArray();
    }


}
