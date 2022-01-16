<?php

require_once 'DB.php';

class Vestibulinho{
	
	protected $table = 'vestibular';
	private $nome;
	private $ano;
	private $semestre;
	private $periodo_inscricao;
	private $preco_inscricao;
	private $data_exame;
	private $hora_exame;

	public function setNome($nome){
		if(mb_strlen($nome) <= 100){
			
			$this->nome = $nome;
			return true;
		}
		else{
			return false;
		}
	}

    public function setAno($ano){
		$this->ano = $ano;
	}

	public function setSemestre($semestre){
		if(($semestre == '1º Semestre')or($semestre == '2º Semestre')){
			
			$this->semestre = $semestre;
			return true;
		}
		else{
			return false;
		}
	}
	
	public function setPeriodoInscricao($periodo_inscricao){
		if(mb_strlen($periodo_inscricao) <= 100){
			
			$this->periodo_inscricao = $periodo_inscricao;
			return true;
		}
		else{
			return false;
		}
	}

	public function setPrecoInscricao($preco_inscricao){
		if(mb_strlen($preco_inscricao) <= 100){
			
			$this->preco_inscricao = $preco_inscricao;
			return true;
		}
		else{
			return false;
		}
	}

	public function setDataExame($data_exame){
		$this->data_exame = $data_exame;
	}

	public function setHoraExame($hora_exame){
		$this->hora_exame = $hora_exame;
	}

		//Cadastro de um novo vestibulinho
	public function insert(){
         
        $sql  = "INSERT INTO $this->table (v_nome, v_ano, v_semestre, v_periodo_inscricao, ";
        $sql .= "v_preco_inscricao, v_data_exame, v_hora_exame) ";
        $sql .= "VALUES (:nome, :ano, :semestre, :periodo_inscricao, :preco_inscricao, ";
        $sql .= ":data_exame, :hora_exame)";
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':nome', $this->nome);
		$stmt->bindParam(':ano', $this->ano);
		$stmt->bindParam(':semestre', $this->semestre);
		$stmt->bindParam(':periodo_inscricao', $this->periodo_inscricao);
		$stmt->bindParam(':preco_inscricao', $this->preco_inscricao);
		$stmt->bindParam(':data_exame', $this->data_exame);
		$stmt->bindParam(':hora_exame', $this->hora_exame);
		return $stmt->execute(); 

	}
		
		//Edita uma data existente
	public function update($id){

		$sql  = "UPDATE $this->table SET v_periodo_inscricao = :periodo_inscricao, v_preco_inscricao = :preco_inscricao, ";
		$sql .= "v_data_exame = :data_exame, v_hora_exame = :hora_exame WHERE v_id = :id";
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':periodo_inscricao', $this->periodo_inscricao);
		$stmt->bindParam(':preco_inscricao', $this->preco_inscricao);
		$stmt->bindParam(':data_exame', $this->data_exame);
		$stmt->bindParam(':hora_exame', $this->hora_exame);
		$stmt->bindParam(':id', $id, PDO::PARAM_INT);
		return $stmt->execute();

	}

		//Busca o ultimo vestibulinho 
	public function findLast(){
		$sql  = "SELECT * FROM $this->table WHERE v_id = (SELECT MAX(v_id) FROM $this->table)";
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
	public function findAll(){
		$sql  = "SELECT * FROM $this->table ";
		$sql .= "ORDER BY v_ano DESC, v_semestre DESC";
		$stmt = DB::prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll();
	}

}
