<?php


include_once '../includes/header.inc.php';?>

<div class="row container">
	<div class="col s12">
		<h5 class="light">Consultas</h5><hr>
		<table class="striped">
			<thead>
				<tr>
					<th>Nome</th>
					<th>Assunto</th>
					<th>Aprovação</th>
					<th>Data de Postagem<th>
				</tr>
			</thead>
			<tbody>
				<?php 
					include_once 'banco_de_dados/admLogica.php';
				 ?>
			</tbody>
		</table>
	</div>
</div>


<?php 
include_once '../includes/footer.inc.php';
?>