<?php

require_once 'DB.php';

class ProcessoSeletivoVestibulinho{
	
	protected $table = 'vestibular_processo_seletivo_topicos';
	private $descricao;
	private $data_inicial;
	private $data_final;
	private $vestibulinho;
	private $ativo;

	public function setDescricao($descricao){
		if(mb_strlen($descricao) <= 200){
			
			$this->descricao = $descricao;
			return true;
		}
		else{
			return false;
		}
	}

    public function setDataInicial($data_inicial){
		$this->data_inicial = $data_inicial;
	}

	public function setDataFinal($data_final){
		$this->data_final = $data_final;
	}

	public function setVestibulinho($vestibulinho){
		$this->vestibulinho = $vestibulinho;
	}

	public function setAtivo($ativo){
		if(($ativo == 'S')or($ativo == 'N')){
			$this->ativo = $ativo;
		}
	}
	
		//Cadastro de um novo topico do processo seletivo
	public function insert(){
         
        $sql  = "INSERT INTO $this->table (vt_descricao, vt_data_inicial, vt_data_final, vt_vestibular) VALUES (:descricao, :data_inicial, :data_final, :vestibulinho)";
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':descricao', $this->descricao);
		$stmt->bindParam(':data_inicial', $this->data_inicial);
		$stmt->bindParam(':data_final', $this->data_final);
		$stmt->bindParam(':vestibulinho', $this->vestibulinho);
		return $stmt->execute(); 

	}
		
		//Edita um topico do processo seletivo
	public function update($id){

		$sql  = "UPDATE $this->table SET vt_descricao = :descricao, vt_data_inicial = :data_inicial, vt_data_final = :data_final ";
		$sql .= "WHERE vt_id = :id";
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':descricao', $this->descricao);
		$stmt->bindParam(':data_inicial', $this->data_inicial);
		$stmt->bindParam(':data_final', $this->data_final);
		$stmt->bindParam(':id', $id, PDO::PARAM_INT);
		return $stmt->execute();

	}
		
		//Desativa/Ativa um topico do processo seletivo
    public function delete($id){

		$sql  = "UPDATE $this->table SET vt_ativo = :ativo WHERE vt_id = :id";
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':ativo', $this->ativo);
		$stmt->bindParam(':id', $id, PDO::PARAM_INT);
		return $stmt->execute();

	}

		//Busca um topico do processo seletivo
	public function find($id){
		$sql  = "SELECT * FROM $this->table WHERE vt_id = :id";
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
	public function findAll($vestibulinho, $ativo){
		$sql  = "SELECT * FROM $this->table WHERE vt_vestibular = :vestibulinho ";
		//Se ativo estiver marcado como 'S', buscará apenas os registros ativos
		if($ativo == 'S'){
		
			$sql .= "AND vt_ativo = 'S' ";
			
		}
		$sql .= "ORDER BY vt_ativo, vt_data_inicial ";
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':vestibulinho', $vestibulinho, PDO::PARAM_INT);
		$stmt->execute();
			//verifica se há registros, se não retorna false
		$count = $stmt->rowCount();

		if($count > 0){
			return $stmt->fetchAll();
		}
		else{
			return false;
		}
	}

}
