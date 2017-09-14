<?php

require_once 'crud.php';

$users = $crud->read();

$table = '<table class="table table-bordered table-striped text-center">
						<tr>
							<th>Nome</th>
							<th>Sobrenome</th>
							<th>Email</th>
							<th>Operações</th>
						</tr>';

if (count($users)>0) {
	foreach ($users as $user) {
		$table .= '<tr>
					<td>'.$user['first_name'].'</td>
					<td>'.$user['last_name'].'</td>
					<td>'.$user['email'].'</td>
					<td>
						<button class="btn btn-info" onclick="getUserDetails('.$user['id'].')">
							Detalhes
						</button>
					
						<button class="btn btn-danger" onclick="deleteUser('.$user['id'].')">
							Excluir
						</button>
					</td>
				   </tr>';
	}
} else {
	$table .= '<tr><td colspan="4"><h4><div class="label label-warning">Nenhum usuário cadastrado!</div></h4></td></tr>';
}

$table .= '</table>';

echo $table;



?>