<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\View\View;
use Cake\View\ViewBuilder;

/**
 * AdminListings Controller
 *
 * @property \App\Model\Table\AdminListingsTable $AdminListings
 *
 * @method \App\Model\Entity\AdminListing[] paginate($object = null, array $settings = [])
 */
class AdminListingsController extends AppController
{


    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
		$this->set('title', 'Master website prices details.');
		
		//debug($this->request->data['submit']); die();
		
		 if ((!empty($this->request->data['submit'])) && (!empty($this->request->data['all_item']))) {
			 
			 $linkwebsku = $this->request->data['all_item'];
			 
			   $this->paginate = [
			   'contain' => ['InventoryCodes'],
        'conditions' => [
            'AdminListings.linnworks_code LIKE' => '%' . $linkwebsku . '%'
						]
					];
			 
			 
	}else if ((!empty($this->request->data['exports'])) && (!empty($this->request->data['checkid']))) {
		
		 $checkboxid = $this->request->data['checkid'];
       		
		$this->response->download('export.csv');
		$data = $this->AdminListings->find('all')->toArray();
		//$data = $this->AdminListing->find('all', array('AdminListing.id ASC', 'conditions' => array('AdminListing.id' => $checkboxid))));
           
		$_serialize = 'data';
   		$this->set(compact('data', '_serialize'));
		$this->viewBuilder()->className('CsvView.Csv');
		return;

      	
		
		
	}else{
		
		$this->paginate = [
            'contain' => ['InventoryCodes']
        ];
	}
        $adminListings = $this->paginate($this->AdminListings);

        $this->set(compact('adminListings'));
        $this->set('_serialize', ['adminListings']);
    }

    /**
     * View method
     *
     * @param string|null $id Admin Listing id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $adminListing = $this->AdminListings->get($id, [
            'contain' => []
        ]);

        $this->set('adminListing', $adminListing);
        $this->set('_serialize', ['adminListing']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $adminListing = $this->AdminListings->newEntity();
        if ($this->request->is('post')) {
            $adminListing = $this->AdminListings->patchEntity($adminListing, $this->request->getData());
            if ($this->AdminListings->save($adminListing)) {
                $this->Flash->success(__('The admin listing has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The admin listing could not be saved. Please, try again.'));
        }
        $this->set(compact('adminListing'));
        $this->set('_serialize', ['adminListing']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Admin Listing id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
		$this->set('title', 'Update Master website prices details.');
		
        $adminListing = $this->AdminListings->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $adminListing = $this->AdminListings->patchEntity($adminListing, $this->request->getData());
            if ($this->AdminListings->save($adminListing)) {
                $this->Flash->success(__('The admin listing has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The admin listing could not be saved. Please, try again.'));
        }
        $this->set(compact('adminListing'));
        $this->set('_serialize', ['adminListing']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Admin Listing id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $adminListing = $this->AdminListings->get($id);
        if ($this->AdminListings->delete($adminListing)) {
            $this->Flash->success(__('The admin listing has been deleted.'));
        } else {
            $this->Flash->error(__('The admin listing could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
