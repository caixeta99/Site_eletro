<?php

require_once 'DB.php';

class Cursos{
	
	protected $table = 'cursos';
	private $titulo;
	private $sinopse;
	private $descricao;
	private $duracao;
	private $periodo;
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

	public function setDuracao($duracao){
		if(mb_strlen($duracao) <= 50){
			$this->duracao = $duracao;
			return true;
		
		}
		else{
		
			return false;
			
		}
	}
	
	public function setPeriodo($periodo){
		if(($periodo == 'Diurno')or($periodo == 'Noturno')){
			$this->periodo = $periodo;
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

		//Cadastra um novo curso
	public function insert(){
         
        $sql  = "INSERT INTO $this->table (c_titulo, c_sinopse, c_descricao, c_duracao, c_periodo, c_album) ";
		$sql .= "VALUES (:titulo, :sinopse, :descricao, :duracao, :periodo, :album)";
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':titulo', $this->titulo);
		$stmt->bindParam(':sinopse', $this->sinopse);
		$stmt->bindParam(':descricao', $this->descricao);
		$stmt->bindParam(':duracao', $this->duracao);
		$stmt->bindParam(':periodo', $this->periodo);
		$stmt->bindParam(':album', $this->album);
		return $stmt->execute(); 

	}
		
		//Edita um curso existente
	public function update($id){

		$sql  = "UPDATE $this->table ";
		$sql .= "SET c_sinopse = :sinopse, c_descricao = :descricao";
			//Se o id for passado ele mudara todas as informacoes do curso selecionado, porem caso nao for passado ele mudará as informacoes do ensino medio
		if($id != ''){
			
			$sql .= ",c_titulo = :titulo, c_duracao = :duracao, c_periodo = :periodo ";
			$sql .= "WHERE c_id = :id";
		
		}
		else{
			
			$sql .= " WHERE c_periodo = 'Matutino' ";
		
		}
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':sinopse', $this->sinopse);
		$stmt->bindParam(':descricao', $this->descricao);
		if($id != ''){
			
			$stmt->bindParam(':titulo', $this->titulo);
			$stmt->bindParam(':duracao', $this->duracao);
			$stmt->bindParam(':periodo', $this->periodo);
			$stmt->bindParam(':id', $id, PDO::PARAM_INT);
			
		}
		return $stmt->execute();

	}
	
		//Desativa ou Ativa um determinado curso
    public function delete($id){

		$sql  = "UPDATE $this->table SET c_ativo = :ativo WHERE c_id = :id";
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':ativo', $this->ativo);
		$stmt->bindParam(':id', $id, PDO::PARAM_INT);
		return $stmt->execute();

	}

		//Busca um determinado curso
	public function find($id){
		$sql  = "SELECT * FROM $this->table WHERE c_id = :id";
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
		
		//Busca todos os cursos
	public function findAll($ativo, $periodo){
		$sql  = "SELECT * FROM $this->table ";
		if($ativo == 'S'){
		
			$sql .= "WHERE c_ativo = 'S' ";
			
			if($periodo != ''){
			
				$sql .= " AND c_periodo = :periodo ";
			
			}
			
		}
		$sql .= "ORDER BY c_ativo, c_periodo, c_titulo";
		$stmt = DB::prepare($sql);
		if(($ativo == 'S')and($periodo != '')){
		
			$stmt->bindParam(':periodo', $periodo);
		
		}
		$stmt->execute();
		return $stmt->fetchAll();
	}

}
