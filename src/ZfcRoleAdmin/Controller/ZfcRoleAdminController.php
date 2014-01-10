<?php
namespace ZfcRoleAdmin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Session\Container;
use Zend\Stdlib\Parameters;
use ZfcRoleAdmin\Form\RoleForm;
use ZfcRoleAdmin\Model\Role;

class ZfcRoleAdminController extends AbstractActionController
{
	protected $RoleTable;
	
	public function getRoleTable()
	{
		if (!$this->RoleTable) {
			$sm = $this->getServiceLocator();
			$this->RoleTable = $sm->get('ZfcRoleAdmin\Model\RoleTable');
		}
		return $this->RoleTable;	
	}
	
	
	public function indexAction()
	{
		$roles = $this->getRoleTable()->fetchAll();
		return new ViewModel(array('roles'=>$roles));
	}
	
	public function addAction()
	{
		$form = new RoleForm();
		$request = $this->getRequest();
		if ($request->isPost()) {
			$role = new Role();
			$form->setInputFilter($role->getInputFilter());
			$form->setData($request->getPost());
	
			if ($form->isValid()) {
				 
				$role->exchangeArray($form->getData());
				$this->getRoleTable()->saveRole($role);
				return $this->redirect()->toRoute('zfcadmin/zfcroleadmin');
			}
		}
		return array('form' => $form);
	}
	
public function editAction()
    {
    	$id = $this->getEvent()->getRouteMatch()->getParam('id');
    	if (!$id) {
    		return $this->redirect()->toRoute('zfcadmin/zfcroleadmin',array(
    				'action' => 'add',
    		));
    	}
    	
    	$role = $this->getRoleTable()->getRole($id);
    	$form = new RoleForm();
    	 
    	$form->bind($role);
    	$form->get('submit')->setAttribute('value', 'Edit Role');
    
    	$request = $this->getRequest();
    	if ($request->isPost()) {
    		//$form->setInputFilter($album->getInputFilter());
    		$form->setData($request->getPost());
    
    		if ($form->isValid()) {
    			 
    			$this->getRoleTable()->saveRole($role);
    			return $this->redirect()->toRoute('zfcadmin/zfcroleadmin');
    		}
    	}
    
    	return array(
    			'form' => $form,
    	);
    }
	
	public function deleteAction()
	{
		$id = $this->getEvent()->getRouteMatch()->getParam('id');
		$results = $this->getRoleTable()->deleteRole($id);
		return $this->redirect()->toRoute('zfcadmin/zfcroleadmin');
	}
}
