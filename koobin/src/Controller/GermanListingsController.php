<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * GermanListings Controller
 *
 * @property \App\Model\Table\GermanListingsTable $GermanListings
 *
 * @method \App\Model\Entity\GermanListing[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class GermanListingsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users', 'ExternalProducts', 'DeliveryScheduleGroups', 'FulfillmentCenters', 'Fedas']
        ];
        $germanListings = $this->paginate($this->GermanListings);

        $this->set(compact('germanListings'));
    }

    /**
     * View method
     *
     * @param string|null $id German Listing id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $germanListing = $this->GermanListings->get($id, [
            'contain' => ['Users', 'ExternalProducts', 'DeliveryScheduleGroups', 'FulfillmentCenters', 'Fedas']
        ]);

        $this->set('germanListing', $germanListing);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $germanListing = $this->GermanListings->newEntity();
        if ($this->request->is('post')) {
            $germanListing = $this->GermanListings->patchEntity($germanListing, $this->request->getData());
            if ($this->GermanListings->save($germanListing)) {
                $this->Flash->success(__('The german listing has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The german listing could not be saved. Please, try again.'));
        }
        $users = $this->GermanListings->Users->find('list', ['limit' => 200]);
        $externalProducts = $this->GermanListings->ExternalProducts->find('list', ['limit' => 200]);
        $deliveryScheduleGroups = $this->GermanListings->DeliveryScheduleGroups->find('list', ['limit' => 200]);
        $fulfillmentCenters = $this->GermanListings->FulfillmentCenters->find('list', ['limit' => 200]);
        $fedas = $this->GermanListings->Fedas->find('list', ['limit' => 200]);
        $this->set(compact('germanListing', 'users', 'externalProducts', 'deliveryScheduleGroups', 'fulfillmentCenters', 'fedas'));
    }

    /**
     * Edit method
     *
     * @param string|null $id German Listing id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $germanListing = $this->GermanListings->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $germanListing = $this->GermanListings->patchEntity($germanListing, $this->request->getData());
            if ($this->GermanListings->save($germanListing)) {
                $this->Flash->success(__('The german listing has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The german listing could not be saved. Please, try again.'));
        }
        $users = $this->GermanListings->Users->find('list', ['limit' => 200]);
        $externalProducts = $this->GermanListings->ExternalProducts->find('list', ['limit' => 200]);
        $deliveryScheduleGroups = $this->GermanListings->DeliveryScheduleGroups->find('list', ['limit' => 200]);
        $fulfillmentCenters = $this->GermanListings->FulfillmentCenters->find('list', ['limit' => 200]);
        $fedas = $this->GermanListings->Fedas->find('list', ['limit' => 200]);
        $this->set(compact('germanListing', 'users', 'externalProducts', 'deliveryScheduleGroups', 'fulfillmentCenters', 'fedas'));
    }

    /**
     * Delete method
     *
     * @param string|null $id German Listing id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $germanListing = $this->GermanListings->get($id);
        if ($this->GermanListings->delete($germanListing)) {
            $this->Flash->success(__('The german listing has been deleted.'));
        } else {
            $this->Flash->error(__('The german listing could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
