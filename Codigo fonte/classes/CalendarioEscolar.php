<?php

require_once 'DB.php';

class CalendarioEscolar{
	
	protected $table = 'calendario';
	private $ano;
	private $documento;

	public function setDocumento($documento){
		if(mb_strlen($documento) <= 500){
			$this->documento = $documento;
		}
	}

    public function setAno($ano){
		$this->ano = $ano;
	}

	public function insert(){
         
        $sql  = "INSERT INTO $this->table (ca_ano) VALUES (:ano)";
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':ano', $this->ano);
		return $stmt->execute(); 

	}

	public function update($ano){

		$sql  = "UPDATE $this->table SET ca_documento = :documento WHERE ca_ano = :ano";
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':documento', $this->documento);
		$stmt->bindParam(':ano', $ano);
		return $stmt->execute();

	}
		
		//Pega o ultimo calendario cadastrado
	public function findLast(){
		$sql  = "SELECT MAX(ca_ano) as ano FROM $this->table";
		$stmt = DB::prepare($sql);
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
		
		
	public function find($ano){
		$sql  = "SELECT * FROM $this->table WHERE ca_ano = :ano";
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':ano', $ano);
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
		
		//Busca todos os calendarios
	public function findAll(){
		$sql  = "SELECT * FROM $this->table ORDER BY ca_ano desc";
		$stmt = DB::prepare($sql);
		$stmt->execute();
		
			//verifica se foram encontrados registros, se não retorna false
		$count = $stmt->rowCount();

		if($count > 0){
			return $stmt->fetchAll();
		}
		else{
			return false;
		}
		
	}

}
