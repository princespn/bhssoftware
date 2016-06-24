<?php
class User extends AppModel {
            var $name = 'User';	 
            var $validate = array(
                    'username' => array(
                    'notempty' => array(
                    'rule' => 'isUnique',              
                    'required' => true,
                    'message' => 'User name is required.'

                    ),
                ),
                
                'new_password' => array(
                    'notempty' => array(
                    'rule' => array('notempty'),
                    'message' => 'Password is required field',
                    ),
                    'between' => array(
                    'rule' => array('between', 5, 15),
                    'message' => 'Password Minimum 5 characters long'
                    )
                ),
                
                'confirm_password' => array(
                    'notempty' => array(
                    'rule' => array('notempty'),
                    'message' => 'Repeat password is required field',
                    ),
                    'custom' => array(
                    'rule' => array('CheckPasswordMatch'),
                    'message' => 'Passwords did not match',
                    ),
                ),
                
                'email' => array(
                    'notempty' => array(
                    'rule' => array('notempty'),
                    'message' => 'Email is required field',
                    ),
                    'email' => array(
                    'rule' => array('email', true),
                    'message' => 'Please enter a valid email address'
                    )
                ),		

                'group_id' => array(
                    'numeric' => array(
                    'rule' => array('numeric'),
                    'notempty' => array(
                    'rule' => 'notempty',              
                    'required' => true,
                    'message' => 'User Group name is required.'),

                    ),
                ),
            );

            function CheckPasswordMatch($data) {
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
                    } 
                    else
                    {
                    $groupId = $this->field('group_id');
                    }
                    if (!$groupId) {
                    return null;
                    }
                    else 
                    {
                    return array('Group' => array('id' => $groupId));
                    }
            }
            
            function bindNode($user) {
                 return array('model' => 'Group', 'foreign_key' => $user['User']['group_id']);
            }
}