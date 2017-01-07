<?php
class AdminListingsController extends AppController {

    var $name = 'AdminListings';
    var $components = array('Acl', 'Auth', 'Session', 'RequestHandler');
    var $helpers = array('Session', 'Html', 'Form', 'Ajax', 'Javascript', 'Js', 'Csv');



    function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow(array('delete', 'logout', 'index','importcode','edit'));
    }


    function index() {
        $this->set('title', 'Website Prices Inventory Database.');

        if ((!empty($this->data)) && (!empty($_POST['submit'])) && (!empty($this->data['AdminListing']['all_item']))) {

            $string = explode(",", trim($this->data['AdminListing']['all_item']));
            $prsku = $string[0];
            if (!empty($string[1])) {
                $prname = $string[1];
            }
            if ((!empty($prsku)) && (!empty($prname))) {

                $conditions = array('AdminListing.linnworks_code LIKE' => '%' . $prname . '%', 'AdminListing.web_sku LIKE' => '%' . $prsku . '%', 'AdminListing.linnworks_code LIKE' => '%' . $prsku . '%');
                $this->AdminListing->recursive = 1;
                $this->paginate = array('limit' => 100, 'order' => 'AdminListing.id  ASC', 'conditions' => $conditions);
            }

            if ((!empty($prsku))) {

                $conditions = array(
                    'OR' => array('AdminListing.web_sku LIKE' => "%$prsku%", 'AdminListing.linnworks_code LIKE' => "%$prsku%", 'AdminListing.web_sku LIKE' => "%$prsku%"));
                $this->AdminListing->recursive = 1;
                $this->paginate = array('limit' => 100, 'order' => 'AdminListing.id  ASC', 'conditions' => $conditions);
            }
            $this->AdminListing->recursive = 1;
            $this->set('price_listings', $this->paginate());
        } else if ((!empty($_POST['checkid'])) && (!empty($_POST['exports']))) {
            $checkboxid = $_POST['checkid'];
            App::import("Vendor", "parsecsv");
            $csv = new parseCSV();
            $filepath = "C:\Users\Administrator\Downloads" . "price_listings.csv";
            $csv->auto($filepath);
            $this->set('price_listings', $this->AdminListing->find('all', array('AdminListing.id ASC', 'conditions' => array('AdminListing.id' => $checkboxid))));
            $this->layout = null;
            $this->autoLayout = false;
            Configure::write('debug', '2');
        } else {
            $this->AdminListing->recursive = 1;
            $this->paginate = array('limit' => 100, 'order' => 'AdminListing.id  ASC');
            $this->set('price_listings', $this->paginate());
        }

    }



    function importcode() {

        $this->set('title', 'Import Product code information.');

        if (!empty($this->data)) {
            $filename = $this->data['AdminListing']['file']['name'];
            $fileExt = explode(".", $filename);
            $fileExt2 = end($fileExt);
            //print_r($$filename);die();
            if ($fileExt2 == 'csv') {
                if (move_uploaded_file($this->data['AdminListing']['file']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . '/app/webroot/files/' . $this->data['AdminListing']['file']['name']))
                    $messages = $this->AdminListing->importcode($filename);
                $this->Session->setFlash(__('Product Code Imports successfully.', true));

                if (!empty($messages)) {
                    $this->set('anything', $messages);
                    Configure::write('debug', '2');
                }
            } else {

                $this->Session->setFlash(__('Product Code File format not supported.</br>Please upload .CSV file format only.', true));
            }
        } else {
            //$filename = 'Product Code.csv';
            //$messages = Product Code($filename);
        }
    }

    public function edit($id = null) {


        $this->set('title', 'Edit Website Price AdminListing.');


        if (!$id && empty($this->data)) {
            $this->Session->setFlash(__('Invalid website price id.', true));
            $this->redirect(array('controller' => 'admin_listings', 'action' => 'index'));
        }
        if (!empty($this->data)) {


            if ($this->AdminListing->save($this->data['AdminListing'])) {
                $this->Session->setFlash(__('The Website price listing save successfully', true));
                $this->redirect(array('controller' => 'admin_listings', 'action' => 'index'));
            } else {
                $this->Session->setFlash(__('ERROR!! Please check the fields and try again.', true));
            }
        }
        if (empty($this->data)) {
            $this->data = $this->AdminListing->read(null, $id);
        }
    }

    function delete($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('Invalid UK Listing ID in database.', true));
            $this->redirect(array('controller' => 'admin_listings', 'action' => 'index'));
        } else {

            if ($this->AdminListing->delete($id)) {

                $this->Session->setFlash(__('The Amazon Listing was deleted successfully.', true));
                $this->redirect(array('controller' => 'admin_listings', 'action' => 'index'));
            }
        }
        $this->Session->setFlash(__('ERROR!! The Amazon Listing could not be deleted!', true));
        $this->redirect(array('controller' => 'admin_listings', 'action' => 'index'));
    }




}















