<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\User[] paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{

				public function beforeFilter(Event $event)
                    {
                    parent::beforeFilter($event);

                    $this->Auth->allow(['add', 'logout','index']);
              		  }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
	 
    public function index()
    {
		$this->set('title', 'User details.');
		
        $users = $this->paginate($this->Users);

        $this->set(compact('users'));
        $this->set('_serialize', ['users']);
    }

	/**
     * login method
     *
     * @return \Cake\Http\Response|null
     */         

                    public function login(){
                        
                         $this->set('title', 'User login.');
                         
                         $this->viewBuilder()->setLayout('admin');
                         
                        if ($this->request->is('post')) {
                        // debug($this->Auth->identify());die();
                            $user = $this->Auth->identify();
							
						//	$this->request->session()->write('User.username',$user);
                            /*if ($user != false) {
                             
                                $this->Auth->setUser($user);
                                if ($this->Auth->authenticationProvider()->needsPasswordRehash()) {
                                    $user = $this->Users->get($this->Auth->user('id'));									
                                    $user->password = $this->request->data('password');                                   
                                    $this->Users->save($user);
                                }
                                return $this->redirect($this->Auth->redirectUrl());
                            }else{
								
								$this->Flash->set('Invalid username or password,try again', ['element' => 'error']);
                              
                            }*/
                        }
                    }
    
    
                
    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => ['Topics']
        ]);

        $this->set('user', $user);
        $this->set('_serialize', ['user']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
		$this->set('title', 'Add User');
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
				$this->Flash->set('The user has been saved!', ['element' => 'success']);
                
                return $this->redirect(['action' => 'index']);
            }
			$this->Flash->set('The user could not be saved. Please, try again.!', ['element' => 'error']);
               
           
        }
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
		$this->set('title', 'User detail Update.');
		
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['get', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
	
	/**
     * Logout method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
	 
	
	    public function logout(){
	    	
	    	$this->viewBuilder()->setLayout('admin');
	    	
                    $session = $this->request->session();
					$session->destroy();
					$this->Auth->logout();                   
					$this->Flash->set('The User has been logout!', ['element' => 'success']);
                   return $this->redirect($this->Auth->logout());
                }
}
