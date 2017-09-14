<?php
	
require 'crud.php';

if(isset($_POST['id'])){

	$userId = $_POST['id'];

	echo $crud->details($userId);

}
	

?>