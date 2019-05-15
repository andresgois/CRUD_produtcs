<?php 
	include_once 'structure.php';

	class Produto extends structure{
		
		protected $table = 'tb_produtos';
		private $nome;
		private $preco;
		private $descricao;
		private $imagem;

		public function __set($atributo, $valor){
			$this->$atributo = $valor;
		}

		public function insert(){
			$sql = "INSERT INTO tb_produtos (nome_pro,preco_pro,desc_pro,imagem_pro) VALUES (:nome,:preco,:descricao,:imagem)";
			$statement = Banco::prepare($sql);
			$statement->bindParam(':nome', $this->nome);
			$statement->bindParam(':preco', $this->preco);
			$statement->bindParam(':descricao', $this->descricao);
			$statement->bindParam(':imagem', $this->imagem);
			return $statement->execute();
		}

		public function update($id){
			$sql = "UPDATE $this->table SET nome_pro = :nome ,preco_pro = :preco,desc_pro = :descricao,imagem_pro = :imagem  WHERE id_pro = :id";
			$statement= Banco::prepare($sql);
			$statement->bindParam(':nome', $this->nome);
			$statement->bindParam(':preco', $this->preco);
			$statement->bindParam(':descricao', $this->descricao);
			$statement->bindParam(':imagem', $this->imagem);
			$statement->bindParam(':id', $id);
			return $statement->execute();	
		}


	}
 ?>