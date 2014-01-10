<?php
namespace ZfcRoleAdmin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Session\Container;
use Zend\Stdlib\Parameters;
use ZfcRoleAdmin\Form\RoleMembershipForm;
use ZfcRoleAdmin\Model\RoleMembership;

class ZfcRoleMembershipController extends AbstractActionController
{
	protected $RoleTable;
	protected $UserTable;
	protected $RoleMembershipTable;
	
	public function getRoleMembershipTable()
	{
		if (!$this->RoleMembershipTable) {
			$sm = $this->getServiceLocator();
			$this->RoleMembershipTable = $sm->get('ZfcRoleAdmin\Model\RoleMembershipTable');
		}
		return $this->RoleMembershipTable;	
	}
	
	public function getRoleTable()
	{
		if (!$this->RoleTable) {
			$sm = $this->getServiceLocator();
			$this->RoleTable = $sm->get('ZfcRoleAdmin\Model\RoleTable');
		}
		return $this->RoleTable;
	}
	
	public function getUserTable()
	{
		if (!$this->UserTable) {
			$sm = $this->getServiceLocator();
			$this->UserTable = $sm->get('zfcuser_user_mapper');
		}
		return $this->UserTable;
	}
	
	
	public function indexAction()
	{
		$memberships = $this->getRoleMembershipTable()->fetchAll();
		return new ViewModel(array('memberships'=>$memberships));
	}
	
	public function addAction()
	{
		$form = new RoleMembershipForm();
		$request = $this->getRequest();
		$roles = $this->getRoleTable()->fetchAll();
		$rroles = array();
		foreach($roles as $role)
			$rroles[$role->id] = $role->role_id;
		$users = $this->getUserTable()->findAll();
		$rusers = array();
		foreach($users as $user)
			$rusers[$user->getId()] = $user->getEmail();
		
		$rroles = array(''=>'') + $rroles;
		$rusers= array(''=>'') + $rusers;
		$form->get('role_id')->setAttribute('options', $rroles);
		$form->get('user_id')->setAttribute('options', $rusers);
		
		if ($request->isPost()) {
			$rolemembership = new RoleMembership();
			//$form->setInputFilter($ec->getInputFilter());
			$form->setData($request->getPost());
	
			if ($form->isValid()) {
				 
				$rolemembership->exchangeArray($form->getData());
				$this->getRoleMembershipTable()->saveRoleMembership($rolemembership);
				return $this->redirect()->toRoute('zfcadmin/zfcrolemembership');
			}
		}
		return array('form' => $form);
	}
	
	public function deleteAction()
	{
		$id = $this->getEvent()->getRouteMatch()->getParam('id');
		$results = $this->getRoleMembershipTable()->deleteRoleMembership($id);
		return $this->redirect()->toRoute('zfcadmin/zfcrolemembership');
	}
}
