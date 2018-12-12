<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * InventoryMasters Controller
 *
 * @property \App\Model\Table\InventoryMastersTable $InventoryMasters
 *
 * @method \App\Model\Entity\InventoryMaster[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class InventoryMastersController extends AppController
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
        $inventoryMasters = $this->paginate($this->InventoryMasters);

        $this->set(compact('inventoryMasters'));
    }

    /**
     * View method
     *
     * @param string|null $id Inventory Master id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $inventoryMaster = $this->InventoryMasters->get($id, [
            'contain' => ['Users', 'ExternalProducts', 'FulfillmentCenters']
        ]);

        $this->set('inventoryMaster', $inventoryMaster);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $inventoryMaster = $this->InventoryMasters->newEntity();
        if ($this->request->is('post')) {
            $inventoryMaster = $this->InventoryMasters->patchEntity($inventoryMaster, $this->request->getData());
            if ($this->InventoryMasters->save($inventoryMaster)) {
                $this->Flash->success(__('The inventory master has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The inventory master could not be saved. Please, try again.'));
        }
        $users = $this->InventoryMasters->Users->find('list', ['limit' => 200]);
        $externalProducts = $this->InventoryMasters->ExternalProducts->find('list', ['limit' => 200]);
        $fulfillmentCenters = $this->InventoryMasters->FulfillmentCenters->find('list', ['limit' => 200]);
        $this->set(compact('inventoryMaster', 'users', 'externalProducts', 'fulfillmentCenters'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Inventory Master id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $inventoryMaster = $this->InventoryMasters->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $inventoryMaster = $this->InventoryMasters->patchEntity($inventoryMaster, $this->request->getData());
            if ($this->InventoryMasters->save($inventoryMaster)) {
                $this->Flash->success(__('The inventory master has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The inventory master could not be saved. Please, try again.'));
        }
        $users = $this->InventoryMasters->Users->find('list', ['limit' => 200]);
        $externalProducts = $this->InventoryMasters->ExternalProducts->find('list', ['limit' => 200]);
        $fulfillmentCenters = $this->InventoryMasters->FulfillmentCenters->find('list', ['limit' => 200]);
        $this->set(compact('inventoryMaster', 'users', 'externalProducts', 'fulfillmentCenters'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Inventory Master id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $inventoryMaster = $this->InventoryMasters->get($id);
        if ($this->InventoryMasters->delete($inventoryMaster)) {
            $this->Flash->success(__('The inventory master has been deleted.'));
        } else {
            $this->Flash->error(__('The inventory master could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
