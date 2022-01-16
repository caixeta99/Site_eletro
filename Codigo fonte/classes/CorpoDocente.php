<?php

require_once 'DB.php';

class CorpoDocente{
	
	protected $table = 'corpo_docente';
	private $nome;
	private $email;
	private $ativo;

	public function setNome($nome){
		if(mb_strlen($nome) <= 100){
			
			$this->nome = $nome;
			return true;
		}
		else{
			return false;
		}
	}

	public function setEmail($email){
		if(mb_strlen($email) <= 100){
			
			$this->email = $email;
			return true;
		}
		else{
			return false;
		}
	}

	public function setAtivo($ativo){
		if(($ativo == 'S')or($ativo == 'N')){
			$this->ativo = $ativo;
		}
	}
	
		//Cadastra uma nova data
	public function insert(){
         
        $sql  = "INSERT INTO $this->table (cd_nome, cd_email) VALUES (:nome, :email)";
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':nome', $this->nome);
		$stmt->bindParam(':email', $this->email);
		return $stmt->execute(); 

	}
		
		//Edita uma data existente
	public function update($id){

		$sql  = "UPDATE $this->table SET cd_nome = :nome, cd_email = :email WHERE cd_id = :id";
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':nome', $this->nome);
		$stmt->bindParam(':email', $this->email);
		$stmt->bindParam(':id', $id, PDO::PARAM_INT);
		return $stmt->execute();

	}
		
		//Desativa/Ativa uma determinada data
    public function delete($id){

		$sql  = "UPDATE $this->table SET cd_ativo = :ativo WHERE cd_id = :id";
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':ativo', $this->ativo);
		$stmt->bindParam(':id', $id, PDO::PARAM_INT);
		return $stmt->execute();

	}

		//Busca uma determinada data
	public function find($id){
		$sql  = "SELECT * FROM $this->table WHERE cd_id = :id";
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':id', $id, PDO::PARAM_INT);
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
		
		//Busca todos os registros
	public function findAll($ativo){
		$sql  = "SELECT * FROM $this->table ";
		//Se ativo estiver marcado como 'S', buscará apenas os registros ativos
		if($ativo == 'S'){
		
			$sql .= "WHERE cd_ativo = 'S' ";
			
		}
		$sql .= "ORDER BY cd_ativo, cd_nome";
		$stmt = DB::prepare($sql);
		$stmt->execute();
			//verifica se há registros registros
		$count = $stmt->rowCount();

		if($count > 0){
			return $stmt->fetchAll();
		}
		else{
			return false;
		}
		
	}

}
