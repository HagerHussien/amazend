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
}
