<?php

require_once 'DB.php';

class DocumentosPlanoTrabalho{
	
	protected $table = 'documentos_plano_trabalho';
	private $ciclo;
	private $caminho;
	private $curso;
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

	public function setCiclo($ciclo){
		if(($ciclo == 'Completo')or($ciclo == '1 Semestre')or($ciclo == '2 Semestre')){
			
			$this->ciclo = $ciclo;
			return true;
		}
		else{
			return false;
		}
	}

    public function setCurso($curso){
		$this->curso = $curso;
	}

	public function setAno($ano){
		$this->ano = $ano;
	}
	
		//Cadastra um novo plano de trabalho
	public function insert(){
         
        $sql  = "INSERT INTO $this->table (dpt_ciclo, dpt_cursos, dpt_ano) VALUES (:ciclo, :curso, :ano)";
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':ciclo', $this->ciclo);
		$stmt->bindParam(':curso', $this->curso, PDO::PARAM_INT);
		$stmt->bindParam(':ano', $this->ano, PDO::PARAM_INT);
		return $stmt->execute(); 

	}
		
		//Edita um plano de trabalho existente
	public function update($id){

		$sql  = "UPDATE $this->table SET dpt_caminho = :caminho WHERE dpt_id = :id";
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':caminho', $this->caminho);
		$stmt->bindParam(':id', $id, PDO::PARAM_INT);
		return $stmt->execute();

	}

		//Desativa todos os documento do ultimo ano 
	public function deleteAll($ano){

		$sql  = "UPDATE $this->table SET dpt_ativo = 'N' WHERE dpt_ano = :ano";
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':ano', $ano, PDO::PARAM_INT);
		return $stmt->execute();

	}
	
		//reativa um documento do ultimo ano 
	public function delete($ano, $curso, $ativo){

		$sql  = "UPDATE $this->table ";
		if($ativo == 'S'){
			
			$sql .= "SET dpt_ativo = 'S' ";
			
		}
		else{
		
			$sql .= "SET dpt_ativo = 'N' ";
			
		}
		$sql .= "WHERE dpt_ano = :ano and dpt_cursos = :curso";
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':ano', $ano, PDO::PARAM_INT);
		$stmt->bindParam(':curso', $curso, PDO::PARAM_INT);
		return $stmt->execute();

	}

		//Busca um plano de trabalho
	public function find($id){
		$sql  = "SELECT * FROM $this->table WHERE dpt_id = :id";
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
	public function findAll($ano, $curso, $ativo){
		$sql  = "SELECT * FROM $this->table ";
		$sql .= "WHERE dpt_ano = :ano and dpt_cursos = :curso ";
		if($ativo == 'S'){
		
			$sql .= "and dpt_ativo = 'S' ";
			
		}
		$sql .= "ORDER BY dpt_ciclo";
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':ano', $ano, PDO::PARAM_INT);
		$stmt->bindParam(':curso', $curso, PDO::PARAM_INT);	
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
	
		//Busca todos os registros
	public function findAllCiclo($ano, $ciclo, $ativo){
		$sql  = "SELECT c.*,d.* FROM $this->table d,cursos c ";
		$sql .= "WHERE d.dpt_cursos = c.c_id AND d.dpt_ano = :ano AND d.dpt_ciclo = :ciclo ";
		if($ativo == 'S'){
		
			$sql .= "and d.dpt_ativo = 'S' ";
			
		}
		$sql .= "ORDER BY c.c_periodo, c.c_titulo";
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':ano', $ano, PDO::PARAM_INT);
		$stmt->bindParam(':ciclo', $ciclo);	
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
