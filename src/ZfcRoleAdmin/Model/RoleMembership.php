<?php
namespace ZfcRoleAdmin\Model;

use Zend\InputFilter\Factory as InputFactory;     
use Zend\InputFilter\InputFilter;                
use Zend\InputFilter\InputFilterAwareInterface;   
use Zend\InputFilter\InputFilterInterface;        

class RoleMembership
{
	public $id;
    public $user_id;
    public $email;
    public $role_id;
    public $role_name;
    
    public function __construct()
    {
    	
    }
    
    public function exchangeArray($data)
    {
    	$this->id    = (isset($data['id'])) ? $data['id'] : null;
    	$this->user_id    = (isset($data['user_id'])) ? $data['user_id'] : null;
    	$this->email    = (isset($data['email'])) ? $data['email'] : null;
        $this->role_id    = (isset($data['role_id'])) ? $data['role_id'] : null;
        $this->role_name    = (isset($data['role_name'])) ? $data['role_name'] : null;
    }
    
    public function getArrayCopy()
    {
    	return get_object_vars($this);
    }

}