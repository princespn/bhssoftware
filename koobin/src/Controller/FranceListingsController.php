<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * FranceListings Controller
 *
 * @property \App\Model\Table\FranceListingsTable $FranceListings
 *
 * @method \App\Model\Entity\FranceListing[] paginate($object = null, array $settings = [])
 */
class FranceListingsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users', 'ExternalProducts', 'FulfillmentCenters']
        ];
        $franceListings = $this->paginate($this->FranceListings);

        $this->set(compact('franceListings'));
        $this->set('_serialize', ['franceListings']);
    }

    /**
     * View method
     *
     * @param string|null $id France Listing id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $franceListing = $this->FranceListings->get($id, [
            'contain' => ['Users', 'ExternalProducts', 'FulfillmentCenters']
        ]);

        $this->set('franceListing', $franceListing);
        $this->set('_serialize', ['franceListing']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $franceListing = $this->FranceListings->newEntity();
        if ($this->request->is('post')) {
            $franceListing = $this->FranceListings->patchEntity($franceListing, $this->request->getData());
            if ($this->FranceListings->save($franceListing)) {
                $this->Flash->success(__('The france listing has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The france listing could not be saved. Please, try again.'));
        }
        $users = $this->FranceListings->Users->find('list', ['limit' => 200]);
        $externalProducts = $this->FranceListings->ExternalProducts->find('list', ['limit' => 200]);
        $fulfillmentCenters = $this->FranceListings->FulfillmentCenters->find('list', ['limit' => 200]);
        $this->set(compact('franceListing', 'users', 'externalProducts', 'fulfillmentCenters'));
        $this->set('_serialize', ['franceListing']);
    }

    /**
     * Edit method
     *
     * @param string|null $id France Listing id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $franceListing = $this->FranceListings->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $franceListing = $this->FranceListings->patchEntity($franceListing, $this->request->getData());
            if ($this->FranceListings->save($franceListing)) {
                $this->Flash->success(__('The france listing has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The france listing could not be saved. Please, try again.'));
        }
        $users = $this->FranceListings->Users->find('list', ['limit' => 200]);
        $externalProducts = $this->FranceListings->ExternalProducts->find('list', ['limit' => 200]);
        $fulfillmentCenters = $this->FranceListings->FulfillmentCenters->find('list', ['limit' => 200]);
        $this->set(compact('franceListing', 'users', 'externalProducts', 'fulfillmentCenters'));
        $this->set('_serialize', ['franceListing']);
    }

    /**
     * Delete method
     *
     * @param string|null $id France Listing id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $franceListing = $this->FranceListings->get($id);
        if ($this->FranceListings->delete($franceListing)) {
            $this->Flash->success(__('The france listing has been deleted.'));
        } else {
            $this->Flash->error(__('The france listing could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
