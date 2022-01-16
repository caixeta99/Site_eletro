<?php

require_once 'DB.php';

class Avisos{
	
	protected $table = 'avisos';
	private $destinatario;
	private $descricao;
	private $destaque;
	private $ativo;

	public function setDestinatario($destinatario){
		if(($destinatario == 'alunos')or($destinatario == 'ex-alunos')or($destinatario == 'secretaria')or($destinatario == 'coordenacao')){
			
			$this->destinatario = $destinatario;
			return true;
			
		}
		else{
			return false;
		}
	}
	
	public function setDescricao($descricao){
		if(mb_strlen($descricao) <= 250){
			
			$this->descricao = $descricao;
			return true;
			
		}
		else{
			return false;
		}
	}

    public function setData($data){
		$this->data = $data;
	}

	public function setDestaque($destaque){
		
		if(($destaque == 'S')or($destaque == 'N')){
			
			$this->destaque = $destaque;
			
		}
		
	}
	
	public function setAtivo($ativo){
		
		if(($ativo == 'S')or($ativo == 'N')){
			
			$this->ativo = $ativo;
		
		}
	
	}
	
		//Cadastra um novo aviso
	public function insert(){
         
        $sql  = "INSERT INTO $this->table (av_destinatario, av_descricao, av_destaque) VALUES (:destinatario, :descricao, :destaque)";
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':destinatario', $this->destinatario);
		$stmt->bindParam(':descricao', $this->descricao);
		$stmt->bindParam(':destaque', $this->destaque);
		return $stmt->execute(); 

	}
		
		//Edita um determinado aviso
	public function update($id){

		$sql  = "UPDATE $this->table SET av_descricao = :descricao, av_destinatario = :destinatario, av_destaque = :destaque WHERE av_id = :id";
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':descricao', $this->descricao);
		$stmt->bindParam(':destinatario', $this->destinatario);
		$stmt->bindParam(':destaque', $this->destaque);
		$stmt->bindParam(':id', $id, PDO::PARAM_INT);
		return $stmt->execute();

	}
		
		//Desativa/Ativa um determinado aviso
    public function delete($id){

		$sql  = "UPDATE $this->table SET av_ativo = :ativo WHERE av_id = :id";
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':ativo', $this->ativo);
		$stmt->bindParam(':id', $id, PDO::PARAM_INT);
		return $stmt->execute();

	}
	
		//Prioriza um determinado aviso
    public function priorizar($id){

		$sql  = "UPDATE $this->table SET av_destaque = :destaque WHERE av_id = :id";
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':destaque', $this->destaque);
		$stmt->bindParam(':id', $id, PDO::PARAM_INT);
		return $stmt->execute();

	}
	
		//busca um aviso aleatorio para priorizar caso necessario
	public function findRandom(){
		$sql  = "SELECT * FROM $this->table ";
		$sql .= "WHERE av_destaque = 'N' AND ";
		$sql .= "av_ativo = 'S' AND ";
		$sql .= "av_destinatario = :destinatario ";
		$sql .= "ORDER BY RAND() LIMIT 1";
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':destinatario', $this->destinatario);
		$stmt->execute();
		$count = $stmt->rowCount();
			
			//verifica se o registro foi encontrado, se não retorna false
		if($count > 0){
			return $stmt->fetch();
		}
		else{
			return false;
		}
	}

		//Busca um determinado aviso
	public function find($id){
		$sql  = "SELECT * FROM $this->table WHERE av_id = :id";
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
	public function findAll($ativo, $destaque){
		$sql  = "SELECT * FROM $this->table ";
		//Se ativo estiver marcado como 'S', buscará apenas os registros ativos de um determinado periodo
		if($ativo == 'S'){
		
			$sql .= "WHERE av_ativo = 'S' AND ";
			$sql .= "av_destinatario = :destinatario ";
			
		}
		if($destaque == 'S'){
			
			$sql .= "AND av_destaque = 'S' ";
			
		}
		$sql .= "ORDER BY av_ativo, av_destinatario, av_destaque ";
		$stmt = DB::prepare($sql);
		if($ativo == 'S'){
			
			$stmt->bindParam(':destinatario', $this->destinatario);
		
		}
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
	
		//busca a quantidade de imagens dentro do album
	public function CountAvisos(){
		$sql  = "SELECT COUNT(*) as Quantidade FROM $this->table ";
		$sql .= "WHERE av_destinatario = :destinatario ";
		$sql .= "AND av_destaque = 'S' ";
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':destinatario', $this->destinatario);
		$stmt->execute();
		return $stmt->fetch();
	}

}
