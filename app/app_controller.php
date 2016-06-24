<?php 

class AppController extends Controller 
{
    var $components = array('Acl', 'Auth', 'Session','RequestHandler','LoadsysAuth');
    var $helpers = array('Html', 'Form', 'Session','Javascript','Ajax');
    var $persistModel = true;


    function beforeFilter() {
        $this->Auth->authorize = 'actions';
        $this->Auth->loginAction = array('controller' => 'users', 'action' => 'login');
        $this->Auth->logoutRedirect = array('controller' => 'users', 'action' => 'login');
        $this->Auth->loginRedirect = array('controller' => 'inventory_masters', 'action' => 'index');
        $this->Auth->Session->start();
		$this->Session->activate();	
       // $this->Cookie->secure = false;
       // $auth = $this->Auth->user();                                 
                    
        
    }							

}
