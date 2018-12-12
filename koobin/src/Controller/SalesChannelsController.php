<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * SalesChannels Controller
 *
 * @property \App\Model\Table\SalesChannelsTable $SalesChannels
 *
 * @method \App\Model\Entity\SalesChannel[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SalesChannelsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $salesChannels = $this->paginate($this->SalesChannels);

        $this->set(compact('salesChannels'));
    }

    /**
     * View method
     *
     * @param string|null $id Sales Channel id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $salesChannel = $this->SalesChannels->get($id, [
            'contain' => []
        ]);

        $this->set('salesChannel', $salesChannel);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $salesChannel = $this->SalesChannels->newEntity();
        if ($this->request->is('post')) {
            $salesChannel = $this->SalesChannels->patchEntity($salesChannel, $this->request->getData());
            if ($this->SalesChannels->save($salesChannel)) {
                $this->Flash->success(__('The sales channel has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The sales channel could not be saved. Please, try again.'));
        }
        $this->set(compact('salesChannel'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Sales Channel id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $salesChannel = $this->SalesChannels->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $salesChannel = $this->SalesChannels->patchEntity($salesChannel, $this->request->getData());
            if ($this->SalesChannels->save($salesChannel)) {
                $this->Flash->success(__('The sales channel has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The sales channel could not be saved. Please, try again.'));
        }
        $this->set(compact('salesChannel'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Sales Channel id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $salesChannel = $this->SalesChannels->get($id);
        if ($this->SalesChannels->delete($salesChannel)) {
            $this->Flash->success(__('The sales channel has been deleted.'));
        } else {
            $this->Flash->error(__('The sales channel could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
