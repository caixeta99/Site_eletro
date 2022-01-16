<?php

require_once 'DB.php';

class CalendarioData{
	
	protected $table = 'datas_do_calendario';
	private $descricao;
	private $data;
	private $ativo;

	public function setDescricao($descricao){
		if(mb_strlen($descricao) <= 150){
			
			$this->descricao = $descricao;
			return true;
		}
		else{
			return false;
		}
	}

    public function setData($data){
		$this->data = $data;
	}

	public function setAtivo($ativo){
		if(($ativo == 'S')or($ativo == 'N')){
			$this->ativo = $ativo;
		}
	}
	
		//Cadastra uma nova data
	public function insert(){
         
        $sql  = "INSERT INTO $this->table (d_descricao, d_data) VALUES (:descricao, :data)";
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':descricao', $this->descricao);
		$stmt->bindParam(':data', $this->data);
		return $stmt->execute(); 

	}
		
		//Edita uma data existente
	public function update($id){

		$sql  = "UPDATE $this->table SET d_descricao = :descricao, d_data = :data WHERE d_id = :id";
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':descricao', $this->descricao);
		$stmt->bindParam(':data', $this->data);
		$stmt->bindParam(':id', $id, PDO::PARAM_INT);
		return $stmt->execute();

	}
		
		//Desativa/Ativa uma determinada data
    public function delete($id){

		$sql  = "UPDATE $this->table SET d_ativo = :ativo WHERE d_id = :id";
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':ativo', $this->ativo);
		$stmt->bindParam(':id', $id, PDO::PARAM_INT);
		return $stmt->execute();

	}

		//Busca uma determinada data
	public function find($id){
		$sql  = "SELECT * FROM $this->table WHERE d_id = :id";
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
	public function findAll($data_i, $data_f, $ativo, $limite, $ordem){
		$sql  = "SELECT * FROM $this->table ";
		//Se ativo estiver marcado como 'S', buscará apenas os registros ativos de um determinado periodo
		if($ativo == 'S'){
		
			$sql .= "WHERE d_ativo = 'S' ";
				//Verifica se existe uma data inicial
			if(($data_i != '')){
			
				$sql .= "AND d_data >= :data_i ";
			
			}
				//Verifica se existe uma data final
			if(($data_f != '')){
			
				$sql .= "AND d_data < :data_f ";
			
			}
			
		}
		$sql .= "ORDER BY d_ativo, d_data ";
		if(($ordem == 'ASC')){
			
			$sql .= "ASC ";
			
		}
		else{
				
			$sql .= "DESC ";
				
		}
		if($limite == 'S'){
			
			$sql .= "LIMIT 4";
			
		}
		$stmt = DB::prepare($sql);
		if($ativo == 'S'){
			
			if(($data_f != '')){
			
				$stmt->bindParam(':data_f', $data_f);
			
			}
			if(($data_i != '')){
			
				$stmt->bindParam(':data_i', $data_i);
			
			}
		
		}
		$stmt->execute();
		if($limite == 'S'){
			$count = $stmt->rowCount();
			if($count < 4){
				$sql = "SELECT * FROM $this->table WHERE d_ativo = 'S' ORDER BY d_data DESC LIMIT 4 ";
				$stmt = DB::prepare($sql);
				$stmt->execute();
			}
		}
		return $stmt->fetchAll();
	}

}