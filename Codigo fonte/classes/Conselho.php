<?php

require_once 'DB.php';

class Conselho{
	
	protected $table = 'conselho';
	private $nome;
	private $cargo;
	private $conselho;
	private $ativo;

	public function setNome($nome){
		if(mb_strlen($nome) <= 150){
			
			$this->nome = $nome;
			return true;
		}
		else{
			return false;
		}
	}

	public function setCargo($cargo){
		if(mb_strlen($cargo) <= 150){
			
			$this->cargo = $cargo;
			return true;
		}
		else{
			return false;
		}
	}

    public function setConselho($conselho){
		$this->conselho = $conselho;
	}

	public function setAtivo($ativo){
		if(($ativo == 'S')or($ativo == 'N')){
			$this->ativo = $ativo;
		}
	}
	
		//Cadastra um novo membro do conselho
	public function insert(){
         
        $sql  = "INSERT INTO $this->table (co_nome, co_cargo, co_ano) ";
        $sql .= "VALUES (:nome, :cargo, :conselho)";
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':nome', $this->nome);
		$stmt->bindParam(':cargo', $this->cargo);
		$stmt->bindParam(':conselho', $this->conselho, PDO::PARAM_INT);
		return $stmt->execute(); 

	}
		
		//Edita um membro do ultimo conselho existente
	public function update($id){

		$sql  = "UPDATE $this->table SET co_nome = :nome, co_cargo = :cargo ";
		$sql .= "WHERE co_id = :id";
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':nome', $this->nome);
		$stmt->bindParam(':cargo', $this->cargo);
		$stmt->bindParam(':id', $id, PDO::PARAM_INT);
		return $stmt->execute();

	}
		
		//Desativa/Ativa um determinado membro conselho
    public function delete($id){

		$sql  = "UPDATE $this->table SET co_ativo = :ativo WHERE co_id = :id";
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':ativo', $this->ativo);
		$stmt->bindParam(':id', $id, PDO::PARAM_INT);
		return $stmt->execute();

	}

		//Busca um determinado membro conselho
	public function find($id){
		$sql  = "SELECT * FROM $this->table WHERE co_id = :id";
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
	public function findAll($conselho, $ativo){
		$sql  = "SELECT * FROM $this->table ";
		$sql .= "WHERE co_ano = :conselho ";
		//Se ativo estiver marcado como 'S', buscará apenas os registros ativos
		if($ativo == 'S'){
		
			$sql .= "AND co_ativo = 'S' ";
			
		}
		$sql .= "ORDER BY co_ativo, co_cargo ASC";
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':conselho', $conselho, PDO::PARAM_INT);
		$stmt->execute();
			//verifica se há registros
		$count = $stmt->rowCount();

		if($count > 0){
			return $stmt->fetchAll();
		}
		else{
			return false;
		}
	}

}
