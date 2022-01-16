<?php

require_once 'DB.php';

class DocumentosCoordenacao{
	
	protected $table = 'documentos_coordenacao';
	private $caminho;
	private $documento;
	private $ano;

	public function setCaminho($caminho){
		if(mb_strlen($caminho) <= 200){
			
			$this->caminho = $caminho;
			return true;
		}
		else{
			return false;
		}
	}

    public function setDocumento($documento){
		if(($documento == 'Instrução Conjunta CETEC')or($documento == 'Diretrizes Gerais')or($documento == 'DELIBERAÇÃO CEE N 155/2017')or($documento == 'DELIBERAÇÃO CEE N 161/2018')or($documento == 'Autorização')or($documento == 'Controle de Presenca')){
			
			$this->documento = $documento;
			return true;
		}
		else{
			return false;
		}
	}

	public function setAno($ano){
		
		$this->ano = $ano;

	}
	
		//Cadastra um novo documento
	public function insert(){
        $sql  = "INSERT INTO $this->table (dc_documento, dc_ano) VALUES ('Instrução Conjunta CETEC', :ano),"
			 ."('Diretrizes Gerais', :ano),"
			 ."('DELIBERAÇÃO CEE N 155/2017', :ano),"
			 ."('DELIBERAÇÃO CEE N 161/2018', :ano),"
			 ."('Autorização', :ano),"
			 ."('Controle de Presenca', :ano)";
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':documento', $this->documento);
		$stmt->bindParam(':ano', $this->ano, PDO::PARAM_INT);
		return $stmt->execute(); 

	}
		
		//Edita um documento existente
	public function update($id){

		$sql  = "UPDATE $this->table SET dc_caminho = :caminho WHERE dc_id = :id";
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':caminho', $this->caminho);
		$stmt->bindParam(':id', $id, PDO::PARAM_INT);
		return $stmt->execute();

	}

		//Busca um determinado documento
	public function find($id){
		$sql  = "SELECT * FROM $this->table WHERE dc_id = :id";
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
	public function findAll($ano){

		$sql  = "SELECT * FROM $this->table ";
		$sql .= "WHERE dc_ano = :ano ";
		$sql .= "ORDER BY dc_documento ";
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':ano', $ano, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetchAll();
	
	}

}
