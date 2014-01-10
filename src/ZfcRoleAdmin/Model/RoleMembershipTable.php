<?php
namespace ZfcRoleAdmin\Model;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Select;


class RoleMembershipTable
{
    
    protected $tableGateway;
   
    public function __construct(TableGateway $tableGateway)
    {
    	$this->tableGateway = $tableGateway;
    
    }
    

 	public function fetchAll()
    {
    	//NEED THE QUERY TO BE THIS
    	/*
    	 * SELECT user_role_linker.role_id, user_role_linker.user_id, user_role.role_id AS role_name, user.email FROM `user_role_linker`
JOIN user on user_role_linker.user_id = user.user_id
JOIN user_role ON user_role_linker.role_id = user_role.id

$table = $this->tableGateway->getTable();
    	$where = array('parent_product_key' => $product); // If have any criteria
    	$result = $this->tableGateway->select(function (Select $select) use ($where,$table) {
    		$select->join('api_request_variables', $table.'.variable_key = api_request_variables.variable_key');
    		$select->where($where);
    		//echo $select->getSqlString(); // see the sql query
    	});
    	 */
        $resultSet = $this->tableGateway->select(function (Select $select) {
        	//$select->columns(array('role_id','user_id','role_name' =>'role_id','user.email'));
    		$select->join('user', 'user.user_id = user_role_linker.user_id',array('email'));
    		$select->join('user_role', 'user_role.id = user_role_linker.role_id',array('role_name' => 'role_id'));
    		$select->order('email ASC');
    		//$select->where($where);
    		//echo $select->getSqlString(); // see the sql query
    	});
        return $resultSet;
    }
    
	public function saveRoleMembership(RoleMembership $rolemembership)
    {
    	$data = array(
    			'user_id'  => $rolemembership->user_id,
    			'role_id' => $rolemembership->role_id,
    	);
    
    	//print_r($data);exit;
    	$this->tableGateway->insert($data);
    	return $this->tableGateway->lastInsertValue;
    }
    
    public function deleteRoleMembership($id)
    {
    	return $this->tableGateway->delete(array('id'=>$id));
    }
}