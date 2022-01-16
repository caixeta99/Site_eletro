<?php

require_once 'DB.php';

class ConselhoClasseSemestre{

	protected $table = 'conselho_classe_semestre';
	private $ano;
	private $semestre;
	
	public function setAno($ano){
		
		$this->ano = $ano;
		
	}
	
	public function setSemestre($semestre){
		
		if( ($semestre == '1º Semestre') or ($semestre == '2º Semestre') )
		{
			
			$this->semestre = $semestre;
			return true;
		
		}
		else
		{
		
			return false;	
		
		}
		
	}
	
	//Cadastra uma nova APM
	public function insert(){
	
		$sql = "INSERT INTO $this->table(ccs_ano, ccs_semestre) "
			  ."VALUES(:ano, :semestre)";
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':ano', $this->ano);
		$stmt->bindParam(':semestre', $this->semestre);
		return $stmt->execute();
		
	}
	
	//Função que busca um registro pelo id
	public function find($id){

		$sql = "SELECT * FROM $this->table WHERE ccs_id = :id";
		
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
	
		$sql = "SELECT * FROM $this->table ORDER BY ccs_ano DESC, ccs_semestre DESC";
		
		$stmt = DB::prepare($sql);
		$stmt->execute();
		
		return $stmt->fetchAll();
		
	}
	
	//Função que busca o ultimo registro
	public function findLast(){

		$sql = "SELECT * FROM $this->table "
              ."WHERE ccs_ano = (SELECT MAX(ccs_ano) FROM $this->table) "
              ."AND ccs_semestre = (SELECT MAX(ccs_semestre) FROM $this->table "
			  ."WHERE ccs_ano = (SELECT MAX(ccs_ano) FROM $this->table))";
		
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
