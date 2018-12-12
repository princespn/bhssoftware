<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * InventoryCodes Controller
 *
 * @property \App\Model\Table\InventoryCodesTable $InventoryCodes
 *
 * @method \App\Model\Entity\InventoryCode[] paginate($object = null, array $settings = [])
 */
class InventoryCodesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $inventoryCodes = $this->paginate($this->InventoryCodes);

        $this->set(compact('inventoryCodes'));
        $this->set('_serialize', ['inventoryCodes']);
    }

    /**
     * View method
     *
     * @param string|null $id Inventory Code id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $inventoryCode = $this->InventoryCodes->get($id, [
            'contain' => []
        ]);

        $this->set('inventoryCode', $inventoryCode);
        $this->set('_serialize', ['inventoryCode']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $inventoryCode = $this->InventoryCodes->newEntity();
        if ($this->request->is('post')) {
            $inventoryCode = $this->InventoryCodes->patchEntity($inventoryCode, $this->request->getData());
            if ($this->InventoryCodes->save($inventoryCode)) {
                $this->Flash->success(__('The inventory code has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The inventory code could not be saved. Please, try again.'));
        }
        $this->set(compact('inventoryCode'));
        $this->set('_serialize', ['inventoryCode']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Inventory Code id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $inventoryCode = $this->InventoryCodes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $inventoryCode = $this->InventoryCodes->patchEntity($inventoryCode, $this->request->getData());
            if ($this->InventoryCodes->save($inventoryCode)) {
                $this->Flash->success(__('The inventory code has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The inventory code could not be saved. Please, try again.'));
        }
        $this->set(compact('inventoryCode'));
        $this->set('_serialize', ['inventoryCode']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Inventory Code id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $inventoryCode = $this->InventoryCodes->get($id);
        if ($this->InventoryCodes->delete($inventoryCode)) {
            $this->Flash->success(__('The inventory code has been deleted.'));
        } else {
            $this->Flash->error(__('The inventory code could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
