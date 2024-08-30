<?php 

include_once '../conexao.php';

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_SPECIAL_CHARS);
// ARRUMARRR
$queryDelete = $link->query("delete from usuario where Cod_usuario='".$id."';");
if (mysqli_affected_rows($link) > 0):
	header('Location:../consultas.php');
endif;

 ?>