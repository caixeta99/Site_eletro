<?php

require_once 'DB.php';

class DocumentosAno{
	
	protected $table = 'documentos_ano';
	private $ano;


    public function setAno($ano){
		$this->ano = $ano;
	}
	
		//Cadastra uma novo ano
	public function insert(){
         
        $sql  = "INSERT INTO $this->table (doc_ano) VALUES (:ano)";
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':ano', $this->ano);
		return $stmt->execute(); 

	}

		//Busca o ultimo ano que foram cadastrados os documentos
	public function find($id, $ano=''){
		$sql  = "SELECT * FROM $this->table ";
		if($ano == ''){
			if($id == ''){
				
				$sql .= "WHERE doc_ano = (SELECT MAX(doc_ano) FROM $this->table)";
			
			}
			else{
				
				$sql.= "WHERE doc_id = :id";
				
			}
		}else{
		
			$sql.= "WHERE doc_ano = :ano";
		
		}
		$stmt = DB::prepare($sql);
		if($ano == ''){
			if($id != ''){
				
				$stmt->bindParam(':id', $id, PDO::PARAM_INT);
				
			}
		}else{
		
			$stmt->bindParam(':ano', $ano, PDO::PARAM_INT);
			
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
		$sql .= "ORDER BY doc_ano desc";
		$stmt = DB::prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll();
	}

}
