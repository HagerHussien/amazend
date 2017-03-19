<?php

class Application_Model_Category extends Zend_Db_Table_Abstract
{

protected $_name = 'category';


function listCat()
{
	return $this->fetchAll()->toArray();
}
function deleteCat($id)
{
	$this->delete("categoryID=$id");
	

}
function detailCat($id)
{
   return $this->find($id)->toArray()[0];
}

function getCat($id)
	{
	$id = (int)$id;
		$row = $this->fetchRow('categoryID = ' . $id);
		if (!$row) {
		throw new Exception("Could not find row $id");
		}
		return $row->toArray();
	}

	
	public function updateCat($catID,$EnName,$ArName,$adminID)
	{
		$data = array(
		'categoryID' => $catID,
		'EnName' => $EnName,
		'ArName' => $ArName,
		'adminID' => $adminID,
		);
		$this->update($data, 'categoryID = '. (int)$catID);
	}

	function addCat($catID,$EnName,$ArName,$adminID)
	{
		$data = array(
		'categoryID' => $catID,
		'EnName' => $EnName,
		'ArName' => $ArName,
		'adminID' => $adminID,
			);

		$this->insert($data);
	}


}

