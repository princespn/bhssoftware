<?php

class GroupsController extends AppController {

    var $components = array('Acl', 'Auth', 'Session');
    var $helpers = array('Html', 'Form', 'Ajax', 'Javascript', 'Access');
    var $name = 'Groups';

    function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->userModel = 'Group';
        $this->Auth->allow(array('login', 'logout', 'index', 'edit', 'view'));
        //$this->Auth->allow('*');  
        $this->Session->activate();
    }

    function index() {
        $this->Group->recursive = 0;
        $this->set('groups', $this->paginate());
    }

    function view($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('Invalid group', true));
            $this->redirect(array('action' => 'index'));
        }
        $this->set('group', $this->Group->read(null, $id));
    }

    function add() {
        if (!empty($this->data)) {
            $this->Group->create();
            if ($this->Group->save($this->data)) {
                $this->Session->setFlash(__('Group created successfully.', true));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('Group was not created. Please check all the fields and try again.', true));
            }
        }
    }

    function edit($id = null) {
        if (!$id && empty($this->data)) {
            $this->Session->setFlash(__('Invalid group', true));
            $this->redirect(array('action' => 'index'));
        }
        if (!empty($this->data)) {
            if ($this->Group->save($this->data)) {
                $this->Session->setFlash(__('The group was updated successfully', true));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The group was not updated. Please check all the fields and try again.', true));
            }
        }
        if (empty($this->data)) {
            $this->data = $this->Group->read(null, $id);
        }
    }

}
