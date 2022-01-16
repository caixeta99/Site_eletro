<?php

require_once 'DB.php';

class ApmPlanoTrabalho{

	protected $table = 'apm_plano_trabalho';
	private $ano;
	private $descricao;
	private $ativo;
	
	public function setAno($ano){
	
		$this->ano = $ano;
		
	}
	
	public function setDescricao($descricao){
	
		if( (mb_strlen($descricao) > 0) and (mb_strlen($descricao) <= 200) )
		{
			
			$this->descricao = $descricao;
			return true;
			
		}
		else
		{
			
			return false;
			
		}
		
	}
	
	public function setAtivo($ativo){
	
		if($ativo == 'S' or $ativo == 'N')
		{
			
			$this->ativo = $ativo;
			return true;
			
		}
		else
		{
		
			return false;
			
		}
		
	}

		//Cadastra um novo membro da APM
	public function insert(){
	
		$sql = "INSERT INTO $this->table (apt_ano, apt_descricao) "
			  ."VALUES(:ano, :descricao)";
			  
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':ano', $this->ano, PDO::PARAM_INT);
		$stmt->bindParam(':descricao', $this->descricao);

		return $stmt->execute();
		
	}
	
	//Função usadapara alterar falores de um determinado registro
	public function update($id){
		
		$sql = "UPDATE $this->table SET apt_descricao = :descricao "
			  ."WHERE apt_id = :id";
			  
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':descricao', $this->descricao);
		$stmt->bindParam(':id', $id, PDO::PARAM_INT);
		
		return $stmt->execute();
		
	}

	public function delete($id){
	
		$sql = "UPDATE $this->table SET apt_ativo = :ativo WHERE apt_id = :id";
		
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':ativo', $this->ativo);
		$stmt->bindParam(':id', $id, PDO::PARAM_INT);
		
		return $stmt->execute();
		
	}
	
	public function find($id){
	
		$sql = "SELECT * FROM $this->table WHERE apt_id = :id";
		
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':id', $id, PDO::PARAM_INT);
		$stmt->execute();
		
		$verificacao = $stmt->rowCount();
		
		if($verificacao != 0)
		{
		
			return $stmt->fetch();
			
		}
		else
		{
		
			return false;
			
		}
		
	}
	
	public function findAll($ativo = 'N'){
	
		$sql = "SELECT * FROM $this->table WHERE apt_ano =:ano ";
		if($ativo == 'S')
		{
			
			$sql .= "and apt_ativo = 'S' ";
			
		}
		$sql .= "ORDER BY apt_ativo";
		
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':ano', $this->ano, PDO::PARAM_INT);
		$stmt->execute();
		
		$verificacao = $stmt->rowCount();
		
		if($verificacao != 0)
		{
		
			return $stmt->fetchAll();
		
		}
		else
		{
		
			return false;
			
		}
		
	}

}
