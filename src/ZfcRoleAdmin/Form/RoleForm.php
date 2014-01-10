<?php
namespace ZfcRoleAdmin\Form;

use Zend\Form\Form;
use Zend\Form\Element\Select;


class RoleForm extends Form
{
    public function __construct($name = null)
    {
        // we want to ignore the name passed
        parent::__construct('role');
        $this->setAttribute('method', 'post');
        
       
        $this->add(array(
        		'name' => 'id',
        		'attributes' => array(
        				'type'  => 'text',
        		),
        		'options' => array(
        				'label' => 'Role ID',
        		),
        ));
        $this->add(array(
        		'name' => 'role_id',
        		'attributes' => array(
        				'type'  => 'text',
        		),
        		'options' => array(
        				'label' => 'Role Name',
        		),
        ));
        
        $this->add(array(
        		'name' => 'is_default',
        		'attributes' => array(
        				'type'  => 'text',
        		),
        		'options' => array(
        				'label' => 'Is Default',
        		),
        ));
        
         $this->add(array(
        		'name' => 'parent_id',
        		'attributes' => array(
        				'type'  => 'text',
        		),
        		'options' => array(
        				'label' => 'Parent ID',
        		),
        ));
        
        
        
        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type'  => 'submit',
                'value' => 'Add Role',
                'id' => 'submitbutton',
            	'class' => 'btn',
            ),
        ));
    }
}