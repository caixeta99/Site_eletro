<?php

require_once 'DB.php';

class EventoData{
	
	protected $table = 'data_evento';
	private $evento;
	private $data;
	private $ativo;

	public function setEvento($evento){
		
		$this->evento = $evento;

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
         
        $sql  = "INSERT INTO $this->table (de_evento, de_data) VALUES (:evento, :data)";
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':evento', $this->evento);
		$stmt->bindParam(':data', $this->data);
		return $stmt->execute(); 

	}
		
		//Edita uma data existente
	public function update($id){

		$sql  = "UPDATE $this->table SET de_data = :data WHERE de_id = :id";
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':data', $this->data);
		$stmt->bindParam(':id', $id, PDO::PARAM_INT);
		return $stmt->execute();

	}
		
		//Desativa/Ativa uma determinada data
    public function delete($id){

		$sql  = "UPDATE $this->table SET de_ativo = :ativo WHERE de_id = :id";
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':ativo', $this->ativo);
		$stmt->bindParam(':id', $id, PDO::PARAM_INT);
		return $stmt->execute();

	}

		//Busca a quantidade de datas ativas de um determinado evento
	public function findCount($evento){
		$sql  = "SELECT COUNT(*) as qtd FROM $this->table ";
		$sql .= "WHERE de_evento = :id_evento AND ";
		$sql .= "de_ativo = 'S'";
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':id_evento', $evento, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetch();

	}

		//Busca uma determinada data
	public function find($id){
		$sql  = "SELECT * FROM $this->table WHERE de_id = :id";
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
	public function findAll($id_evento, $ativo){
		$sql  = "SELECT * FROM $this->table ";
		$sql .= "WHERE de_evento = :id_evento ";
		//Se ativo estiver marcado como 'S', buscará apenas os registros ativos
		if($ativo == 'S'){
		
			$sql .= "AND de_ativo = 'S' ";
			
		}
		$sql .= "ORDER BY de_ativo, de_data";
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':id_evento', $id_evento, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetchAll();
	}

}
