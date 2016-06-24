<?php
class KeywordsController extends AppController {
        var $name = 'Keywords';
        var $components = array('Acl', 'Auth', 'Session','RequestHandler');
        var $helpers = array('Html', 'Form','Ajax','Javascript','Js','Csv');

            function beforeFilter()
            {
                parent::beforeFilter();
                $this->Auth->allow(array('login','logout','index','edit_keyword','import_keyword','delete_keyword'));
                $this->Auth->userModel = 'Keyword';  
                $this->Session->activate();
            } 

            function index () {
                $this->Keyword->recursive = 1;
                $this->paginate = array('limit' => 1000,'totallimit' => 2000,'order'=>'Keyword.id  ASC');
                $this->set('keywords', $this->paginate());
            }

}