<?php

require_once 'DB.php';

class PrestacaoContas{
	
	protected $table = 'prestacacao_contas';
	private $ano;
	private $pagina;

	public function setAno($ano){
			
		$this->ano = $ano;
		
	}

	public function setPagina($pagina){
		if(($pagina == 'Direção de Serviço')or($pagina == 'Refeitório')){
			
			$this->pagina = $pagina;
			return true;
		}
		else{
			return false;
		}
	}
	
		//Cadastra uma nova pretação de contas
	public function insert(){
         
        $sql  = "INSERT INTO $this->table (pc_ano, pc_pagina) ";
        $sql .= "VALUES (:ano, :pagina)";
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':ano', $this->ano);
		$stmt->bindParam(':pagina', $this->pagina);
		return $stmt->execute(); 

	}
		
		//Edita uma data existente
	public function update($id){

		$sql  = "UPDATE $this->table SET pc_ano = :ano, pc_pagina = :pagina WHERE pc_id = :id";
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':ano', $this->ano);
		$stmt->bindParam(':pagina', $this->pagina);
		$stmt->bindParam(':id', $id, PDO::PARAM_INT);
		return $stmt->execute();

	}

		//Busca uma determinada data
	public function find($id){
		$sql  = "SELECT * FROM $this->table ";
		if($id != ''){
		
			$sql .= "WHERE pc_id = :id";
		
		}
		else{
			
			$sql .= "WHERE pc_id = (SELECT MAX(pc_id) FROM $this->table)";
		
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
	public function findAll($pagina){
		$sql  = "SELECT * FROM $this->table ";
		//Busca as prestacoes de contas de um determinado segmento
		if(($pagina == 'Direção de Serviço')or($pagina == 'Refeitório')){
		
			$sql .= "WHERE pc_pagina = :pagina ";
			
		}
		$sql .= "ORDER BY pc_pagina, pc_ano desc";
		$stmt = DB::prepare($sql);
		if(($pagina == 'Direção de Serviço')or($pagina == 'Refeitório')){

			$stmt->bindParam(':pagina', $pagina);
		
		}
		$stmt->execute();
		
			//verifica se há registro 
		$count = $stmt->rowCount();

		if($count > 0){
			return $stmt->fetchAll();
		}
		else{
			return false;
		}

	}

}
