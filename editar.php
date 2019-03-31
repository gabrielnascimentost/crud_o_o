<?php
	include 'contato.class.php';
	$contato = new Contato();
	if(!empty($_GET['id'])){
		$id = $_GET['id'];
		
	}else{
		header("Location: index.php");
		exit;	
	}
	
?>	

<h1>Editar</h1>

<form method="POST" action="adicionar_submit.php">
	Nome:</br>
	<input type="text" name="nome"/></br></br> 
	E-mail:</br>
	<input type="email" name="email"/></br></br>
	<input type="submit" name="Adicionar">
</form>	