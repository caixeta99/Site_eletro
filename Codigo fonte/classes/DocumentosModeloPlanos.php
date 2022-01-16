<?php

require_once 'DB.php';

class DocumentosModeloPlanos{
	
	protected $table = 'documentos_modelo_planos';
	private $caminho;
	private $documento;
	private $ano;
	private $ativo;

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
		if(mb_strlen($documento) <= 200){
			
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
	
	public function setAtivo($ativo){
		if(($ativo == 'S')or($ativo == 'N')){
			$this->ativo = $ativo;
		}
	}
	
		//Cadastra um documento
	public function insert(){
         
        $sql  = "INSERT INTO $this->table (dmp_documento, dmp_caminho, dmp_ano) VALUES (:documento, :caminho, :ano)";
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':documento', $this->documento);
		$stmt->bindParam(':caminho', $this->caminho);
		$stmt->bindParam(':ano', $this->ano, PDO::PARAM_INT);
		return $stmt->execute(); 

	}
		
		//Edita um documento existente
	public function update($id){

		$sql  = "UPDATE $this->table SET dmp_caminho = :caminho, dmp_documento = :documento WHERE dmp_id = :id";
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':caminho', $this->caminho);
		$stmt->bindParam(':documento', $this->documento);
		$stmt->bindParam(':id', $id, PDO::PARAM_INT);
		return $stmt->execute();

	}

		//Desativa/Ativa um determinado documento
    public function delete($id){

		$sql  = "UPDATE $this->table SET dmp_ativo = :ativo WHERE dmp_id = :id";
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':ativo', $this->ativo);
		$stmt->bindParam(':id', $id, PDO::PARAM_INT);
		return $stmt->execute();

	}

		//Busca um determinado documento
	public function find($id, $documento, $ano){
		$sql  = "SELECT * FROM $this->table ";
			//verifica se a pesquisa será realizada via id ou curso
		if($id == ''){
			
			$sql .= "WHERE dmp_documento = :documento ";
			
		}
		else{
			
			$sql .= "WHERE dmp_id = :id ";
		
		}
		$sql .= "AND dmp_ano = :ano";
		$stmt = DB::prepare($sql);
		if($id == ''){
			
			$stmt->bindParam(':documento', $documento);
			
		}
		else{
			
			$stmt->bindParam(':id', $id, PDO::PARAM_INT);
		
		}
		$stmt->bindParam(':ano', $ano, PDO::PARAM_INT);
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
	public function findAll($ano, $ativo){
		$sql  = "SELECT * FROM $this->table ";
		$sql .= "WHERE dmp_ano = :ano ";
		if($ativo == 'S'){
			
			$sql .= " AND dmp_ativo = 'S' ";
			
		}
		$sql .= "ORDER BY dmp_ativo, dmp_documento";
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':ano', $ano, PDO::PARAM_INT);	
		$stmt->execute();
			//verifica se há registros
		$count = $stmt->rowCount();

		if($count > 0){
			return $stmt->fetchAll();
		}
		else{
			return false;
		}
	}

}
