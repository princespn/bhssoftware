<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * EnglishListings Controller
 *
 * @property \App\Model\Table\EnglishListingsTable $EnglishListings
 *
 * @method \App\Model\Entity\EnglishListing[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class EnglishListingsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users', 'ExternalProducts', 'FulfillmentCenters']
        ];
        $englishListings = $this->paginate($this->EnglishListings);

        $this->set(compact('englishListings'));
    }

    /**
     * View method
     *
     * @param string|null $id English Listing id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $englishListing = $this->EnglishListings->get($id, [
            'contain' => ['Users', 'ExternalProducts', 'FulfillmentCenters']
        ]);

        $this->set('englishListing', $englishListing);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $englishListing = $this->EnglishListings->newEntity();
        if ($this->request->is('post')) {
            $englishListing = $this->EnglishListings->patchEntity($englishListing, $this->request->getData());
            if ($this->EnglishListings->save($englishListing)) {
                $this->Flash->success(__('The english listing has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The english listing could not be saved. Please, try again.'));
        }
        $users = $this->EnglishListings->Users->find('list', ['limit' => 200]);
        $externalProducts = $this->EnglishListings->ExternalProducts->find('list', ['limit' => 200]);
        $fulfillmentCenters = $this->EnglishListings->FulfillmentCenters->find('list', ['limit' => 200]);
        $this->set(compact('englishListing', 'users', 'externalProducts', 'fulfillmentCenters'));
    }

    /**
     * Edit method
     *
     * @param string|null $id English Listing id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $englishListing = $this->EnglishListings->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $englishListing = $this->EnglishListings->patchEntity($englishListing, $this->request->getData());
            if ($this->EnglishListings->save($englishListing)) {
                $this->Flash->success(__('The english listing has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The english listing could not be saved. Please, try again.'));
        }
        $users = $this->EnglishListings->Users->find('list', ['limit' => 200]);
        $externalProducts = $this->EnglishListings->ExternalProducts->find('list', ['limit' => 200]);
        $fulfillmentCenters = $this->EnglishListings->FulfillmentCenters->find('list', ['limit' => 200]);
        $this->set(compact('englishListing', 'users', 'externalProducts', 'fulfillmentCenters'));
    }

    /**
     * Delete method
     *
     * @param string|null $id English Listing id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $englishListing = $this->EnglishListings->get($id);
        if ($this->EnglishListings->delete($englishListing)) {
            $this->Flash->success(__('The english listing has been deleted.'));
        } else {
            $this->Flash->error(__('The english listing could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
