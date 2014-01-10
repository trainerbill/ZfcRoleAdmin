<?php

namespace ZfcRoleAdmin\Controller;

use Zend\Mvc\Controller\AbstractRestfulController;
use ZfcRoleAdmin\Model\Role;
use ZfcRoleAdmin\Model\RoleTable;
use ZfcRoleAdmin\Form\RoleForm;
use Zend\View\Model\JsonModel;

/**
 */
class ZfcUserAdminRestController extends AbstractRestfulController {
	
	protected $UserTable;
	
	
	public function __construct()
	{
		$this->setIdentifierName('userid');
	}
	
	public function getUserTable()
	{
		if (!$this->UserTable) {
			$sm = $this->getServiceLocator();
			$this->UserTable = $sm->get('zfcuser_user_mapper');
		}
		return $this->UserTable;
	}
	

	public function getList()
	{
		$vars = $this->getUserTable()->fetchAll();
    	$rvars = array();
    	foreach($vars as $var)
    		$rvars[] = get_object_vars($var);
    	return $rvars;
	}
	
	
	
	public function get($id)
	{
		
		$variable = $this->getUserTable()->findById($id);
		//print_r($variable);
		$return = array('user_id' => $variable->getId(),'state'=>$variable->getState(),'email'=>$variable->getEmail());
		return $return;
	}
	
	public function create($data)
	{
		
	}
	
	public function update($id, $data) 
	{
		
	}
	
	public function delete($id) 
	{
		
	}
}