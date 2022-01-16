<?php

require_once 'DB.php';

class DocumentosPlanoCursos{
	
	protected $table = 'documentos_plano_cursos';
	private $caminho;
	private $curso;
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

	public function setCurso($curso){
		if(mb_strlen($curso) <= 200){
			
			$this->curso = $curso;
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
         
        $sql  = "INSERT INTO $this->table (dpc_curso, dpc_caminho, dpc_ano) VALUES (:curso, :caminho, :ano)";
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':curso', $this->curso);
		$stmt->bindParam(':caminho', $this->caminho);
		$stmt->bindParam(':ano', $this->ano, PDO::PARAM_INT);
		return $stmt->execute(); 

	}
		
		//Edita um documento existente
	public function update($id){

		$sql  = "UPDATE $this->table SET dpc_curso = :curso, dpc_caminho = :caminho WHERE dpc_id = :id";
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':curso', $this->curso);
		$stmt->bindParam(':caminho', $this->caminho);
		$stmt->bindParam(':id', $id, PDO::PARAM_INT);
		return $stmt->execute();

	}

		//Desativa/Ativa um determinado documento
    public function delete($id){

		$sql  = "UPDATE $this->table SET dpc_ativo = :ativo WHERE dpc_id = :id";
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':ativo', $this->ativo);
		$stmt->bindParam(':id', $id, PDO::PARAM_INT);
		return $stmt->execute();

	}

		//Busca um determinado documento
	public function find($id, $curso, $ano){
		$sql  = "SELECT * FROM $this->table ";
			//verifica se a pesquisa será realizada via id ou curso
		if($id == ''){
			
			$sql .= "WHERE dpc_curso = :curso ";
			
		}
		else{
			
			$sql .= "WHERE dpc_id = :id ";
		
		}
		$sql .= "AND dpc_ano = :ano";
		$stmt = DB::prepare($sql);
		if($id == ''){
			
			$stmt->bindParam(':curso', $curso);
			
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
		$sql .= "WHERE dpc_ano = :ano ";
		if($ativo == 'S'){
			
			$sql .= " AND dpc_ativo = 'S' ";
			
		}
		$sql .= "ORDER BY dpc_ativo, dpc_curso";
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
