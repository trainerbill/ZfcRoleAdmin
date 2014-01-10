<?php
return array(
	'controllers' => array(
			'invokables' => array(
					'ZfcRoleAdmin\Controller\ZfcRoleAdmin' => 'ZfcRoleAdmin\Controller\ZfcRoleAdminController',
					'ZfcRoleAdmin\Controller\ZfcRoleMembership' => 'ZfcRoleAdmin\Controller\ZfcRoleMembershipController',
			),
	),
		
	'bjyauthorize' => array(
			'guards' => array(
					'BjyAuthorize\Guard\Controller' => array(
							array('controller' => 'ZfcRoleAdmin\Controller\ZfcRoleAdmin', 'roles' => array('admin')),
							array('controller' => 'ZfcRoleAdmin\Controller\ZfcRoleMembership', 'roles' => array('admin')),
					),
			),
	),
		
	'router' => array(
    	'routes' => array(
    		
    		'zfcadmin' => array(
    			'may_terminate' => true,
    			'child_routes' => array(
    				'zfcroleadmin' => array(
    					'type' => 'segment',
    					'options' => array(
    						'route'    => '/roles[/:action[/:id]]',
    						'constraints' => array(
    							'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
    							'id'     => '[0-9]+',
    						),
    						'defaults' => array(
    							'__NAMESPACE__' => 'ZfcRoleAdmin\Controller',
    							'controller' => 'ZfcRoleAdmin',
    							'action'     => 'index',
    						),
    					),
    				),
    					
    				'zfcrolemembership' => array(
    					'type' => 'segment',
    					'options' => array(
    						'route'    => '/rolemembership[/:action[/:id]]',
    						'constraints' => array(
    							'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
    							'id'     => '[0-9]+',
    						),
    						'defaults' => array(
    							'__NAMESPACE__' => 'ZfcRoleAdmin\Controller',
    							'controller' => 'ZfcRoleMembership',
    							'action'     => 'index',
    						),
    					),
    				),
    			),
    		),
    			
    		
    	),
	),
		
		
		
	'navigation' => array(
        'admin' => array(
            'zfcroleadmin' => array(
                'label' => 'Roles',
                'route' => 'zfcadmin/zfcroleadmin',
            	'action' => 'index',
                'pages' => array(
                    //'create' => array(
                    //    'label' => 'New User',
                    //    'route' => 'admin/create',
                    //),
                ),
            ),
        	'zfcrolemembership' => array(
        		'label' => 'Role Membership',
        		'route' => 'zfcadmin/zfcrolemembership',
        		'action' => 'index',
        		'pages' => array(
        						
        		),
        	),
        ),
    ),
		
	'view_manager' => array(
			'template_path_stack' => array(
					'zfcroleadmin' => __DIR__ . '/../view',
			),
	),
 		
);