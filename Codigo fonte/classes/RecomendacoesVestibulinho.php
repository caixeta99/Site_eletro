<?php

require_once 'DB.php';

class RecomendacoesVestibulinho{
	
	protected $table = 'vestibular_recomendacoes';
	private $descricao;
	private $vestibulinho;
	private $ativo;

	public function setDescricao($descricao){
		if(mb_strlen($descricao) <= 700){
			
			$this->descricao = $descricao;
			return true;
		}
		else{
			return false;
		}
	}

    public function setVestibulinho($vestibulinho){
		$this->vestibulinho = $vestibulinho;
	}

	public function setAtivo($ativo){
		if(($ativo == 'S')or($ativo == 'N')){
			$this->ativo = $ativo;
		}
	}
	
		//Cadastra uma nova recomendacao
	public function insert(){
         
        $sql  = "INSERT INTO $this->table (vr_descricao, vr_vestibular) ";
        $sql .= "VALUES (:descricao, :vestibulinho)";
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':descricao', $this->descricao);
		$stmt->bindParam(':vestibulinho', $this->vestibulinho);
		return $stmt->execute(); 

	}
		
		//Edita uma recomendacao existente
	public function update($id){

		$sql  = "UPDATE $this->table SET vr_descricao = :descricao WHERE vr_id = :id";
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':descricao', $this->descricao);
		$stmt->bindParam(':id', $id, PDO::PARAM_INT);
		return $stmt->execute();

	}
		
		//Desativa/Ativa uma determinada recomendacao
    public function delete($id){

		$sql  = "UPDATE $this->table SET vr_ativo = :ativo WHERE vr_id = :id";
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':ativo', $this->ativo);
		$stmt->bindParam(':id', $id, PDO::PARAM_INT);
		return $stmt->execute();

	}

		//Busca uma determinada recomendacao
	public function find($id){
		$sql  = "SELECT * FROM $this->table WHERE vr_id = :id";
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
	public function findAll($vestibulinho, $ativo){
		$sql  = "SELECT * FROM $this->table WHERE vr_vestibular = :vestibulinho ";
		//Se ativo estiver marcado como 'S', buscará apenas os registros ativos
		if($ativo == 'S'){
		
			$sql .= "AND vr_ativo = 'S' ";
			
		}
		$sql .= "ORDER BY vr_ativo, vr_descricao";
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':vestibulinho', $vestibulinho, PDO::PARAM_INT);
		$stmt->execute();
			//verifica se há registros, se não retorna false
		$count = $stmt->rowCount();

		if($count > 0){
			return $stmt->fetchAll();
		}
		else{
			return false;
		}
	}

}
