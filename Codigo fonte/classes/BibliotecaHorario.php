<?php

require_once 'DB.php';

class BibliotecaHorario{
	
	protected $table = 'biblioteca_horario';
	private $dia;
	private $periodo;
	private $funcionario;
	private $inicio;
	private $fim;

	public function setDia($dia){
		if(($dia == 'Segunda')or($dia == 'Terça')or($dia == 'Quarta')or($dia == 'Quinta')or($dia == 'Sexta')){
			
			$this->dia = $dia;
			return true;

		}
		else{
			return false;
		}
	}

	public function setPeriodo($periodo){
		if(($periodo == 'Manhã')or($periodo == 'Tarde')or($periodo == 'Noite')){
			
			$this->periodo = $periodo;
			return true;

		}
		else{
			return false;
		}
	}

	public function setFuncionario($funcionario){

		$this->funcionario = $funcionario;
		
	}

	public function setInicio($inicio){

		$this->inicio = $inicio;
		
	}

	public function setFim($fim){

		$this->fim = $fim;
		
	}
	
		//Cadastra um novo horario
	public function insert(){
         
        $sql  = "INSERT INTO $this->table (bh_dia, bh_periodo, bh_funcionario) ";
        $sql .= "VALUES (:dia, :periodo, :funcionario)";
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':dia', $this->dia);
		$stmt->bindParam(':periodo', $this->periodo);
		$stmt->bindParam(':funcionario', $this->funcionario);
		return $stmt->execute(); 

	}
		
		//Edita um horario existente
	public function update($id){

		$sql  = "UPDATE $this->table ";
		$sql .= "SET bh_horario_i = :inicio, bh_horario_f = :fim ";
		$sql .= "WHERE bh_id = :id";
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':inicio', $this->inicio);
		$stmt->bindParam(':fim', $this->fim);
		$stmt->bindParam(':id', $id, PDO::PARAM_INT);
		return $stmt->execute();

	}

		//Busca um determinad horario
	public function find($id){
		$sql  = "SELECT * FROM $this->table WHERE bh_id = :id";
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
	public function findAll($funcionario, $periodo){
		$sql  = "SELECT * FROM $this->table ";
		$sql .= "WHERE bh_funcionario = :funcionario AND ";
		$sql .= "bh_periodo = :periodo ";
		$sql .= "ORDER BY bh_dia";
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':funcionario', $funcionario, PDO::PARAM_INT);
		$stmt->bindParam(':periodo', $periodo);
		$stmt->execute();
		return $stmt->fetchAll();
	}
	
		//Busca todos os registros de um determinado dia
	public function findAllDia($funcionario, $dia){
		$sql  = "SELECT * FROM $this->table ";
		$sql .= "WHERE bh_funcionario = :funcionario AND ";
		$sql .= "bh_dia = :dia ";
		$sql .= "ORDER BY bh_periodo";
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':funcionario', $funcionario, PDO::PARAM_INT);
		$stmt->bindParam(':dia', $dia);
		$stmt->execute();
		return $stmt->fetchAll();
	}

}
