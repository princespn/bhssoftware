<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * GermanMasterListings Controller
 *
 * @property \App\Model\Table\GermanMasterListingsTable $GermanMasterListings
 *
 * @method \App\Model\Entity\GermanMasterListing[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class GermanMasterListingsController extends AppController
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
        $germanMasterListings = $this->paginate($this->GermanMasterListings);

        $this->set(compact('germanMasterListings'));
    }

    /**
     * View method
     *
     * @param string|null $id German Master Listing id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $germanMasterListing = $this->GermanMasterListings->get($id, [
            'contain' => ['Users', 'ExternalProducts', 'DeliveryScheduleGroups', 'FulfillmentCenters', 'Fedas']
        ]);

        $this->set('germanMasterListing', $germanMasterListing);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $germanMasterListing = $this->GermanMasterListings->newEntity();
        if ($this->request->is('post')) {
            $germanMasterListing = $this->GermanMasterListings->patchEntity($germanMasterListing, $this->request->getData());
            if ($this->GermanMasterListings->save($germanMasterListing)) {
                $this->Flash->success(__('The german master listing has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The german master listing could not be saved. Please, try again.'));
        }
        $users = $this->GermanMasterListings->Users->find('list', ['limit' => 200]);
        $externalProducts = $this->GermanMasterListings->ExternalProducts->find('list', ['limit' => 200]);
        $deliveryScheduleGroups = $this->GermanMasterListings->DeliveryScheduleGroups->find('list', ['limit' => 200]);
        $fulfillmentCenters = $this->GermanMasterListings->FulfillmentCenters->find('list', ['limit' => 200]);
        $fedas = $this->GermanMasterListings->Fedas->find('list', ['limit' => 200]);
        $this->set(compact('germanMasterListing', 'users', 'externalProducts', 'deliveryScheduleGroups', 'fulfillmentCenters', 'fedas'));
    }

    /**
     * Edit method
     *
     * @param string|null $id German Master Listing id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $germanMasterListing = $this->GermanMasterListings->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $germanMasterListing = $this->GermanMasterListings->patchEntity($germanMasterListing, $this->request->getData());
            if ($this->GermanMasterListings->save($germanMasterListing)) {
                $this->Flash->success(__('The german master listing has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The german master listing could not be saved. Please, try again.'));
        }
        $users = $this->GermanMasterListings->Users->find('list', ['limit' => 200]);
        $externalProducts = $this->GermanMasterListings->ExternalProducts->find('list', ['limit' => 200]);
        $deliveryScheduleGroups = $this->GermanMasterListings->DeliveryScheduleGroups->find('list', ['limit' => 200]);
        $fulfillmentCenters = $this->GermanMasterListings->FulfillmentCenters->find('list', ['limit' => 200]);
        $fedas = $this->GermanMasterListings->Fedas->find('list', ['limit' => 200]);
        $this->set(compact('germanMasterListing', 'users', 'externalProducts', 'deliveryScheduleGroups', 'fulfillmentCenters', 'fedas'));
    }

    /**
     * Delete method
     *
     * @param string|null $id German Master Listing id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $germanMasterListing = $this->GermanMasterListings->get($id);
        if ($this->GermanMasterListings->delete($germanMasterListing)) {
            $this->Flash->success(__('The german master listing has been deleted.'));
        } else {
            $this->Flash->error(__('The german master listing could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
