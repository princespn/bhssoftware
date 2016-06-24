<?php if($session->read('Auth.User.username')!='admin' && $session->read('Auth.User.group_id')!='1' && $session->read('Auth.User.group_id')!='5' && $session->read('Auth.User.group_id')!='2' && $session->read('Auth.User.group_id')!='4') 
{


$this->requestAction('/users/logout/', array('return'));


}
?>

<?php 
foreach ($products as $product) {
echo $product;
}

?>
