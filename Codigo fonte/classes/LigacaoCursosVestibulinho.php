<?php

require_once 'DB.php';

class LigacaoCursosVestibulinho{
	
	protected $table = 'ligacao_vestibular_e_vestibular_curso';
	private $id_vestibulinho;
	private $id_curso;

	public function setVestibulinho($id_vestibulinho){

		$this->id_vestibulinho = $id_vestibulinho;

	}

    public function setCurso($id_curso){
		
		$this->id_curso = $id_curso;
	
	}
	
		//Cadastra uma nova ligacao
	public function insert(){
         
        $sql  = "INSERT INTO $this->table (vv_vestibular_curso, vv_vestibular) ";
        $sql .= "VALUES (:id_curso, :id_vestibulinho)";
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':id_curso', $this->id_curso);
		$stmt->bindParam(':id_vestibulinho', $this->id_vestibulinho);
		return $stmt->execute(); 

	}
		
		//Deleta todas as ligacoes de um determinado vestibulinho
    public function delete($id_vestibulinho){

		$sql  = "DELETE FROM $this->table WHERE vv_vestibular = :id_vestibulinho ";
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':id_vestibulinho', $id_vestibulinho, PDO::PARAM_INT);
		return $stmt->execute();

	}

		//Busca uma determinada ligacao
	public function find($id_curso, $id_vestibulinho){
		$sql  = "SELECT * FROM $this->table WHERE vv_vestibular_curso = :id_curso and vv_vestibular = :id_vestibulinho";
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':id_curso', $id_curso, PDO::PARAM_INT);
		$stmt->bindParam(':id_vestibulinho', $id_vestibulinho, PDO::PARAM_INT);
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

}
