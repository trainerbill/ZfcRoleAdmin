<?php
namespace ZfcRoleAdmin\Form;

use Zend\Form\Form;

class RoleMembershipForm extends Form
{
    public function __construct($name = null)
    {
        // we want to ignore the name passed
        parent::__construct('rolemembersip');
        $this->setAttribute('method', 'post');
       
        
        
        $this->add(array(
        		'type' => 'Zend\Form\Element\Select',
        		'name' => 'user_id',
        		'options' => array(
        			'label' => 'User',
                     'value_options' => array(
                             
                     ),
             	)
        ));
        
        
         $this->add(array(
        		'type' => 'Zend\Form\Element\Select',
        		'name' => 'role_id',
        		'options' => array(
        			'label' => 'Role',
                     'value_options' => array(
                            
                     ),
             	)
        ));
         
         $this->add(array(
         		'name' => 'submit',
         		'attributes' => array(
         				'type'  => 'submit',
         				'value' => 'Save Role Membership',
         				'id' => 'submitbutton',
         				'class' => 'btn',
         		),
         ));
    }
}