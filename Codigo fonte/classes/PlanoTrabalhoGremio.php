<?php

require_once 'DB.php';

class PlanoTrabalhoGremio{
	
	protected $table = 'plano_trabalho';
	private $descricao;
	private $categoria;
	private $gremio;
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

    public function setCategoria($categoria){
		if(($categoria == 'Cultura')or($categoria == 'Esporte')or($categoria == 'Política')or($categoria == 'Social')or($categoria == 'Comunicação')){
			
			$this->categoria = $categoria;
			return true;
			
		}
		else{
		
			return false;
			
		}
	}

	public function setGremio($gremio){
		$this->gremio = $gremio;
	}
	
	public function setAtivo($ativo){
		if(($ativo == 'S')or($ativo == 'N')){
			$this->ativo = $ativo;
		}
	}

	public function insert(){
         
        $sql  = "INSERT INTO $this->table (pt_categoria, pt_descricao, pt_gremio) VALUES (:categoria, :descricao, :gremio)";
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':categoria', $this->categoria);
		$stmt->bindParam(':descricao', $this->descricao);
		$stmt->bindParam(':gremio', $this->gremio);
		return $stmt->execute(); 

	}

	public function update($id){

		$sql  = "UPDATE $this->table SET pt_descricao = :descricao, pt_categoria = :categoria WHERE pt_id = :id";
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':descricao', $this->descricao);
		$stmt->bindParam(':categoria', $this->categoria);
		$stmt->bindParam(':id', $id, PDO::PARAM_INT);
		return $stmt->execute();

	}

    public function delete($id){

		$sql  = "UPDATE $this->table SET pt_ativo = :ativo WHERE pt_id = :id";
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':ativo', $this->ativo);
		$stmt->bindParam(':id', $id, PDO::PARAM_INT);
		return $stmt->execute();

	}

	public function find($id, $id_gremio){
		$sql  = "SELECT * FROM $this->table WHERE pt_id = :id AND pt_gremio = :id_gremio";
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':id', $id, PDO::PARAM_INT);
		$stmt->bindParam(':id_gremio', $id_gremio, PDO::PARAM_INT);
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
	
		//pega todos os planos de trabalho de um determinado gremio
	public function findAll($id_gremio, $ativo, $categoria){
		$sql  = "SELECT * FROM $this->table ";
		$sql .= "WHERE pt_gremio = :id_gremio ";
			//se ativo foi igual a S entao serao pegos apenas os planos de trabalho ativos
		if($ativo == 'S'){
		
			$sql .= "AND pt_ativo = 'S' ";
		
		}
			//se ativo foi igual a S entao serao pegos apenas os planos de trabalho ativos
		if($categoria != ''){

			$sql .= "AND pt_categoria = :categoria ";
		
		}
		$sql .= "ORDER BY pt_ativo, pt_categoria";
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':id_gremio', $id_gremio, PDO::PARAM_INT);
		if($categoria != ''){

			$stmt->bindParam(':categoria', $categoria);
		
		}
		$stmt->execute();
		
			//verifica se o registro foi encontrado, se não retorna false
		$count = $stmt->rowCount();
		
		if($count > 0){
			return $stmt->fetchAll();
		}
		else{
			return false;
		}
	}

}
