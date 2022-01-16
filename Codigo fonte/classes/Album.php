<?php

require_once 'DB.php';

class Album{
	
	protected $table = 'album';
	private $titulo;

	public function setTitulo($titulo){
		if(mb_strlen($titulo) <= 100){
			
			$this->titulo = $titulo;
			return true;
		
		}
		else{
		
			return false;
			
		}
	}

		//realiza o cadastro de um album
	public function insert(){
         
        $sql  = "INSERT INTO $this->table (a_titulo) VALUES (:titulo)";
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':titulo', $this->titulo);
		return $stmt->execute(); 

	}
		
		//Realiza a edição de um album
	public function update($id){

		$sql  = "UPDATE $this->table SET a_titulo = :titulo WHERE a_id = :id";
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':titulo', $this->titulo);
		$stmt->bindParam(':id', $id, PDO::PARAM_INT);
		return $stmt->execute();

	}

		//realiza a busca do ultimo album cadastrado
	public function findLast(){
		$sql  = "SELECT max(a_id) as id FROM $this->table ";
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
	
		//realiza a pesquisa por IDdeum determinado dado
	public function find($id, $pesquisa){
		$sql  = "SELECT * FROM $this->table WHERE ";
		
			//verifica se foi solicitado a pesquisa geral ( 0 ), pesquisa de albuns de eventos ( 1 ),
			//pesquisa de albuns de eventos e programas relacionados ( 2 ) ou pesquisa de programas relacionados ( 3 )
		if($pesquisa == 1){
			
			$sql .= "(a_id in (SELECT e_album FROM eventos where e_ativo = 'S')) AND ";
		
		}
		if($pesquisa == 2){
				
			$sql .= "((a_id in (SELECT e_album FROM eventos where e_ativo = 'S')) OR ";	
			$sql .= "(a_id in (SELECT p_album FROM programas_relacionados where p_ativo = 'S'))) AND ";		
				
		}
		if($pesquisa == 3){
				
			$sql .= "(a_id in (SELECT p_album FROM programas_relacionados where p_ativo = 'S')) AND ";		
				
		}
		$sql .= "a_id = :id";
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
	
		//realiza a pesquisa de um conjunto de dados 
	public function findAll($pesquisa){
		$sql  = "SELECT * FROM $this->table WHERE ";
			//verifica se foi solicitado a pesquisa somente de eventos ( 0 ), pesquisa de albuns de eventos e programas relacionados ( 1 ) 
			
		$sql .= "(a_id in (SELECT e_album FROM eventos where e_ativo = 'S')) ";
		if($pesquisa == 1){
			
			$sql .= "OR (a_id in (SELECT p_album FROM programas_relacionados where p_ativo = 'S')) ";
		
		}
		$sql .= "ORDER BY a_titulo";
		$stmt = DB::prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll();
	}

}
