<?php 

class UsersController extends AppController 
		{
	var $name = 'Users';
	var $components = array('Acl', 'Auth', 'Session');
	var $helpers = array('Access','Js','Javascript');
	
	function beforeFilter() 
				{    
		parent::beforeFilter();
	$this->Auth->allow(array('login','logout','index','edit','view','groups'));
		$this->Auth->userModel = 'User';  
       //$this->Auth->allow('*');  
   		$this->Session->activate();
				}
	
		
					/**
	 * ==========================================================
	 * INT_DB
	 * ==========================================================
	 * 

		function initDB() {
            $group =& $this->User->Group;

            //Allow admins to everything
            $group->id = 1;
            $this->Acl->allow($group, 'controllers');

            //allow managers to Projects edit and user add
            $group->id = 2;
            $this->Acl->allow($group, 'controllers');
            $this->Acl->deny($group, 'controllers/Users/edit');
            $this->Acl->deny($group, 'controllers/Projects/add');
            $this->Acl->deny($group, 'controllers/Projects/viewc');
           
            //allow users to only view
            $group->id = 3;
            $this->Acl->deny($group, 'controllers');
            $this->Acl->allow($group, 'controllers/Projects/view');
            
             //allow sales to Projects edit and user add
             
            $group->id = 4;
            $this->Acl->allow($group, 'controllers');
            $this->Acl->deny($group, 'controllers/Users/edit');
                        
            //allow users to only view
            
            $group->id = 5;
            $this->Acl->allow($group, 'controllers');
            $this->Acl->deny($group, 'controllers/Users/index');
            $this->Acl->deny($group, 'controllers/Users/add');
            $this->Acl->deny($group, 'controllers/Users/edit');
            $this->Acl->deny($group, 'controllers/Projects/add');
            
            //allow users to only view
            $group->id = 6;
            $this->Acl->deny($group, 'controllers');
            $this->Acl->allow($group, 'controllers/Users/team');
            $this->Acl->allow($group, 'controllers/Projects/view');
            $this->Acl->allow($group, 'controllers/Projects/viewc');
            $this->Acl->allow($group, 'controllers/Projects/coment');
            $this->Acl->allow($group, 'controllers/Infringements/viewevalution');
            $this->Acl->allow($group, 'controllers/Searches/viewsearch');
            $this->Acl->allow($group, 'controllers/Pharmas/viewpharma');
            $this->Acl->allow($group, 'controllers/Landscapes/viewlandscape');
            $this->Acl->allow($group, 'controllers/Timesheets/add');
            $this->Acl->allow($group, 'controllers/Timesheets/edit');
            $this->Acl->allow($group, 'controllers/Timesheets/view');           
          
            
            //allow users to only view
            $group->id = 7;
            $this->Acl->deny($group, 'controllers');
            $this->Acl->allow($group, 'controllers/Users/team');
            $this->Acl->allow($group, 'controllers/Projects/view');
            $this->Acl->allow($group, 'controllers/Projects/viewc');
            $this->Acl->allow($group, 'controllers/Projects/coment');
             $this->Acl->allow($group, 'controllers/Infringements/viewevalution');
            $this->Acl->allow($group, 'controllers/Searches/viewsearch');
            $this->Acl->allow($group, 'controllers/Pharmas/viewpharma');
            $this->Acl->allow($group, 'controllers/Landscapes/viewlandscape');     
			$this->Acl->allow($group, 'controllers/Timesheets/add');
            $this->Acl->allow($group, 'controllers/Timesheets/edit');
            $this->Acl->allow($group, 'controllers/Timesheets/view');           
          

            //we add an exit to avoid an ugly "missing views" error message
            echo "all done";
            exit;
		}	*/
		 
			function login() {
				if (!empty($this->data))
				 {
					if ($this->Auth->login($this->data)) 
							{
						$this->redirect(array('controller' => 'projects', 'action' => 'index'));
							} 
					else 
							{
						$this->Session->setFlash('Your username or password was incorrect.');
							}
					}
								}

function logout()
    {
  
    		
    		$this->Session->destroy();
    		//$this->redirect($this->facebook->getLogoutUrl($params));
    
    	
       $this->Session->setFlash('You have succesfully logged out');
       $this->redirect($this->Auth->logout());
      
    }




    function add() {
		if (!empty($this->data)) {
			$this->User->create();
			if ($this->User->save($this->data)) {
				$this->Session->setFlash(__('The Users was created successfully.', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->data = null;
				$this->Session->setFlash(__('The Users was not created. Please check the fields and try again.', true));
				
			}
		}
		$groups = $this->User->Group->find('list');
		$this->set(compact('groups'));
	}

						
						
		function index() {
				$this->User->recursive = 1;
				$this->paginate = array('limit' => 1000,'totallimit' => 2000,'order'=>'User.created  desc');
				$this->set('users', $this->paginate());
					
				
			}
			
	function view($id = null) {
						if (!$id) {
							$this->Session->setFlash(__('Invalid user', true));
							$this->redirect(array('action' => 'index'));
						}
						$this->set('user', $this->User->read(null, $id));
					}
	function edit($id = null) 
	{
			if (!$id && empty($this->data))
			 {
			$this->Session->setFlash(__('Invalid user', true));
			$this->redirect(array('action' => 'index'));
			}
			if (!empty($this->data))
				 {
			 $user = $this->Session->read('User.username');
			  $someone = $this->User->findById($this->User->id);
					if (!empty($this->data['User']['new_password']))
							{
								if($this->data['User']['new_password'] != $this->data['User']['confirm_password']) 
								{
								$this->Session->setFlash(__('Your passwords do not match.', true));
								}
								else
								{
								$newpass = $this->Auth->password($this->data['User']['new_password']);
								$this->data['User']['password'] = $newpass;
									if ($this->User->save($this->data))
									{
									$this->Session->setFlash(__('The user has been updated successfully.', true));
									$this->redirect(array('action' => 'index'));
									} 
									else
									{
									$this->Session->setFlash(__('ERROR!! Please check the fields and try again.', true));
									}
								}												
				}			
			else
			{
				if ($this->User->save($this->data))
				{
				$this->Session->setFlash(__('The user has been updated successfully.', true));
				$this->redirect(array('action' => 'index'));
				} 
				else
				{
				$this->Session->setFlash(__('ERROR!! Please check the fields and try again.', true));
				}	
			}
	}
			if (empty($this->data))
			{
			$this->data = $this->User->read(null, $id);
			}
			$groups = $this->User->Group->find('list');
			$this->set(compact('groups'));
}
	
	function forgatepw ($id = null)
		{
			$id = $this->authUser['User']['user_id'];
			if (!$id && empty($this->data))
			{
				$this->Session->setFlash(__('Invalid user', true));
				$this->redirect(array('action' => 'index'));
			}
				unset($this->User->validate['password_confirm']);
				unset($this->User->validate['password']);
		     
				if (!empty($this->data))
				{  
				$this->data['User']['username'] 	= $this->authUser['User']['username'];		  
				$password = $this->data['User']['password'] ;
		   
					if(!empty($this->data['User']['old_password']))
					{
					$this->data['User']['password'] = $this->Auth->password($this->data['User']['password']);
					}
		   
					$this->data['User']['user_id'] 	= $this->authUser['User']['user_id'];
					$this->data['User']['email'] 	= $this->authUser['User']['email']; 
		   
					if ($this->User->userUpdate($this->data)) 
						{
							$this->Session->setFlash(__('The user has been saved', true));
							$this->redirect(array('action' => 'view'));
						} 
					else 
						{
							$this->Session->setFlash(__('The user could not be saved. Please, try again.', true));
							$this->data['User']['password'] = $password;
						}
					}
		
				if (empty($this->data)) 
				{
					$data = $this->User->read(null, $id);
					unset($data['User']['password']);
					$this->data = $data;
				}
	}

	function delete($id = null) {
					if (!$id) {
						$this->Session->setFlash(__('Invalid id for user', true));
						$this->redirect(array('action'=>'index'));
					}
					if ($this->User->delete($id)) {
						$this->Session->setFlash(__('The user was deleted successfully!', true));
						$this->redirect(array('action'=>'index'));
					}
					$this->Session->setFlash(__('ERROR!! The user could not be deleted!', true));
					$this->redirect(array('action' => 'index'));
				}

		function team() {
		$this->User->recursive = 1;
		//pr($this->Project->find('all'));
		$this->paginate = array('limit' => 1000,'totallimit' => 2000,'order'=>'User.team_id  ASC');
		$this->set('users', $this->paginate());
			
		//$this->User->recursive = 0;
		//$this->set('users', $this->paginate());
	}		

		}
