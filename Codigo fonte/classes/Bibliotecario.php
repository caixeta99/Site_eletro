<?php

require_once 'DB.php';

class Bibliotecario{
	
	protected $table = 'biblioteca_funcionario';
	private $nome;
	private $cargo;
	private $ativo;

	public function setNome($nome){
		if(mb_strlen($nome) <= 200){
			
			$this->nome = $nome;
			return true;
		}
		else{
			return false;
		}
	}

	public function setCargo($cargo){
		if(mb_strlen($cargo) <= 200){
			
			$this->cargo = $cargo;
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
         
        $sql  = "INSERT INTO $this->table (b_nome, b_cargo) ";
        $sql .= "VALUES (:nome, :cargo)";
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':nome', $this->nome);
		$stmt->bindParam(':cargo', $this->cargo);
		return $stmt->execute(); 

	}
		
		//Edita uma data existente
	public function update($id){

		$sql  = "UPDATE $this->table SET b_nome = :nome, b_cargo = :cargo WHERE b_id = :id";
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':nome', $this->nome);
		$stmt->bindParam(':cargo', $this->cargo);
		$stmt->bindParam(':id', $id, PDO::PARAM_INT);
		return $stmt->execute();

	}
		
		//Desativa/Ativa uma determinada data
    public function delete($id){

		$sql  = "UPDATE $this->table SET b_ativo = :ativo WHERE b_id = :id";
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':ativo', $this->ativo);
		$stmt->bindParam(':id', $id, PDO::PARAM_INT);
		return $stmt->execute();

	}

		//Busca uma determinada data
	public function find($id){
		$sql  = "SELECT * FROM $this->table ";
		if($id != ''){
			
			$sql .= "WHERE b_id = :id";
			
		}
		else{
			
			$sql .= "WHERE b_id = (SELECT MAX(b_id) FROM $this->table)";
			
		}
		$stmt = DB::prepare($sql);
		if($id != ''){

			$stmt->bindParam(':id', $id, PDO::PARAM_INT);
		
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
		
		//Busca todos os registros
	public function findAll($ativo){
		$sql  = "SELECT * FROM $this->table ";
		//Se ativo estiver marcado como 'S', buscará apenas os registros ativos
		if($ativo == 'S'){
		
			$sql .= "WHERE b_ativo = 'S' ";
			
		}
		$sql .= "ORDER BY b_ativo, b_nome";
		$stmt = DB::prepare($sql);
		$stmt->execute();
			
			//verifica se foi encontrado algum registro, se não retorna false
		$count = $stmt->rowCount();

		if($count > 0){
			return $stmt->fetchAll();
		}
		else{
			return false;
		}
	}

}
