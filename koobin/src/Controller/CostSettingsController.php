<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * CostSettings Controller
 *
 * @property \App\Model\Table\CostSettingsTable $CostSettings
 *
 * @method \App\Model\Entity\CostSetting[] paginate($object = null, array $settings = [])
 */
class CostSettingsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $costSettings = $this->paginate($this->CostSettings);

        $this->set(compact('costSettings'));
        $this->set('_serialize', ['costSettings']);
    }

    /**
     * View method
     *
     * @param string|null $id Cost Setting id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $costSetting = $this->CostSettings->get($id, [
            'contain' => []
        ]);

        $this->set('costSetting', $costSetting);
        $this->set('_serialize', ['costSetting']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $costSetting = $this->CostSettings->newEntity();
        if ($this->request->is('post')) {
            $costSetting = $this->CostSettings->patchEntity($costSetting, $this->request->getData());
            if ($this->CostSettings->save($costSetting)) {
                $this->Flash->success(__('The cost setting has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The cost setting could not be saved. Please, try again.'));
        }
        $this->set(compact('costSetting'));
        $this->set('_serialize', ['costSetting']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Cost Setting id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $costSetting = $this->CostSettings->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $costSetting = $this->CostSettings->patchEntity($costSetting, $this->request->getData());
            if ($this->CostSettings->save($costSetting)) {
                $this->Flash->success(__('The cost setting has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The cost setting could not be saved. Please, try again.'));
        }
        $this->set(compact('costSetting'));
        $this->set('_serialize', ['costSetting']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Cost Setting id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $costSetting = $this->CostSettings->get($id);
        if ($this->CostSettings->delete($costSetting)) {
            $this->Flash->success(__('The cost setting has been deleted.'));
        } else {
            $this->Flash->error(__('The cost setting could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
