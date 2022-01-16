<?php

require_once 'DB.php';

class Imagem{
	
	protected $table = 'imagens';
	private $titulo;
	private $alt;
	private $caminho;
	private $principal;
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
	
	public function setAlt($alt){
		if(mb_strlen($alt) <= 100){
			
			$this->alt = $alt;
			return true;
		
		}
		else{
		
			return false;
			
		}
	}
	
	public function setCaminho($caminho){
		if(mb_strlen($caminho) <= 500){
			
			$this->caminho = $caminho;
		
		}
	}
	
	public function setAlbum($album){
		
		$this->album = $album;

	}
	
	public function setPrincipal($principal){
		if(($principal == 'S')or($principal == 'N')){
			
			$this->principal = $principal;
		
		}
	}

	public function setAtivo($ativo){
		if(($ativo == 'S')or($ativo == 'N')){
			
			$this->ativo = $ativo;
		
		}
	}
	
		//cadastra uma imagem
	public function insert(){
         
        $sql  = "INSERT INTO $this->table (i_titulo, i_alt, i_caminho, i_principal, i_album) VALUES (:titulo, :alt, :caminho, :principal, :album)";
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':titulo', $this->titulo);
		$stmt->bindParam(':alt', $this->alt);
		$stmt->bindParam(':caminho', $this->caminho);
		$stmt->bindParam(':principal', $this->principal);
		$stmt->bindParam(':album', $this->album);
		return $stmt->execute(); 

	}

		//edita uma imagem
	public function update($id){

		$sql  = "UPDATE $this->table SET i_titulo = :titulo, i_alt = :alt WHERE i_id = :id";
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':titulo', $this->titulo);
		$stmt->bindParam(':alt', $this->alt);
		$stmt->bindParam(':id', $id, PDO::PARAM_INT);
		return $stmt->execute();

	}

		//desativa/ativa uma imagem
    public function delete($id){

		$sql  = "UPDATE $this->table SET i_ativo = :ativo WHERE i_id = :id";
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':ativo', $this->ativo);
		$stmt->bindParam(':id', $id, PDO::PARAM_INT);
		return $stmt->execute();

	}
	
		//prioriza/desprioriza uma imagem
    public function priorizar($id){

		$sql  = "UPDATE $this->table SET i_principal = :principal WHERE i_id = :id";
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':principal', $this->principal);
		$stmt->bindParam(':id', $id, PDO::PARAM_INT);
		return $stmt->execute();

	}
	
		//busca uma imagem aleatoria para priorizar caso necessario
	public function findRandom($id_album){
		$sql  = "SELECT * FROM $this->table ";
		$sql .= "WHERE i_principal = 'N' AND ";
		$sql .= "i_ativo = 'S' AND ";
		$sql .= "i_album = :id_album ";
		$sql .= "ORDER BY RAND() LIMIT 1";
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':id_album', $id_album, PDO::PARAM_INT);
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
	
		//busca a imagens principal de um determinado album
	public function findPrincipal($id_album){
		$sql  = "SELECT * FROM $this->table ";
		$sql .= "WHERE i_principal = 'S' AND ";
		$sql .= "i_album = :id_album";
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':id_album', $id_album, PDO::PARAM_INT);
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
	
		//busca o id da ultima imagem cadastrada
	public function findLast(){
		$sql  = "SELECT max(i_id) as id FROM $this->table ";
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
	
	
		//busca os dados de uma determinada imagem dos albuns de eventos e cursos
	public function find($id){
		$sql  = "SELECT * FROM $this->table ";
		$sql .= "WHERE i_id = :id";
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
		
		//busca todas as imagens de um determinado album
	public function findAll($id, $ativo, $principal, $limite){
		$sql  = "SELECT * FROM $this->table ";
		$sql .= "WHERE i_album = :id ";
		if($ativo == 'S'){
		
			$sql .= "AND i_ativo = 'S' ";
			
		}
			//Verifica se irá ser chamada a imagem principal ou n
		if($principal == 'N'){
		
			$sql .= "AND i_principal = 'N' ";
			
		}
		$sql .= "ORDER BY i_ativo, i_principal ";
		if($limite == 'S'){
			
			$sql .= "LIMIT 4";
			
		}
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':id', $id, PDO::PARAM_INT);
		$stmt->execute();
		if($limite == 'S'){
			
			$count = $stmt->rowCount();

			if($count == 4){
				return $stmt->fetchAll();
			}
			else{
				return false;
			}
			
		}
		else{
			
			return $stmt->fetchAll();
		
		}
		
	}
	
		//busca a quantidade de imagens dentro do album
	public function CountImagens($id_album, $ativo){
		$sql  = "SELECT COUNT(*) as Quantidade FROM $this->table ";
		$sql .= "WHERE i_album = :id_album ";
		if($ativo == 'S'){
		
			$sql .= "AND i_ativo = 'S' ";
			
		}
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':id_album', $id_album, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetch();
	}
	
}
