<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * FranceMasterListings Controller
 *
 * @property \App\Model\Table\FranceMasterListingsTable $FranceMasterListings
 *
 * @method \App\Model\Entity\FranceMasterListing[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class FranceMasterListingsController extends AppController
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
        $franceMasterListings = $this->paginate($this->FranceMasterListings);

        $this->set(compact('franceMasterListings'));
    }

    /**
     * View method
     *
     * @param string|null $id France Master Listing id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $franceMasterListing = $this->FranceMasterListings->get($id, [
            'contain' => ['Users', 'ExternalProducts', 'FulfillmentCenters']
        ]);

        $this->set('franceMasterListing', $franceMasterListing);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $franceMasterListing = $this->FranceMasterListings->newEntity();
        if ($this->request->is('post')) {
            $franceMasterListing = $this->FranceMasterListings->patchEntity($franceMasterListing, $this->request->getData());
            if ($this->FranceMasterListings->save($franceMasterListing)) {
                $this->Flash->success(__('The france master listing has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The france master listing could not be saved. Please, try again.'));
        }
        $users = $this->FranceMasterListings->Users->find('list', ['limit' => 200]);
        $externalProducts = $this->FranceMasterListings->ExternalProducts->find('list', ['limit' => 200]);
        $fulfillmentCenters = $this->FranceMasterListings->FulfillmentCenters->find('list', ['limit' => 200]);
        $this->set(compact('franceMasterListing', 'users', 'externalProducts', 'fulfillmentCenters'));
    }

    /**
     * Edit method
     *
     * @param string|null $id France Master Listing id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $franceMasterListing = $this->FranceMasterListings->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $franceMasterListing = $this->FranceMasterListings->patchEntity($franceMasterListing, $this->request->getData());
            if ($this->FranceMasterListings->save($franceMasterListing)) {
                $this->Flash->success(__('The france master listing has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The france master listing could not be saved. Please, try again.'));
        }
        $users = $this->FranceMasterListings->Users->find('list', ['limit' => 200]);
        $externalProducts = $this->FranceMasterListings->ExternalProducts->find('list', ['limit' => 200]);
        $fulfillmentCenters = $this->FranceMasterListings->FulfillmentCenters->find('list', ['limit' => 200]);
        $this->set(compact('franceMasterListing', 'users', 'externalProducts', 'fulfillmentCenters'));
    }

    /**
     * Delete method
     *
     * @param string|null $id France Master Listing id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $franceMasterListing = $this->FranceMasterListings->get($id);
        if ($this->FranceMasterListings->delete($franceMasterListing)) {
            $this->Flash->success(__('The france master listing has been deleted.'));
        } else {
            $this->Flash->error(__('The france master listing could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
