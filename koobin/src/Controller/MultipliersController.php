<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Multipliers Controller
 *
 * @property \App\Model\Table\MultipliersTable $Multipliers
 *
 * @method \App\Model\Entity\Multiplier[] paginate($object = null, array $settings = [])
 */
class MultipliersController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $multipliers = $this->paginate($this->Multipliers);

        $this->set(compact('multipliers'));
        $this->set('_serialize', ['multipliers']);
    }

    /**
     * View method
     *
     * @param string|null $id Multiplier id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $multiplier = $this->Multipliers->get($id, [
            'contain' => []
        ]);

        $this->set('multiplier', $multiplier);
        $this->set('_serialize', ['multiplier']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $multiplier = $this->Multipliers->newEntity();
        if ($this->request->is('post')) {
            $multiplier = $this->Multipliers->patchEntity($multiplier, $this->request->getData());
            if ($this->Multipliers->save($multiplier)) {
                $this->Flash->success(__('The multiplier has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The multiplier could not be saved. Please, try again.'));
        }
        $this->set(compact('multiplier'));
        $this->set('_serialize', ['multiplier']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Multiplier id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $multiplier = $this->Multipliers->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $multiplier = $this->Multipliers->patchEntity($multiplier, $this->request->getData());
            if ($this->Multipliers->save($multiplier)) {
                $this->Flash->success(__('The multiplier has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The multiplier could not be saved. Please, try again.'));
        }
        $this->set(compact('multiplier'));
        $this->set('_serialize', ['multiplier']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Multiplier id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $multiplier = $this->Multipliers->get($id);
        if ($this->Multipliers->delete($multiplier)) {
            $this->Flash->success(__('The multiplier has been deleted.'));
        } else {
            $this->Flash->error(__('The multiplier could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
