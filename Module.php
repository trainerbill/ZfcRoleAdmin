<?php
namespace ZfcRoleAdmin;

use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use ZfcRoleAdmin\Model\Role;
use ZfcRoleAdmin\Model\RoleTable;
use ZfcRoleAdmin\Model\RoleMembership;
use ZfcRoleAdmin\Model\RoleMembershipTable;

class Module implements AutoloaderProviderInterface
{
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
		    // if we're in a namespace deeper than one level we need to fix the \ in the path
                    __NAMESPACE__ => __DIR__ . '/src/' . str_replace('\\', '/' , __NAMESPACE__),
                ),
            ),
        );
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function onBootstrap(MvcEvent $e)
    {
        // You may not need to do this if you're doing it elsewhere in your
        // application
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
        
        
    }
    
    public function getServiceConfig()
    {
    	
		return array(
			'factories' => array(
					'ZfcRoleAdmin\Model\RoleTable' => function ($sm) {
					$tableGateway = $sm->get ( 'ZfcRoleAdminTableGateway' );
					$table = new RoleTable ( $tableGateway );
					return $table;
					},
						
					'ZfcRoleAdminTableGateway' => function ($sm) {
					$dbAdapter = $sm->get ( 'Zend\Db\Adapter\Adapter' );
					$resultSetPrototype = new ResultSet ();
					$resultSetPrototype->setArrayObjectPrototype ( new Role());
					return new TableGateway ( 'user_role', $dbAdapter, NULL, $resultSetPrototype );
					},
					
					'ZfcRoleAdmin\Model\RoleMembershipTable' => function ($sm) {
					$tableGateway = $sm->get ( 'ZfcRoleMembershipTableGateway' );
					$table = new RoleMembershipTable ( $tableGateway );
					return $table;
					},
					
					'ZfcRoleMembershipTableGateway' => function ($sm) {
					$dbAdapter = $sm->get ( 'Zend\Db\Adapter\Adapter' );
					$resultSetPrototype = new ResultSet ();
					$resultSetPrototype->setArrayObjectPrototype ( new RoleMembership());
					return new TableGateway ( 'user_role_linker', $dbAdapter, NULL, $resultSetPrototype );
					},
					
					
			
			),		
		);
    	
    	
    }
    
   
}
