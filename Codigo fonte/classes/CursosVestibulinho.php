<?php

require_once 'DB.php';

class CursosVestibulinho{
	
	protected $table = 'vestibular_cursos';
	private $nome;
	private $periodo;
	private $quantidade_vagas;

	public function setNome($nome){
		if(mb_strlen($nome) <= 200){
			
			$this->nome = $nome;
			return true;
		}
		else{
			return false;
		}
		
	}

    public function setPeriodo($periodo){
    
    	if(($periodo == 'Matutino')or($periodo == 'Diurno')or($periodo == 'Noturno')){

    		$this->periodo = $periodo;
    		return true;
		
		}
		else{
			return false;
		}
	
	}

	public function setQuantidadeVagas($quantidade_vagas){

		if($quantidade_vagas > 0){
			
			$this->quantidade_vagas = $quantidade_vagas;
			return true;
		}
		else{
			return false;
		}
	
	}
	
		//Cadastra um novo curso
	public function insert(){
         
        $sql  = "INSERT INTO $this->table (vc_nome, vc_periodo, vc_qtd_vagas) ";
        $sql .= "VALUES (:nome, :periodo, :quantidade_vagas)";
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':nome', $this->nome);
		$stmt->bindParam(':periodo', $this->periodo);
		$stmt->bindParam(':quantidade_vagas', $this->quantidade_vagas);
		return $stmt->execute(); 

	}
		
		//Edita um curso existente
	public function update($id){

		$sql  = "UPDATE $this->table SET vc_nome = :nome, vc_periodo = :periodo, vc_qtd_vagas = :quantidade_vagas WHERE vc_id = :id";
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':nome', $this->nome);
		$stmt->bindParam(':periodo', $this->periodo);
		$stmt->bindParam(':quantidade_vagas', $this->quantidade_vagas);
		$stmt->bindParam(':id', $id, PDO::PARAM_INT);
		return $stmt->execute();

	}

		//Busca uma determinado curso
	public function find($id){
		$sql  = "SELECT * FROM $this->table WHERE vc_id = :id";
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
	public function findAll($id_vestibulinho,$periodo){
		$sql  = "SELECT * FROM $this->table ";
		if($id_vestibulinho != ''){
			
			$sql .= "WHERE vc_id in (SELECT vv_vestibular_curso FROM ligacao_vestibular_e_vestibular_curso WHERE vv_vestibular = :vestibulinho GROUP BY vv_vestibular_curso) AND  ";
			$sql .= "vc_periodo = :periodo ";
			
		}
		$sql .= "ORDER BY vc_periodo, vc_nome";
		$stmt = DB::prepare($sql);
		if($id_vestibulinho != ''){
		
			$stmt->bindParam(':vestibulinho', $id_vestibulinho, PDO::PARAM_INT);
			$stmt->bindParam(':periodo', $periodo);
		
		}
		$stmt->execute();
		
			//verifica se há registros, se não retorna false
		$count = $stmt->rowCount();

		if($count > 0){
			return $stmt->fetchAll();
		}
		else{
			return false;
		}
		return $stmt->fetchAll();
	}

}
