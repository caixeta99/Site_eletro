<?php

require_once 'DB.php';

class Gremio{
	
	protected $table = 'gremio_estudantil';
	private $ano;
	private $nome;
	private $album;
	private $imagens;
	private $facebook;
	private $instagram;

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

	public function setAlbum($album){
		$this->album = $album;
	}
	
	public function setImagens($imagens){
		if(($imagens == 'S')or($imagens == 'N')){
			
			$this->imagens = $imagens;
			return true;
			
		}
		else{
		
			return false;
			
		}
	}
	
	public function setFacebook($facebook){
		if(mb_strlen($facebook) <= 100){
			
			$this->facebook = $facebook;
			return true;
			
		}
		else{
		
			return false;
			
		}
	}
	
	public function setInstagram($instagram){
		if(mb_strlen($instagram) <= 100){
			
			$this->instagram = $instagram;
			return true;
			
		}
		else{
		
			return false;
			
		}
	}

	public function insert(){
         
        $sql  = "INSERT INTO $this->table (g_ano, g_album) VALUES (:ano, :album)";
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':ano', $this->ano);
		$stmt->bindParam(':album', $this->album);
		return $stmt->execute(); 

	}

	public function update($id){

		$sql  = "UPDATE $this->table SET g_nome = :nome, g_imagens = :imagens, g_facebook = :facebook, g_instagram = :instagram WHERE g_id = :id";
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':nome', $this->nome);
		$stmt->bindParam(':imagens', $this->imagens);
		$stmt->bindParam(':facebook', $this->facebook);
		$stmt->bindParam(':instagram', $this->instagram);
		$stmt->bindParam(':id', $id, PDO::PARAM_INT);
		return $stmt->execute();

	}

		//Busca as informações do ultimo gremio estudantil
	public function findLast(){
		$sql  = "SELECT * FROM $this->table WHERE g_ano = (select max(g_ano) from gremio_estudantil)";
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

	public function find($ano){
		$sql  = "SELECT * FROM $this->table WHERE g_ano = :ano";
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':ano', $ano, PDO::PARAM_INT);
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
	
	public function findId($id){
		$sql  = "SELECT * FROM $this->table WHERE g_id = :id";
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

	public function findAll(){
		$sql  = "SELECT * FROM $this->table ORDER BY g_ano desc";
		$stmt = DB::prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll();
	}

}
