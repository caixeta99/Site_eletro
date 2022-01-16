<?php

require_once 'DB.php';

class ApmAno{

	protected $table = 'apm_ano';
	private $ano;
	
	public function setAno($ano){
		
		$this->ano = $ano;
		
	}
	
	//Cadastra uma nova APM
	public function insert(){
	
		$sql = "INSERT INTO $this->table(aa_ano) "
			  ."VALUES(:ano)";
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':ano', $this->ano);
		return $stmt->execute();
		
	}
	
	//Função que busca um registro pelo id
	public function find($id){

		$sql = "SELECT * FROM $this->table WHERE aa_id = :id";
		
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':id', $id, PDO::PARAM_INT);
		$stmt->execute();
		
		$verificacao = $stmt->rowCount();
		
		if(!($verificacao == 0)){
			
			return $stmt->fetch();
			
		}
		else
		{
		
			return false;
			
		}
		
	}
	
	//Função que busca todos os registros
	public function findAll(){
	
		$sql = "SELECT * FROM $this->table ORDER BY aa_ano DESC";
		
		$stmt = DB::prepare($sql);
		$stmt->execute();
		
		return $stmt->fetchAll();
		
	}
	
	//Função que busca o ultimo registro
	public function findLast(){

		$sql = "SELECT * FROM $this->table WHERE aa_ano = (SELECT MAX(aa_ano) FROM $this->table)";
		
		$stmt = DB::prepare($sql);
		$stmt->execute();
		
		$verificacao = $stmt->rowCount();
		
		if(!($verificacao == 0)){
			
			return $stmt->fetch();
			
		}
		else
		{
		
			return false;
			
		}
		
	}
	
}
