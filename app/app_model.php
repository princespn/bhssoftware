<?php

class AppModel extends Model {
		public $recursive = -1;
        function beforeSave() {
                $exists = $this->exists();
                if ( !$exists && $this->hasField('creator_id') && empty($this->data[$this->alias]['creator_id']) ) {
                        $this->data[$this->alias]['creator_id'] = LoadsysAuth::getUserId();
                }
                if ( !$exists && $this->hasField('user_id') && empty($this->data[$this->alias]['user_id']) ) {
                        $this->data[$this->alias]['user_id'] = LoadsysAuth::getUserId();
                }
                if ( $this->hasField('modifier_id') && empty($this->data[$this->alias]['modifier_id']) ) {
                        $this->data[$this->alias]['modifier_id'] = LoadsysAuth::getUserId();
                }
                return true;
        }
        
   public function paginateCount($conditions = null, $recursive = 0, $extra = array()) {
    $parameters = compact('conditions', 'recursive');
    if (isset($extra['group'])) {
        $parameters['fields'] = $extra['group'];
        if (is_string($parameters['fields'])) {
            // pagination with single GROUP BY field
            if (substr($parameters['fields'], 0, 9) != 'DISTINCT ') {
                $parameters['fields'] = 'DISTINCT ' . $parameters['fields'];
            }
            unset($extra['group']);
            $count = $this->find('count', array_merge($parameters, $extra));
        } else {
            // resort to inefficient method for multiple GROUP BY fields
            $count = $this->find('count', array_merge($parameters, $extra));
            $count = $this->getAffectedRows();
        }
    } else {
        // regular pagination
        $count = $this->find('count', array_merge($parameters, $extra));
    }
    return $count;
}
}

?>
