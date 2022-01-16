<?php

require_once 'DB.php';

class HorarioAulas{
	
	protected $table = 'horario_das_aulas';
	private $documento;
	private $descricao;

	public function setDocumento($documento){
		
		if(mb_strlen($documento) <= 500){
			$this->documento = $documento;
		}
	
	}
	public function setDescricao($descricao){
		if( (mb_strlen($descricao) > 0) and (mb_strlen($descricao) <= 200) ){
			$this->descricao = $descricao;
			return true;
		}
		else
		{
			return false;	
		}
	}

	public function update($horario){

		$sql  = "UPDATE $this->table SET ha_documento = :documento, ha_descricao = :descricao WHERE ha_periodo = :horario";
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':documento', $this->documento);
		$stmt->bindParam(':descricao', $this->descricao);
		$stmt->bindParam(':horario', $horario);
		return $stmt->execute();

	}

	public function find($horario){
		$sql  = "SELECT * FROM $this->table WHERE ha_periodo = :horario";
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':horario', $horario);
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
	
	public function findAll(){
		
		$sql  = "SELECT * FROM $this->table ";
		$sql .= "ORDER BY ha_periodo";
		$stmt = DB::prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll();
		
	}

}
