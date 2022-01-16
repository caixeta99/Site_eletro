<?php

require_once 'DB.php';

class ComposicaoGremio{
	
	protected $table = 'composicao_gremio';
	private $nome;
	private $modalidade;
	private $funcao;
	private $imagem;
	private $gremio;

	public function setNome($nome){
		if(mb_strlen($nome) <= 100){
			
			$this->nome = $nome;
			return true;
		
		}
		else{
		
			return false;
			
		}
	}
	
	public function setModalidade($modalidade){
		if(mb_strlen($modalidade) <= 100){
			
			$this->modalidade = $modalidade;
			return true;
			
		}
		else{
		
			return false;
			
		}
	}

    public function setFuncao($funcao){
		$this->funcao = $funcao;
	}

	public function setImagem($imagem){
		$this->imagem = $imagem;
	}
	
	public function setGremio($gremio){
		$this->gremio = $gremio;
	}

	public function insert(){
         
        $sql  = "INSERT INTO $this->table (cg_funcao, cg_gremio) VALUES (:funcao, :gremio)";
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':funcao', $this->funcao);
		$stmt->bindParam(':gremio', $this->gremio);
		return $stmt->execute(); 

	}

	public function update($id){

		$sql  = "UPDATE $this->table SET cg_nome = :nome, cg_modalidade = :modalidade, cg_imagens = :imagem WHERE cg_id = :id";
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':nome', $this->nome);
		$stmt->bindParam(':modalidade', $this->modalidade);
		$stmt->bindParam(':imagem', $this->imagem, PDO::PARAM_INT);
		$stmt->bindParam(':id', $id, PDO::PARAM_INT);
		return $stmt->execute();

	}

	public function find($id, $id_gremio){
		$sql = "SELECT * FROM $this->table ";
		$sql .= "WHERE cg_id = :id AND ";
		$sql .= "cg_gremio = :id_gremio";
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':id', $id, PDO::PARAM_INT);
		$stmt->bindParam(':id_gremio', $id_gremio, PDO::PARAM_INT);
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

	public function findAll($id_gremio){
		$sql  = "SELECT * FROM $this->table WHERE cg_gremio = :id_gremio ORDER BY cg_funcao asc";
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':id_gremio', $id_gremio, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetchAll();
	}

}
