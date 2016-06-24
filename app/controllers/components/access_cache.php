<?
/*
	*** IMPORTANT ***
	
	This component uses Cache. You'll have to open config/core.php and append the following line
	
	Cache::config('one day', array('engine' => 'File', 'duration' => 86400));
	
	
	** Notes **
	
	 1. Inflector::slug is used to strip some characters that make Cache throw an error. This is because
		Cache will create a plaintext file with the first argument as name, and since '*' is a forbidden
		character for a filename, the error occurs.
		
	 2.	The local variable $cached will store the data that has already been fetched, in order to reduce
		the load of the repeated requests.
	
*/
class AccessComponent extends Object{
	var $components = array('Acl', 'Auth');
	var $user;
	var $cached;
	
	function startup(){
		$this->user = $this->Auth->user();
	}
	
	function check($aco, $action='*'){
		if(empty($this->user)){
			return false;
		}
		
		if(isset($this->cached['User::'. $this->user['User']['id'] . '/aco:' . $aco . '/action:' . $action])){
			return $this->cached['User::'.$this->user['User']['id'] . '/aco:' . $aco . '/action:' . $action];
		}
		
		$cache = Cache::read(Inflector::slug('acl/' . 'User::'. $this->user['User']['id'] . '/aco:' . $aco . '/action:' . $action), 'one day');
		if(empty($cache)){
			$cache = $this->Acl->check('User::'. $this->user['User']['id'], $aco, $action) ? 'true' : 'false';
			Cache::write(Inflector::slug('acl/' . 'User::'. $this->user['User']['id'] . '/aco:' . $aco . '/action:' . $action), $cache, 'one day');
			$this->cached['User::'. $this->user['User']['id'] . '/aco:' . $aco . '/action:' . $action] = $cache;
		}
		
		return $cache=='true' ? true : false;
	}
	
	function checkHelper($aro, $aco, $action = "*"){
		if(isset($this->cached[$aro . '/aco:' . $aco . '/action:' . $action]))
			return $this->cached[$aro . '/aco:' . $aco . '/action:' . $action] == 'true' ? true : false;
		
		$cache = Cache::read(Inflector::slug('acl/' . $aro . '/aco:' . $aco . '/action:' . $action), 'one day');
		if(empty($cache)){
			$acl = new AclComponent();
			App::import('Component', 'Acl');
			$cache = $acl->check($aro, $aco, $action) ? 'true' : 'false';
			Cache::write(Inflector::slug('acl/' . $aro . '/aco:' . $aco . '/action:' . $action), $cache, 'one day');
			$this->cached[$aro . '/aco:' . $aco . '/action:' . $action] = $cache;
		}
		
		return $cache=='true' ? true : false;
	}
}
?>