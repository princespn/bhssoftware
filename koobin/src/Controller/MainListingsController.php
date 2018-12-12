<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * MainListings Controller
 *
 * @property \App\Model\Table\MainListingsTable $MainListings
 *
 * @method \App\Model\Entity\MainListing[] paginate($object = null, array $settings = [])
 */
class MainListingsController extends AppController
{


    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
		$this->set('title', 'Diagonasis prices details.');
		
		$categories = $this->categname();
		
		 if ((!empty($this->request->data['submit'])) && (!empty($this->request->data['all_item']))) {
			 
			 $linkwebsku = $this->request->data['all_item'];
			 		
		 $this->paginate = [
			   'contain' => ['InventoryCodes'],
        'conditions' => [
            'MainListings.linnworks_code LIKE' => '%' . $linkwebsku . '%'
						]
					];
					
		}else if ((!empty($this->request->data['exports'])) && (!empty($this->request->data['checkid']))) {
		
		 $checkboxid = $this->request->data['checkid'];
       		
		$this->response->download('export.csv');
		$data = $this->MainListings->find('all')->toArray();
		//$data = $this->MainListings->find('all', array('MainListings.id ASC', 'conditions' => array('MainListings.id' => $checkboxid))));
           
		$_serialize = 'data';
   		$this->set(compact('data', '_serialize'));
		$this->viewBuilder()->className('CsvView.Csv');
		return;
		
		}else {
			$this->paginate = [
            'contain' => ['InventoryCodes']
        ];
		
		}
		
        $mainListings = $this->paginate($this->MainListings);

		//print_r($mainListings);die();
        $this->set(compact('mainListings','categories'));
        $this->set('_serialize', ['mainListings']);
    }

    /**
     * View method
     *
     * @param string|null $id Main Listing id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $mainListing = $this->MainListings->get($id, [
            'contain' => ['InventoryCodes']
        ]);

        $this->set('mainListing', $mainListing);
        $this->set('_serialize', ['mainListing']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $mainListing = $this->MainListings->newEntity();
        if ($this->request->is('post')) {
            $mainListing = $this->MainListings->patchEntity($mainListing, $this->request->getData());
            if ($this->MainListings->save($mainListing)) {
                $this->Flash->success(__('The main listing has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The main listing could not be saved. Please, try again.'));
        }
        $channels = $this->MainListings->Channels->find('list', ['limit' => 200]);
        $this->set(compact('mainListing', 'channels'));
        $this->set('_serialize', ['mainListing']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Main Listing id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
	 
    public function edit($id = null)
    {
        $mainListing = $this->MainListings->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $mainListing = $this->MainListings->patchEntity($mainListing, $this->request->getData());
            if ($this->MainListings->save($mainListing)) {
                $this->Flash->success(__('The main listing has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The main listing could not be saved. Please, try again.'));
        }
        $channels = $this->MainListings->Channels->find('list', ['limit' => 200]);
        $this->set(compact('mainListing', 'channels'));
        $this->set('_serialize', ['mainListing']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Main Listing id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
	 
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $mainListing = $this->MainListings->get($id);
        if ($this->MainListings->delete($mainListing)) {
            $this->Flash->success(__('The main listing has been deleted.'));
        } else {
            $this->Flash->error(__('The main listing could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
	
	public function importcode()
    {
		
            $this->set('title', 'Import CSV in Database system.');

                if (!empty($this->request->data)) {
                $filename = $this->request->data['file']['name'];
                $fileExt = explode(".", $filename);
                $fileExt2 = end($fileExt);
               // print_r($this->request->data['file']['name']); die();

                if ($fileExt2 == 'csv') {
                if (move_uploaded_file($this->request->data['file']['tmp_name'], WWW_ROOT . '/files/' .$this->request->data['file']['name']))
                $messages = $this->MainListings->importcode($filename);
                $this->Flash->set('Imports data successfully.', ['element' => 'success']);
                if (!empty($messages)) {
                $this->set('anything', $messages);
                Configure::write('debug', '2');
                }
                } else {
					
				$this->Flash->set('File format not supported,Please upload .CSV file format only.', ['element' => 'error']);

                
                }
                } else {
                //$filename = 'Product Code.csv';
                //$messages = Product Code($filename);
                }  

    }
}
