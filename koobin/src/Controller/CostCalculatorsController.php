<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * CostCalculators Controller
 *
 * @property \App\Model\Table\CostCalculatorsTable $CostCalculators
 *
 * @method \App\Model\Entity\CostCalculator[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CostCalculatorsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
    	  $this->set('title', 'Cost Calculator');
    	  
    	    $categories = $this->categname();
      	  	$this->loadModel('CostSettings');
        	$getCost    =   $this->CostSettings->find('all');         
        	$this->loadModel('SupplierMultipliers');
        	$getsupp    =  $this->SupplierMultipliers->find('all');
        
    	  
     if ((!empty($this->request->data['submit'])) && (!empty($this->request->data['all_item']))) {
			 
			 $linkwebsku = $this->request->data['all_item'];
			 		
		 $this->paginate = [
			    'contain' => ['PurchasePrices','AdminListings','Multipliers'],
        'conditions' => [
            'CostCalculators.linnworks_code LIKE' => '%' . $linkwebsku . '%']						
					];
					
		}else{
		
		
    	$this->paginate = [
            'contain' => ['PurchasePrices','AdminListings','Multipliers']
        ];
		}
        $costCalculators = $this->paginate($this->CostCalculators);

        $this->set(compact('costCalculators','categories','getCost','getsupp'));
    }

    /**
     * View method
     *
     * @param string|null $id Cost Calculator id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $costCalculator = $this->CostCalculators->get($id, [
            'contain' => []
        ]);

        $this->set('costCalculator', $costCalculator);
    }
    
    
 /**
     * display method
     *
     * @param string|null $catnamet Cost Calculator category.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    
    public function display($catname = null)
    {
		$this->set('title', 'Cost Calculator');
		
			$categories = $this->categname();
      	  	$this->loadModel('CostSettings');
        	$getCost    =   $this->CostSettings->find('all');         
        	$this->loadModel('SupplierMultipliers');
        	$getsupp    =  $this->SupplierMultipliers->find('all');
        	$linkwebsku = urldecode($catname);    	 
			 		
		 $this->paginate = [
			    'contain' => ['PurchasePrices','AdminListings','Multipliers'],
        'conditions' => [
            'CostCalculators.category LIKE' => '%' . $linkwebsku . '%']						
					];

		$costCalculators = $this->paginate($this->CostCalculators);
        $this->set(compact('costCalculators','categories','getCost','getsupp'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    
    public function add()
    {
        $costCalculator = $this->CostCalculators->newEntity();
        if ($this->request->is('post')) {
            $costCalculator = $this->CostCalculators->patchEntity($costCalculator, $this->request->getData());
            if ($this->CostCalculators->save($costCalculator)) {
                $this->Flash->success(__('The cost calculator has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The cost calculator could not be saved. Please, try again.'));
        }
        $this->set(compact('costCalculator'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Cost Calculator id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    
    public function edit($id = null)
    {
        $costCalculator = $this->CostCalculators->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $costCalculator = $this->CostCalculators->patchEntity($costCalculator, $this->request->getData());
            if ($this->CostCalculators->save($costCalculator)) {
                $this->Flash->success(__('The cost calculator has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The cost calculator could not be saved. Please, try again.'));
        }
        $this->set(compact('costCalculator'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Cost Calculator id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $costCalculator = $this->CostCalculators->get($id);
        if ($this->CostCalculators->delete($costCalculator)) {
            $this->Flash->success(__('The cost calculator has been deleted.'));
        } else {
            $this->Flash->error(__('The cost calculator could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
