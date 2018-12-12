<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Channels Controller
 *
 * @property \App\Model\Table\ChannelsTable $Channels
 *
 * @method \App\Model\Entity\Channel[] paginate($object = null, array $settings = [])
 */
class ChannelsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $channels = $this->paginate($this->Channels);

        $this->set(compact('channels'));
        $this->set('_serialize', ['channels']);
    }

    /**
     * View method
     *
     * @param string|null $id Channel id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $channel = $this->Channels->get($id, [
            'contain' => ['MasterListings']
        ]);

        $this->set('channel', $channel);
        $this->set('_serialize', ['channel']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $channel = $this->Channels->newEntity();
        if ($this->request->is('post')) {
            $channel = $this->Channels->patchEntity($channel, $this->request->getData());
            if ($this->Channels->save($channel)) {
                $this->Flash->success(__('The channel has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The channel could not be saved. Please, try again.'));
        }
        $this->set(compact('channel'));
        $this->set('_serialize', ['channel']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Channel id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $channel = $this->Channels->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $channel = $this->Channels->patchEntity($channel, $this->request->getData());
            if ($this->Channels->save($channel)) {
                $this->Flash->success(__('The channel has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The channel could not be saved. Please, try again.'));
        }
        $this->set(compact('channel'));
        $this->set('_serialize', ['channel']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Channel id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $channel = $this->Channels->get($id);
        if ($this->Channels->delete($channel)) {
            $this->Flash->success(__('The channel has been deleted.'));
        } else {
            $this->Flash->error(__('The channel could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
