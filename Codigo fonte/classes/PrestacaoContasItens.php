<?php

require_once 'DB.php';

class PrestacaoContasItens{
	
	protected $table = 'prestacacao_contas_itens';
	private $caminho;
	private $mes;
	private $prestacao_contas;

	public function setCaminho($caminho){
		if(mb_strlen($caminho) <= 200){
			
			$this->caminho = $caminho;
			return true;
			
		}
		else{
			return false;
		}
	}

	public function setMes($mes){
		if(($mes == 'Janeiro')or($mes == 'Fevereiro')or($mes == 'Marco')or($mes == 'Abril')or($mes == 'Maio')or($mes == 'Junho')or($mes == 'Julho')or($mes == 'Agosto')or($mes == 'Setembro')or($mes == 'Outubro')or($mes == 'Novembro')or($mes == 'Dezembro')){
			
			$this->mes = $mes;
			return true;

		}
		else{
			return false;
		}
	}

	public function setPrestacaoContas($prestacao_contas){
		
		$this->prestacao_contas = $prestacao_contas;
		
	}
	
		//Cadastra uma nova data
	public function insert(){
         
        $sql  = "INSERT INTO $this->table (pci_mes, pci_prestacao_contas) ";
        $sql .= "VALUES (:mes, :prestacao_contas)";
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':mes', $this->mes);
		$stmt->bindParam(':prestacao_contas', $this->prestacao_contas);
		return $stmt->execute(); 

	}
		
		//Edita uma data existente
	public function update($id){

		$sql  = "UPDATE $this->table SET pci_caminho = :caminho WHERE pci_id = :id";
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':caminho', $this->caminho);
		$stmt->bindParam(':id', $id, PDO::PARAM_INT);
		return $stmt->execute();

	}
		
		//Busca uma determinada data
	public function find($id){
		$sql  = "SELECT * FROM $this->table WHERE pci_id = :id";
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
	public function findAll($prestacao_contas){
		$sql  = "SELECT * FROM $this->table ";
		$sql .= "WHERE pci_prestacao_contas = :prestacao_contas ";
		$sql .= "ORDER BY pci_mes asc";
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':prestacao_contas', $prestacao_contas);
		$stmt->execute();
		return $stmt->fetchAll();
	}

}
