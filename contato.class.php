<?php
 class Contato {
    private $pdo;
    
    public function __construct(){
        $this->pdo = new PDO("mysql:dbname=crud_o_o;host=localhost", "root", "");
    }

    public function adicionar($email, $nome = ''){ //primeiro vêm o obrigatório
    	// 1º passo -> verifica se o email já existe no sistema
    	// 2º passo -> adicionar
    	if($this->verificaEmail($email) == false){
    		$sql = "INSERT INTO contatos (nome, email) VALUES (:nome, :email)";
    		$sql = $this->pdo->prepare($sql);
    		$sql->bindValue(':nome', $nome);
    		$sql->bindValue(':email', $email);
    		$sql->execute();
    		return true;
    	}else{
    		return false;
    	}
    }

    public function getInfo($id){
    	$sql = "SELECT * FROM contatos WHERE id = :id";
    	$sql = $this->pdo->prepare($sql);
    	$sql->bindValue(':id', $id);
    	$sql->execute();

    	if($sql->rowCount() > 0){
    		return $sql->fetch();
    	}else{
    		return array();
    	}
    }

    public function getAll(){
    	$sql = "SELECT * FROM contatos";
    	$sql = $this->pdo->query($sql);

    	if($sql->rowCount() > 0){
    		return $sql->fetchAll();
    	}else{
    		return array();
    	}
    }

    public function editar($nome, $email, $id){
    	if($this->verificaEmail($email) == false){
    		$sql = "UPDATE contatos SET nome = :nome, email = :email WHERE id = :id";
    		$sql = $this->pdo->prepare($sql);
    		$sql->bindValue(':nome', $nome);
    		$sql->bindValue(':email', $email);
    		$sql->bindValue(':id', $id);
    		$sql->execute();
    		return true;	
    	}else{
    		return false;
    	}   	
    }

    public function excluirPeloId($id){
    	$sql = "DELETE FROM contatos WHERE id = :id";
    	$sql = $this->pdo->prepare($sql);
    	$sql->bindValue(':id', $id);
    	$sql->execute();
    }

     public function excluirPeloEmail($email){
    	$sql = "DELETE FROM contatos WHERE email = :email";
    	$sql = $this->pdo->prepare($sql);
    	$sql->bindValue(':email', $email);
    	$sql->execute();
    }

    private function verificaEmail($email){
    	$sql = "SELECT * FROM contatos WHERE email =  :email";
    	$sql = $this->pdo->prepare($sql);
   		$sql->bindValue(':email', $email);
    	$sql->execute();
    	if($sql->rowCount() > 0){
    		return true;
    	}else{
    		return false;
    	}
    }     
 }
 