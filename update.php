<?php 
include_once '../conexao.php';

$id = $_SESSION['id'];
$nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
$tipo = filter_input(INPUT_POST, 'tipo', FILTER_SANITIZE_NUMBER_INT);
// ARRUMAR
$queryUpdate = $link->query("update usuario set nome='" .$nome."', email='".$email."',tipo='".$tipo."'where Cod_usuario =" .$id);
$affected_rows = mysqli_affected_rows($link);
echo $queryUpdate;
if ($affected_rows > 0):
	$_SESSION['msg'] =  "<p class= 'center green-text'>".'Cadastro Alterado!'."<br>";
	header('Location:../consultas.php');
endif;

 ?>