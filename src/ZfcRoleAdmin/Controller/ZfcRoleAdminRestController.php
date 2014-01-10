<?php

namespace ZfcRoleAdmin\Controller;

use Zend\Mvc\Controller\AbstractRestfulController;
use ZfcRoleAdmin\Model\Role;
use ZfcRoleAdmin\Model\RoleTable;
use ZfcRoleAdmin\Form\RoleForm;
use Zend\View\Model\JsonModel;

/**
 */
class ZfcRoleAdminRestController extends AbstractRestfulController {
	
	protected $RoleTable;
	
	
	public function __construct()
	{
		$this->setIdentifierName('roleid');
	}
	
	public function getRoleTable()
	{
		if (!$this->RoleTable) {
			$sm = $this->getServiceLocator();
			$this->RoleTable = $sm->get('ZfcRoleAdmin\Model\RoleTable');
		}
		return $this->RoleTable;
	}
	

	public function getList()
	{
		$id = $this->getEvent()->getRouteMatch()->getParam('roleid');
		$vars = $this->getRoleTable()->fetchAll();
    	$rvars = array();
    	foreach($vars as $var)
    		$rvars[] = get_object_vars($var);
    	return $rvars;
	}
	
	
	
	public function get($id)
	{
		//echo 'test';exit;
		$variable = $this->getRoleTable()->getRole($id);
		return  get_object_vars($variable);	
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