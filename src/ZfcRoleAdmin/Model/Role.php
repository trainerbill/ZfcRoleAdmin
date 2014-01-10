<?php
namespace ZfcRoleAdmin\Model;

use Zend\InputFilter\Factory as InputFactory;     
use Zend\InputFilter\InputFilter;                
use Zend\InputFilter\InputFilterAwareInterface;   
use Zend\InputFilter\InputFilterInterface;        

class Role
{
    public $id;
    public $role_id;
    public $is_default;
    public $parent_id;
    
    public function __construct()
    {
    	
    }
    
    public function exchangeArray($data)
    {
    	$this->id    = (isset($data['id'])) ? $data['id'] : null;
        $this->role_id    = (isset($data['role_id'])) ? $data['role_id'] : null;
        $this->is_default = (isset($data['is_default'])) ? $data['is_default'] : null;
        $this->parent_id  = (isset($data['parent_id'])) ? $data['parent_id'] : null;
    }
    
    public function getArrayCopy()
    {
    	return get_object_vars($this);
    }

    public function getInputFilter()
    {
    	if (!$this->inputFilter) {
    		$inputFilter = new InputFilter();
    		$factory     = new InputFactory();
    
    		$inputFilter->add($factory->createInput(array(
    				'name'     => 'is_default',
    				'required' => true,
    				'filters'  => array(
    						array('name' => 'StripTags'),
    						array('name' => 'StringTrim'),
    				),
    				'validators' => array(
    						array(
    								'name'    => 'Between',
    								'options' => array(
    										'min' => 0,
    										'max'      => 1,
    										'inclusive'      => true,
    								),
    						),
    				),
    		)));
    
    		$inputFilter->add($factory->createInput(array(
    				'name'     => 'parent_id',
    				'required' => false,
    				'filters'  => array(
    						array('name' => 'StripTags'),
    						array('name' => 'StringTrim'),
    				),
    				'validators' => array(
    						array(
    								'name'    => 'GreaterThan',
    								'options' => array(
    						
    										'min'      => 0,
    										'inclusive'      => false,
    								),
    						),
    				),
    		)));
    
    		$inputFilter->add($factory->createInput(array(
    				'name'     => 'role_id',
    				'required' => true,
    				'filters'  => array(
    						array('name' => 'StripTags'),
    						array('name' => 'StringTrim'),
    				),
    				'validators' => array(
    						array(
    								'name'    => 'StringLength',
    								'options' => array(
    										'encoding' => 'UTF-8',
    										'min'      => 1,
    										'max'      => 255,
    								),
    						),
    				),
    		)));
    
    		$this->inputFilter = $inputFilter;
    	}
    
    	return $this->inputFilter;
    }
    
}