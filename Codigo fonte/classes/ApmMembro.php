<?php

require_once 'DB.php';

class ApmMembro{

	protected $table = 'apm_membro';
	private $ano;
	private $nome;
	private $cargo;
	private $rg;
	private $ativo;
	
	public function setAno($ano){
	
		$this->ano = $ano;
		
	}
	
	public function setNome($nome){
	
		if( (mb_strlen($nome) > 0) and (mb_strlen($nome) <= 100) )
		{
			
			$this->nome = $nome;
			return true;
			
		}
		else
		{
			
			return false;
			
		}
		
	}
	
	public function setCargo($cargo){
		
		if( (mb_strlen($cargo) > 0) and (mb_strlen($cargo) <= 100) )
		{
			
			$this->cargo = $cargo;
			return true;
			
		}
		else
		{
		
			return false;
			
		}
		
	}
	
	public function setRg($rg){
		
		if( (mb_strlen($rg) > 0) and (mb_strlen($rg) <= 30) )
		{
			
			$this->rg = $rg;
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
	
		$sql = "INSERT INTO $this->table (am_ano, am_cargo, am_nome, am_rg) "
			  ."VALUES(:ano, :cargo, :nome, :rg)";
			  
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':ano', $this->ano, PDO::PARAM_INT);
		$stmt->bindParam(':cargo', $this->cargo);
		$stmt->bindParam(':nome', $this->nome);
		$stmt->bindParam(':rg', $this->rg);

		return $stmt->execute();
		
	}
	
	//Função usadapara alterar falores de um determinado registro
	public function update($id){
		
		$sql = "UPDATE $this->table SET am_cargo = :cargo, am_nome = :nome, am_rg = :rg "
			  ."WHERE am_id = :id";
			  
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':cargo', $this->cargo);
		$stmt->bindParam(':nome', $this->nome);
		$stmt->bindParam(':rg', $this->rg);
		$stmt->bindParam(':id', $id, PDO::PARAM_INT);
		
		return $stmt->execute();
		
	}

	//Função para Desativação/Ativação de um registro
	public function delete($id){
	
		$sql = "UPDATE $this->table SET am_ativo = :ativo WHERE am_id = :id";
		
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':ativo', $this->ativo);
		$stmt->bindParam(':id', $id, PDO::PARAM_INT);
		
		return $stmt->execute();
		
	}
	
	//Função para buncar um determinado registro
	public function find($id){
	
		$sql = "SELECT * FROM $this->table WHERE am_id = :id";
		
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
	
	//Função que busca todos os registros
	public function findAll($ativo = 'N'){
	
		$sql = "SELECT * FROM $this->table WHERE am_ano = :ano ";
		if($ativo == 'S')
		{
			
			$sql .= "and am_ativo = 'S' ";
			
		}
		$sql .= "ORDER BY am_ativo";
		
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
