<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * StockItems Controller
 *
 * @property \App\Model\Table\StockItemsTable $StockItems
 *
 * @method \App\Model\Entity\StockItem[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class StockItemsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Supps']
        ];
        $stockItems = $this->paginate($this->StockItems);

        $this->set(compact('stockItems'));
    }

    /**
     * View method
     *
     * @param string|null $id Stock Item id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $stockItem = $this->StockItems->get($id, [
            'contain' => ['Supps']
        ]);

        $this->set('stockItem', $stockItem);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $stockItem = $this->StockItems->newEntity();
        if ($this->request->is('post')) {
            $stockItem = $this->StockItems->patchEntity($stockItem, $this->request->getData());
            if ($this->StockItems->save($stockItem)) {
                $this->Flash->success(__('The stock item has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The stock item could not be saved. Please, try again.'));
        }
        $supps = $this->StockItems->Supps->find('list', ['limit' => 200]);
        $this->set(compact('stockItem', 'supps'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Stock Item id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $stockItem = $this->StockItems->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $stockItem = $this->StockItems->patchEntity($stockItem, $this->request->getData());
            if ($this->StockItems->save($stockItem)) {
                $this->Flash->success(__('The stock item has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The stock item could not be saved. Please, try again.'));
        }
        $supps = $this->StockItems->Supps->find('list', ['limit' => 200]);
        $this->set(compact('stockItem', 'supps'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Stock Item id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $stockItem = $this->StockItems->get($id);
        if ($this->StockItems->delete($stockItem)) {
            $this->Flash->success(__('The stock item has been deleted.'));
        } else {
            $this->Flash->error(__('The stock item could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
