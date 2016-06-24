<?php 
if($session->read('Auth.User.group_id')!='1' && $session->read('Auth.User.group_id')!='2')
{
$this->requestAction('/users/logout/', array('return'));
}
?>
<?php 
//$filename = $_SERVER['DOCUMENT_ROOT'] . '/app/webroot/files/' .$filename; 
//$data = $this->requestAction('/inventory_masters/saleprice');
//print_r($data);die();                 
?>
