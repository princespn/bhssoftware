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
        $this->Auth->loginRedirect = array('controller' => 'main_listings', 'action' => 'index');
        $this->Auth->Session->start();
        $this->Session->activate();	
       // $this->Cookie->secure = false;
       // $auth = $this->Auth->user();                                 
                    
        
    }

	function stockdate(){
		
		//$date = date('Y-m-d',strtotime("-1 days"));					
		$date = '2018-07-04';
		return $date;
}

}