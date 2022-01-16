<?php

require_once 'DB.php';

class ProgramasRelacionados{
	
	protected $table = 'programas_relacionados';
	private $nome;
	private $descricao;
	private $link;
	private $album;
	private $ativo;

	public function setNome($nome){
		if(mb_strlen($nome) <= 100){
			
			$this->nome = $nome;
			return true;
		}
		else{
			return false;
		}
	}

	public function setDescricao($descricao){
		if(mb_strlen($descricao) <= 500){
			
			$this->descricao = $descricao;
			return true;
		}
		else{
			return false;
		}
	}

	public function setLink($link){
		if(mb_strlen($link) <= 200){
			
			$this->link = $link;
			return true;
		}
		else{
			return false;
		}
	}

    public function setAlbum($album){
	
		$this->album = $album;
	
	}

	public function setAtivo($ativo){
		if(($ativo == 'S')or($ativo == 'N')){
			$this->ativo = $ativo;
		}
	}
	
		//Cadastra um novo programa relacionado
	public function insert(){
         
        $sql  = "INSERT INTO $this->table (p_nome, p_descricao, p_link, p_album) ";
        $sql .= " VALUES (:nome, :descricao, :link, :album)";
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':nome', $this->nome);
		$stmt->bindParam(':descricao', $this->descricao);
		$stmt->bindParam(':link', $this->link);
		$stmt->bindParam(':album', $this->album, PDO::PARAM_INT);
		return $stmt->execute(); 

	}
		
		//Edita um determinado programa relacionado
	public function update($id){

		$sql  = "UPDATE $this->table ";
		$sql .= "SET p_nome = :nome, p_descricao = :descricao, p_link = :link ";
		$sql .= "WHERE p_id = :id";
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':nome', $this->nome);
		$stmt->bindParam(':descricao', $this->descricao);
		$stmt->bindParam(':link', $this->link);
		$stmt->bindParam(':id', $id, PDO::PARAM_INT);
		return $stmt->execute();

	}
		
		//Desativa/Ativa um determinado programa relacionado
    public function delete($id){

		$sql  = "UPDATE $this->table SET p_ativo = :ativo WHERE p_id = :id";
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':ativo', $this->ativo);
		$stmt->bindParam(':id', $id, PDO::PARAM_INT);
		return $stmt->execute();

	}

		//Busca um determinado programa relacionado
	public function find($id){
		$sql  = "SELECT * FROM $this->table WHERE p_id = :id";
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
	public function findAll($ativo){
		$sql  = "SELECT * FROM $this->table ";
		//Se ativo estiver marcado como 'S', buscará apenas os registros ativos
		if($ativo == 'S'){
		
			$sql .= "WHERE p_ativo = 'S' ";
			
		}
		$sql .= "ORDER BY p_ativo, p_nome ";
		$stmt = DB::prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll();
	}

		//Busca a quantidade de registros ativos
	public function findCount(){
		$sql  = "SELECT COUNT(*) as qtd FROM $this->table ";
		$sql .= "WHERE p_ativo = 'S' ";
		$stmt = DB::prepare($sql);
		$stmt->execute();
		return $stmt->fetch();
	}

}
