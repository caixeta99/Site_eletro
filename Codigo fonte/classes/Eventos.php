<?php

require_once 'DB.php';

class Eventos{
	
	protected $table = 'eventos';
	private $titulo;
	private $sinopse;
	private $descricao;
	private $album;
	private $ativo;

	public function setTitulo($titulo){
		if(mb_strlen($titulo) <= 50){
			
			$this->titulo = $titulo;
			return true;
		
		}
		else{
		
			return false;
			
		}
	}
	
	public function setSinopse($sinopse){
		if(mb_strlen($sinopse) <= 500){
			
			$this->sinopse = $sinopse;
			return true;
		
		}
		else{
		
			return false;
			
		}
	}
	
	public function setDescricao($descricao){
		if(mb_strlen($descricao) <= 1000){
			$this->descricao = $descricao;
			return true;
		
		}
		else{
		
			return false;
			
		}
	}

	
	public function setAtivo($ativo){
		if(($ativo == 'S')or($ativo == 'N')){
			$this->ativo = $ativo;
		}
	}
	
	public function setAlbum($album){
		
		$this->album = $album;

	}

		//Cadastra um novo evento
	public function insert(){
         
        $sql  = "INSERT INTO $this->table (e_titulo, e_sinopse, e_descricao, e_album) ";
		$sql .= "VALUES (:titulo, :sinopse, :descricao, :album)";
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':titulo', $this->titulo);
		$stmt->bindParam(':sinopse', $this->sinopse);
		$stmt->bindParam(':descricao', $this->descricao);
		$stmt->bindParam(':album', $this->album);
		return $stmt->execute(); 

	}
		
		//Edita um evento existente
	public function update($id){

		$sql  = "UPDATE $this->table ";
		$sql .= "SET e_titulo = :titulo, e_sinopse = :sinopse, e_descricao = :descricao ";
		$sql .= "WHERE e_id = :id";
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':titulo', $this->titulo);
		$stmt->bindParam(':sinopse', $this->sinopse);
		$stmt->bindParam(':descricao', $this->descricao);
		$stmt->bindParam(':id', $id, PDO::PARAM_INT);
		return $stmt->execute();

	}
	
		//Desativa ou Ativa um determinado evento
    public function delete($id){

		$sql  = "UPDATE $this->table SET e_ativo = :ativo WHERE e_id = :id";
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':ativo', $this->ativo);
		$stmt->bindParam(':id', $id, PDO::PARAM_INT);
		return $stmt->execute();

	}


		//Busca um determinado evento
	public function findLast(){
		$sql  = "SELECT MAX(e_id) AS id FROM $this->table";
		$stmt = DB::prepare($sql);
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

		//Busca um determinado evento
	public function find($id){
		$sql  = "SELECT * FROM $this->table WHERE e_id = :id";
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
		
		//Busca todos os eventos
	public function findAll($ativo, $limite){
		$sql  = "SELECT e.*,de.data FROM $this->table e, ";
		$sql .= "(SELECT de_evento,min(de_data) as data FROM data_evento WHERE de_ativo = 'S' GROUP BY de_evento) de ";
		$sql .= "WHERE e.e_id = de.de_evento ";
		if($ativo == 'S'){
		
			$sql .= "AND e.e_ativo = 'S' ";
			
		}
		$sql .= "ORDER BY e.e_ativo ASC, de.data DESC ";
		if($limite == 'S'){
			
			$sql .= "LIMIT 4";
			
		}
		$stmt = DB::prepare($sql);
		$stmt->execute();
			//verifica se há registro
		$count = $stmt->rowCount();

		if($count > 0){
			return $stmt->fetchAll();
		}
		else{
			return false;
		}
	}

}
