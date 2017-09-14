<?php

require 'crud.php';

if(isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['email']) && isset($_POST['id']))
{

	$data = [
		'first_name'=>$_POST['first_name'],
		'last_name'=>$_POST['last_name'],
		'email'=>$_POST['email'],
		'id'=>$_POST['id']
		];

	$crud->update($data);
}

?>