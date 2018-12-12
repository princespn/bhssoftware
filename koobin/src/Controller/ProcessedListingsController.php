<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * ProcessedListings Controller
 *
 * @property \App\Model\Table\ProcessedListingsTable $ProcessedListings
 *
 * @method \App\Model\Entity\ProcessedListing[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ProcessedListingsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Orders']
        ];
        $processedListings = $this->paginate($this->ProcessedListings);

        $this->set(compact('processedListings'));
    }

    /**
     * View method
     *
     * @param string|null $id Processed Listing id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $processedListing = $this->ProcessedListings->get($id, [
            'contain' => ['Orders']
        ]);

        $this->set('processedListing', $processedListing);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $processedListing = $this->ProcessedListings->newEntity();
        if ($this->request->is('post')) {
            $processedListing = $this->ProcessedListings->patchEntity($processedListing, $this->request->getData());
            if ($this->ProcessedListings->save($processedListing)) {
                $this->Flash->success(__('The processed listing has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The processed listing could not be saved. Please, try again.'));
        }
        $orders = $this->ProcessedListings->Orders->find('list', ['limit' => 200]);
        $this->set(compact('processedListing', 'orders'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Processed Listing id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $processedListing = $this->ProcessedListings->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $processedListing = $this->ProcessedListings->patchEntity($processedListing, $this->request->getData());
            if ($this->ProcessedListings->save($processedListing)) {
                $this->Flash->success(__('The processed listing has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The processed listing could not be saved. Please, try again.'));
        }
        $orders = $this->ProcessedListings->Orders->find('list', ['limit' => 200]);
        $this->set(compact('processedListing', 'orders'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Processed Listing id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $processedListing = $this->ProcessedListings->get($id);
        if ($this->ProcessedListings->delete($processedListing)) {
            $this->Flash->success(__('The processed listing has been deleted.'));
        } else {
            $this->Flash->error(__('The processed listing could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
