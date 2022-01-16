<?php

require_once 'DB.php';

class ConselhoAno{
	
	protected $table = 'conselho_ano';
	private $ano;


    public function setAno($ano){
		$this->ano = $ano;
	}
	
		//Cadastra uma nova Conselho
	public function insert(){
         
        $sql  = "INSERT INTO $this->table (coa_ano) VALUES (:ano)";
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':ano', $this->ano);
		return $stmt->execute(); 

	}

		//Busca o ultimo conselho
	public function find($id){
		$sql  = "SELECT * FROM $this->table ";
		if($id == ''){
			
			$sql .= "WHERE coa_ano = (SELECT MAX(coa_ano) FROM $this->table)";
		
		}
		else{
			
			$sql.= "WHERE coa_id = :id";
			
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
	public function findAll(){
		$sql  = "SELECT * FROM $this->table ";
		$sql .= "ORDER BY coa_ano desc";
		$stmt = DB::prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll();
	}

}
