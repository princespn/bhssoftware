<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * SupplierMultipliers Controller
 *
 * @property \App\Model\Table\SupplierMultipliersTable $SupplierMultipliers
 *
 * @method \App\Model\Entity\SupplierMultiplier[] paginate($object = null, array $settings = [])
 */
class SupplierMultipliersController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $supplierMultipliers = $this->paginate($this->SupplierMultipliers);

        $this->set(compact('supplierMultipliers'));
        $this->set('_serialize', ['supplierMultipliers']);
    }

    /**
     * View method
     *
     * @param string|null $id Supplier Multiplier id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $supplierMultiplier = $this->SupplierMultipliers->get($id, [
            'contain' => []
        ]);

        $this->set('supplierMultiplier', $supplierMultiplier);
        $this->set('_serialize', ['supplierMultiplier']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $supplierMultiplier = $this->SupplierMultipliers->newEntity();
        if ($this->request->is('post')) {
            $supplierMultiplier = $this->SupplierMultipliers->patchEntity($supplierMultiplier, $this->request->getData());
            if ($this->SupplierMultipliers->save($supplierMultiplier)) {
                $this->Flash->success(__('The supplier multiplier has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The supplier multiplier could not be saved. Please, try again.'));
        }
        $this->set(compact('supplierMultiplier'));
        $this->set('_serialize', ['supplierMultiplier']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Supplier Multiplier id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $supplierMultiplier = $this->SupplierMultipliers->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $supplierMultiplier = $this->SupplierMultipliers->patchEntity($supplierMultiplier, $this->request->getData());
            if ($this->SupplierMultipliers->save($supplierMultiplier)) {
                $this->Flash->success(__('The supplier multiplier has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The supplier multiplier could not be saved. Please, try again.'));
        }
        $this->set(compact('supplierMultiplier'));
        $this->set('_serialize', ['supplierMultiplier']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Supplier Multiplier id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $supplierMultiplier = $this->SupplierMultipliers->get($id);
        if ($this->SupplierMultipliers->delete($supplierMultiplier)) {
            $this->Flash->success(__('The supplier multiplier has been deleted.'));
        } else {
            $this->Flash->error(__('The supplier multiplier could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
