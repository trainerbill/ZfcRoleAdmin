<?php
namespace ZfcRoleAdmin\Model;

use Zend\Db\TableGateway\TableGateway;


class RoleTable
{
    
    protected $tableGateway;
   
    public function __construct(TableGateway $tableGateway)
    {
    	$this->tableGateway = $tableGateway;
    
    }
    

 	public function fetchAll()
    {
        $resultSet = $this->tableGateway->select();
        return $resultSet;
    }
    
    public function getRole($id)
    {
    	$resultSet = $this->tableGateway->select(array('id'=>$id));
    	return $resultSet->current();
    }
    
	public function saveRole(Role $role)
    {
    	$data = array(
    			'role_id' => $role->role_id,
    			'is_default'  => $role->is_default,
    			'parent_id'  => (($role->parent_id == '') ? NULL : $role->parent_id),
    	);
    
    	$id = (int)$role->id;
    	if ($id == 0)
    	{
    		$this->tableGateway->insert($data);
    		return $this->getRole($this->tableGateway->lastInsertValue);
    	}
    	else
    	{
    		$this->tableGateway->update($data, array('id' => $id));
    		return $this->getRole($id);	
    	}
    }
    
    public function deleteRole($id)
    {
    	return $this->tableGateway->delete(array('id'=>$id));
    }
}