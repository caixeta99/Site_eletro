<?php

require_once 'DB.php';

class Usuarios{
	
	protected $table = 'usuarios';
	private $nome;
	private $login;
	private $senha;

	public function setNome($nome){
		if(mb_strlen($nome) <= 100){
			
			$this->nome = $nome;
			return true;
		}
		else{
			return false;
		}
	}

    public function setLogin($login){
		if((mb_strlen($login) <= 50)and(mb_strlen($login) >= 8)){
			
			$this->login = $login;
			return true;

		}
		else{

			return false;
		
		}
	}

	public function setSenha($senha){
		if((mb_strlen($senha) <= 50)and(mb_strlen($senha) >= 8)){
			
			$this->senha = $senha;
			return true;
		
		}
		else{
		
			return false;
		
		}
	}
		
		//Edita o nome e o login do usuario administrativo
	public function updateLogin($id){

		$sql  = "UPDATE $this->table SET u_nome = :nome, u_login = :login ";
		$sql .= "WHERE u_id = :id";
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':nome', $this->nome);
		$stmt->bindParam(':login', $this->login);
		$stmt->bindParam(':id', $id, PDO::PARAM_INT);
		return $stmt->execute();

	}

		//Edita a senha do usuario administrativo
	public function updateSenha($id){

		$sql  = "UPDATE $this->table SET u_senha = :senha WHERE u_id = :id";
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':senha', $this->senha);
		$stmt->bindParam(':id', $id, PDO::PARAM_INT);
		return $stmt->execute();

	}

		//Busca uma determinada data
	public function find($id){
		$sql  = "SELECT * FROM $this->table ";
		if($id != ''){
			
			$sql .= "WHERE u_id = :id ";

		}
		else{

			$sql .= "WHERE u_login = :login AND ";
			$sql .= "u_senha = :senha";
		
		}
		$stmt = DB::prepare($sql);
		if($id != ''){

			$stmt->bindParam(':id', $id);

		}
		else{
			
			$stmt->bindParam(':login', $this->login);
			$stmt->bindParam(':senha', $this->senha);
		
		}
		$stmt->execute();

			//verifica se o registro foi encontrado, se não retorna false
		$count = $stmt->rowCount();

		if($count > 0){
			return $stmt->fetch();
		}
		else{
			return false;
		}
	}

}
