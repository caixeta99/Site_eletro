<?php

require_once 'DB.php';

class ConselhoClasse{

	protected $table = 'conselho_classe';
	private $conselho;
	private $periodo;
	private $turma;
	private $documento;
	private $ativo;
	
	public function setConselho($conselho){
	
		$this->conselho = $conselho;
		
	}
	
	public function setPeriodo($periodo){
	
		if( ($periodo == 'Ensino médio') or ($periodo == 'Ensino integrado') or ($periodo == 'Ensino integrado - Novotec') or ($periodo == 'Ensino técnico') )
		{
			
			$this->periodo = $periodo;
			return true;
			
		}
		else
		{
			
			return false;
			
		}
		
	}
	
	public function setTurma($turma){
		
		if( (mb_strlen($turma) > 0) and (mb_strlen($turma) <= 50) )
		{
			
			$this->turma = $turma;
			return true;
			
		}
		else
		{
		
			return false;
			
		}
		
	}
	
	public function setDocumento($documento){
		
		if( (mb_strlen($documento) > 0) and (mb_strlen($documento) <= 200) )
		{
			
			$this->documento = $documento;
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
	
		$sql = "INSERT INTO $this->table (cc_conselho, cc_periodo, cc_turma, cc_documento) "
			  ."VALUES(:conselho, :periodo, :turma, :documento)";
			  
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':conselho', $this->conselho, PDO::PARAM_INT);
		$stmt->bindParam(':periodo', $this->periodo);
		$stmt->bindParam(':turma', $this->turma);
		$stmt->bindParam(':documento', $this->documento);

		return $stmt->execute();
		
	}
	
	//Função usadapara alterar falores de um determinado registro
	public function update($id){
		
		$sql = "UPDATE $this->table SET cc_periodo = :periodo, cc_turma = :turma, cc_documento = :documento "
			  ."WHERE cc_id = :id";
			  
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':periodo', $this->periodo);
		$stmt->bindParam(':turma', $this->turma);
		$stmt->bindParam(':documento', $this->documento);
		$stmt->bindParam(':id', $id, PDO::PARAM_INT);
		
		return $stmt->execute();
		
	}

	//Função para Desativação/Ativação de um registro
	public function delete($id){
	
		$sql = "UPDATE $this->table SET cc_ativo = :ativo WHERE cc_id = :id";
		
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':ativo', $this->ativo);
		$stmt->bindParam(':id', $id, PDO::PARAM_INT);
		
		return $stmt->execute();
		
	}
	
	//Função para buncar um determinado registro
	public function find($id){
	
		$sql = "SELECT * FROM $this->table ";

		if($id != 0)
		{
			
			$sql .= "WHERE cc_id = :id";
		
		}
		else
		{

			$sql .= "WHERE cc_conselho = :conselho AND cc_periodo = :periodo AND cc_turma = :turma";
			
		}

		$stmt = DB::prepare($sql);
		if($id != 0)
		{
			
			$stmt->bindParam(':id', $id, PDO::PARAM_INT);
		
		}
		else
		{

			$stmt->bindParam(':conselho', $this->conselho, PDO::PARAM_INT);
			$stmt->bindParam(':periodo', $this->periodo);
			$stmt->bindParam(':turma', $this->turma);
			
		}
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
	public function findAll($ativo = 'N', $periodo = 'N'){
	
		$sql = "SELECT * FROM $this->table WHERE cc_conselho = :conselho ";
		if($ativo == 'S')
		{
			
			$sql .= "and cc_ativo = 'S' ";
			
		}
		if($periodo == 'S')
		{
			
			$sql .= "and cc_periodo = :periodo ";
			
		}
		$sql .= "ORDER BY cc_periodo, cc_ativo";
		
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':conselho', $this->conselho, PDO::PARAM_INT);
		if($periodo == 'S')
		{
			
			$stmt->bindParam(':periodo', $this->periodo);
			
		}
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
