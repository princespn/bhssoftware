<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * FranceProductListings Controller
 *
 * @property \App\Model\Table\FranceProductListingsTable $FranceProductListings
 *
 * @method \App\Model\Entity\FranceProductListing[] paginate($object = null, array $settings = [])
 */
class FranceProductListingsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $franceProductListings = $this->paginate($this->FranceProductListings);

        $this->set(compact('franceProductListings'));
        $this->set('_serialize', ['franceProductListings']);
    }

    /**
     * View method
     *
     * @param string|null $id France Product Listing id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $franceProductListing = $this->FranceProductListings->get($id, [
            'contain' => []
        ]);

        $this->set('franceProductListing', $franceProductListing);
        $this->set('_serialize', ['franceProductListing']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $franceProductListing = $this->FranceProductListings->newEntity();
        if ($this->request->is('post')) {
            $franceProductListing = $this->FranceProductListings->patchEntity($franceProductListing, $this->request->getData());
            if ($this->FranceProductListings->save($franceProductListing)) {
                $this->Flash->success(__('The france product listing has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The france product listing could not be saved. Please, try again.'));
        }
        $this->set(compact('franceProductListing'));
        $this->set('_serialize', ['franceProductListing']);
    }

    /**
     * Edit method
     *
     * @param string|null $id France Product Listing id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $franceProductListing = $this->FranceProductListings->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $franceProductListing = $this->FranceProductListings->patchEntity($franceProductListing, $this->request->getData());
            if ($this->FranceProductListings->save($franceProductListing)) {
                $this->Flash->success(__('The france product listing has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The france product listing could not be saved. Please, try again.'));
        }
        $this->set(compact('franceProductListing'));
        $this->set('_serialize', ['franceProductListing']);
    }

    /**
     * Delete method
     *
     * @param string|null $id France Product Listing id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $franceProductListing = $this->FranceProductListings->get($id);
        if ($this->FranceProductListings->delete($franceProductListing)) {
            $this->Flash->success(__('The france product listing has been deleted.'));
        } else {
            $this->Flash->error(__('The france product listing could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
