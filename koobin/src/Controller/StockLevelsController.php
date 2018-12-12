<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * StockLevels Controller
 *
 * @property \App\Model\Table\StockLevelsTable $StockLevels
 *
 * @method \App\Model\Entity\StockLevel[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class StockLevelsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['StockLocations']
        ];
        $stockLevels = $this->paginate($this->StockLevels);

        $this->set(compact('stockLevels'));
    }

    /**
     * View method
     *
     * @param string|null $id Stock Level id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $stockLevel = $this->StockLevels->get($id, [
            'contain' => ['StockLocations']
        ]);

        $this->set('stockLevel', $stockLevel);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $stockLevel = $this->StockLevels->newEntity();
        if ($this->request->is('post')) {
            $stockLevel = $this->StockLevels->patchEntity($stockLevel, $this->request->getData());
            if ($this->StockLevels->save($stockLevel)) {
                $this->Flash->success(__('The stock level has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The stock level could not be saved. Please, try again.'));
        }
        $stockLocations = $this->StockLevels->StockLocations->find('list', ['limit' => 200]);
        $this->set(compact('stockLevel', 'stockLocations'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Stock Level id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $stockLevel = $this->StockLevels->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $stockLevel = $this->StockLevels->patchEntity($stockLevel, $this->request->getData());
            if ($this->StockLevels->save($stockLevel)) {
                $this->Flash->success(__('The stock level has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The stock level could not be saved. Please, try again.'));
        }
        $stockLocations = $this->StockLevels->StockLocations->find('list', ['limit' => 200]);
        $this->set(compact('stockLevel', 'stockLocations'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Stock Level id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $stockLevel = $this->StockLevels->get($id);
        if ($this->StockLevels->delete($stockLevel)) {
            $this->Flash->success(__('The stock level has been deleted.'));
        } else {
            $this->Flash->error(__('The stock level could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
