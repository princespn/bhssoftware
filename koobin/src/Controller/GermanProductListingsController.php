<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * GermanProductListings Controller
 *
 * @property \App\Model\Table\GermanProductListingsTable $GermanProductListings
 *
 * @method \App\Model\Entity\GermanProductListing[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class GermanProductListingsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $germanProductListings = $this->paginate($this->GermanProductListings);

        $this->set(compact('germanProductListings'));
    }

    /**
     * View method
     *
     * @param string|null $id German Product Listing id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $germanProductListing = $this->GermanProductListings->get($id, [
            'contain' => []
        ]);

        $this->set('germanProductListing', $germanProductListing);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $germanProductListing = $this->GermanProductListings->newEntity();
        if ($this->request->is('post')) {
            $germanProductListing = $this->GermanProductListings->patchEntity($germanProductListing, $this->request->getData());
            if ($this->GermanProductListings->save($germanProductListing)) {
                $this->Flash->success(__('The german product listing has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The german product listing could not be saved. Please, try again.'));
        }
        $this->set(compact('germanProductListing'));
    }

    /**
     * Edit method
     *
     * @param string|null $id German Product Listing id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $germanProductListing = $this->GermanProductListings->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $germanProductListing = $this->GermanProductListings->patchEntity($germanProductListing, $this->request->getData());
            if ($this->GermanProductListings->save($germanProductListing)) {
                $this->Flash->success(__('The german product listing has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The german product listing could not be saved. Please, try again.'));
        }
        $this->set(compact('germanProductListing'));
    }

    /**
     * Delete method
     *
     * @param string|null $id German Product Listing id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $germanProductListing = $this->GermanProductListings->get($id);
        if ($this->GermanProductListings->delete($germanProductListing)) {
            $this->Flash->success(__('The german product listing has been deleted.'));
        } else {
            $this->Flash->error(__('The german product listing could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
