<?
class AccessComponent extends Object{
	var $components = array('Acl', 'Auth');
	var $user;
	

	
	function checkHelper($aro, $aco, $action = "*"){
		App::import('Component', 'Acl');
		$acl = new AclComponent();
		
	}
}
?>