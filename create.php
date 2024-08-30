<?php 
	session_start();
	include '../conexao.php';


	$nome = filter_input(INPUT_POST,'nome', FILTER_SANITIZE_SPECIAL_CHARS);
	$email = filter_input(INPUT_POST,'email', FILTER_VALIDATE_EMAIL);
	$senha = filter_input(INPUT_POST,'senha', FILTER_SANITIZE_NUMBER_INT);
	$confsenha = filter_input(INPUT_POST,'confsenha', FILTER_SANITIZE_NUMBER_INT);
	// CAMPOS DA TABELA ENDEREÇO
	$rua = filter_input(INPUT_POST, 'rua', FILTER_SANITIZE_SPECIAL_CHARS);
	$bairro = filter_input(INPUT_POST, 'bairro', FILTER_SANITIZE_SPECIAL_CHARS);
	$cidade = filter_input(INPUT_POST, 'cidade', FILTER_SANITIZE_SPECIAL_CHARS);
	$cep = filter_input(INPUT_POST, 'cep', FILTER_SANITIZE_SPECIAL_CHARS);
	$uf = filter_input(INPUT_POST, 'uf', FILTER_SANITIZE_SPECIAL_CHARS);
	//SELECT TABELA USUARIO 
	$querySelect = $link->query('select email from usuario;');
	$array_emails = [];
	while($emails = $querySelect->fetch_assoc()):
		$emails_existentes = $emails['email'];
		array_push($array_emails, $emails_existentes);
	endwhile;
	echo $cep ." ". $uf;
	// // SELECT TABELA ENDEREÇO PARA EVITAR DE CADASTRAR RUAS REPETIDAS
	// $querySelectEndereco = $link->query("select nome_rua from endereco where nome_rua = ".$rua."';");
	// if (mysqli_affected_rows($link) > 0):
	// 	$rua = $querySelectEndereco ['nome_rua'];
	// endif;

	if (in_array($email, $array_emails)):
		$_SESSION['erro_Us'] = "<p class= 'center red-text'>Já existe um e-mail cadastrado!</p>";
		header("Location:../");
		echo "1";
		exit();
	else:
		if ($senha <> $confsenha):
			$_SESSION['erro_Us'] = "<p class= 'center red-text'>Senhas diferentes!</p>";
			header('Location:../');
			exit();
			echo "senha";
		else:
			$queryInsert = $link->query("insert into usuario (Cod_usuario, tipo, nome, email, senha) values (default,'Usuario Normal','".$nome."','".$email."','".$senha."');");

			$selectU = $link->query("select Cod_usuario from usuario where email='".$email."'");
			$codU = mysqli_fetch_assoc($selectU);

			$queryInsertEndereco = $link->query("insert into endereco (Cod_endereco, nome_rua, bairro, cidade, cep, estado, cod_usuario) values (default, '".$rua."','".$bairro."','".$cidade."','".$cep."','".$uf."',".$codU['Cod_usuario'].");");

			$affected_rows = mysqli_affected_rows($link);
			echo "insert";
			if ($affected_rows > 0):
				$selectE = $link->query("select Cod_endereco from endereco where cod_usuario=".$codU['Cod_usuario']);
				$codE = mysqli_fetch_assoc($selectE);
				$_SESSION ['end']= $codE ['Cod_endereco'];
				$_SESSION ['cod'] = $codU['Cod_usuario'];
				$_SESSION['erro_Us'] = "<p class= 'center green-text'>Cadastro Efetuado!<br></p>";
				header("Location:../../");
				echo "rows";
				exit();
			endif;
		endif;
	endif;
 ?>