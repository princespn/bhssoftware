<?php

class User extends AppModel {

    var $name = 'User';
    var $validate = array(
        'username' => array(
            'required' => array(
                'rule' => array('minLength', 1),
                'allowEmpty' => false,
                'message' => 'User name is required.'
            ),
            
       'useruniqe' => array(
                'rule' => 'isUnique', 
                 'required' => true,
                'message' => 'Username is already exist in database.'
            ),
        ),
        
        'new_password' => array(
            'rule1' => array(
                'rule' => 'notEmpty',
                'required' => true,
                'message' => 'Password is required field',
            ),
            
            'between' => array(
                'rule' => array('between', 5, 15),
                 'required' => true,
                'message' => 'Password must be betwwen 5 to 15 characters long'
            ),
        ),
        
        'confirm_password' => array(
            'password' => array(
                'rule' => 'notEmpty',
                'required' => true,
                'message' => 'Repeat password is required field',
            ),
            
            'between' => array(
                'rule' => array('between', 5, 15),
                 'required' => true,
                'message' => 'Confirm Password must be betwwen 5 to 15 characters long'
            ),
            
            'custom' => array(
                'rule' => array('CheckPasswordMatch'),
                 'required' => true,
                'message' => 'Passwords and Confirm Password did not match',
            ),
        ),
        
      'email' => array(
            'required1' => array(
                'rule' => array('minLength', 1),
                'allowEmpty' => false,
                'message' => 'Provide an email address.'
            ),
          
        'validEmailRule' => array(
            'rule' => array('email'),
            'message' => 'Invalid email address'
        ),
          
        'uniqueEmailRule' => array(
            'rule' => 'isUnique',
            'message' => 'Email already registered'
        ),
    ),
        
    'group_id' => array(
           'notempty' => array(
                    'rule' => 'notempty',
                    'required' => true,
                    'message' => 'User Group name is required.')          
        ),
    );

    function CheckPasswordMatch() {
        return $this->data['User']['new_password'] == $this->data['User']['confirm_password'];
    }

    function beforeSave() {
        $this->data['User']['password'] = AuthComponent::password($this->data['User']['new_password']);
        return true;
    }

    var $belongsTo = array(
        'Group' => array(
            'className' => 'Group',
            'foreignKey' => 'group_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
    );
    var $hasMany = array(
        'EnglishListing' => array(
            'className' => 'EnglishListing',
            'foreignKey' => 'user_id',
            'dependent' => false,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        ),
        'FranceListing' => array(
            'className' => 'FranceListing',
            'foreignKey' => 'user_id',
            'dependent' => false,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        ),
        'GermanListing' => array(
            'className' => 'GermanListing',
            'foreignKey' => 'user_id',
            'dependent' => false,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        ),
    );
    var $actsAs = array('Acl' => array('type' => 'requester'));

    function parentNode() {
        if (!$this->id && empty($this->data)) {
            return null;
        }
        if (isset($this->data['User']['group_id'])) {
            $groupId = $this->data['User']['group_id'];
        } else {
            $groupId = $this->field('group_id');
        }
        if (!$groupId) {
            return null;
        } else {
            return array('Group' => array('id' => $groupId));
        }
    }

    function bindNode($user) {
        return array('model' => 'Group', 'foreign_key' => $user['User']['group_id']);
    }

}
