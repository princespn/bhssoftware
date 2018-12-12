<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * PurchasePrices Controller
 *
 * @property \App\Model\Table\PurchasePricesTable $PurchasePrices
 *
 * @method \App\Model\Entity\PurchasePrice[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PurchasePricesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Purchases', 'Suppliers']
        ];
        $purchasePrices = $this->paginate($this->PurchasePrices);

        $this->set(compact('purchasePrices'));
    }

    /**
     * View method
     *
     * @param string|null $id Purchase Price id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $purchasePrice = $this->PurchasePrices->get($id, [
            'contain' => ['Purchases', 'Suppliers']
        ]);

        $this->set('purchasePrice', $purchasePrice);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $purchasePrice = $this->PurchasePrices->newEntity();
        if ($this->request->is('post')) {
            $purchasePrice = $this->PurchasePrices->patchEntity($purchasePrice, $this->request->getData());
            if ($this->PurchasePrices->save($purchasePrice)) {
                $this->Flash->success(__('The purchase price has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The purchase price could not be saved. Please, try again.'));
        }
        $purchases = $this->PurchasePrices->Purchases->find('list', ['limit' => 200]);
        $suppliers = $this->PurchasePrices->Suppliers->find('list', ['limit' => 200]);
        $this->set(compact('purchasePrice', 'purchases', 'suppliers'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Purchase Price id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $purchasePrice = $this->PurchasePrices->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $purchasePrice = $this->PurchasePrices->patchEntity($purchasePrice, $this->request->getData());
            if ($this->PurchasePrices->save($purchasePrice)) {
                $this->Flash->success(__('The purchase price has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The purchase price could not be saved. Please, try again.'));
        }
        $purchases = $this->PurchasePrices->Purchases->find('list', ['limit' => 200]);
        $suppliers = $this->PurchasePrices->Suppliers->find('list', ['limit' => 200]);
        $this->set(compact('purchasePrice', 'purchases', 'suppliers'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Purchase Price id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $purchasePrice = $this->PurchasePrices->get($id);
        if ($this->PurchasePrices->delete($purchasePrice)) {
            $this->Flash->success(__('The purchase price has been deleted.'));
        } else {
            $this->Flash->error(__('The purchase price could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
