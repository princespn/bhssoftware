<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * ProductListings Controller
 *
 * @property \App\Model\Table\ProductListingsTable $ProductListings
 *
 * @method \App\Model\Entity\ProductListing[] paginate($object = null, array $settings = [])
 */
class ProductListingsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $productListings = $this->paginate($this->ProductListings);

        $this->set(compact('productListings'));
        $this->set('_serialize', ['productListings']);
    }

    /**
     * View method
     *
     * @param string|null $id Product Listing id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $productListing = $this->ProductListings->get($id, [
            'contain' => []
        ]);

        $this->set('productListing', $productListing);
        $this->set('_serialize', ['productListing']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $productListing = $this->ProductListings->newEntity();
        if ($this->request->is('post')) {
            $productListing = $this->ProductListings->patchEntity($productListing, $this->request->getData());
            if ($this->ProductListings->save($productListing)) {
                $this->Flash->success(__('The product listing has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The product listing could not be saved. Please, try again.'));
        }
        $this->set(compact('productListing'));
        $this->set('_serialize', ['productListing']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Product Listing id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $productListing = $this->ProductListings->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $productListing = $this->ProductListings->patchEntity($productListing, $this->request->getData());
            if ($this->ProductListings->save($productListing)) {
                $this->Flash->success(__('The product listing has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The product listing could not be saved. Please, try again.'));
        }
        $this->set(compact('productListing'));
        $this->set('_serialize', ['productListing']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Product Listing id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $productListing = $this->ProductListings->get($id);
        if ($this->ProductListings->delete($productListing)) {
            $this->Flash->success(__('The product listing has been deleted.'));
        } else {
            $this->Flash->error(__('The product listing could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
