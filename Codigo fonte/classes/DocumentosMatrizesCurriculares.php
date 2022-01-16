<?php

require_once 'DB.php';

class DocumentosMatrizesCurriculares{
	
	protected $table = 'documentos_matrizes_curriculares';
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
	
		//Cadastra uma matriz curricular
	public function insert(){
         
        $sql  = "INSERT INTO $this->table (dmc_ciclo, dmc_curso, dmc_ano) VALUES (:ciclo, :curso, :ano)";
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':ciclo', $this->ciclo);
		$stmt->bindParam(':curso', $this->curso, PDO::PARAM_INT);
		$stmt->bindParam(':ano', $this->ano, PDO::PARAM_INT);
		return $stmt->execute(); 

	}
		
		//Edita uma matriz curricular existente
	public function update($id){

		$sql  = "UPDATE $this->table SET dmc_caminho = :caminho WHERE dmc_id = :id";
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':caminho', $this->caminho);
		$stmt->bindParam(':id', $id, PDO::PARAM_INT);
		return $stmt->execute();

	}
	
		//Desativa todos os documento do ultimo ano 
	public function deleteAll($ano){

		$sql  = "UPDATE $this->table SET dmc_ativo = 'N' WHERE dmc_ano = :ano";
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':ano', $ano, PDO::PARAM_INT);
		return $stmt->execute();

	}
	
		//reativa um documento do ultimo ano 
	public function delete($ano, $curso, $ativo){

		$sql  = "UPDATE $this->table ";
		if($ativo == 'S'){
			
			$sql .= "SET dmc_ativo = 'S' ";
			
		}
		else{
		
			$sql .= "SET dmc_ativo = 'N' ";
			
		}
		$sql .= "WHERE dmc_ano = :ano and dmc_curso = :curso";
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':ano', $ano, PDO::PARAM_INT);
		$stmt->bindParam(':curso', $curso, PDO::PARAM_INT);
		return $stmt->execute();

	}

		//Busca uma matriz curricular
	public function find($id){
		$sql  = "SELECT * FROM $this->table WHERE dmc_id = :id";
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
		$sql .= "WHERE dmc_ano = :ano and dmc_curso = :curso ";
		if($ativo == 'S'){
		
			$sql .= "and dmc_ativo = 'S' ";
			
		}
		$sql .= "ORDER BY dmc_ciclo";
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

}
