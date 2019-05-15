<?php 
	include_once 'connection.php';

	abstract class structure extends Banco{
		protected $table;

		abstract public function insert();
		abstract public function update($id);

		public function find($id){
			$sql = "SELECT * FROM $this->table WHERE id_pro = :id";
			$statement = Banco::prepare($sql);
			$statement->bindParam(':id', $id, PDO::PARAM_INT);
			$statement->execute();
			return $statement->fetch();
		}

		public function findAll(){
			$sql = "SELECT * FROM $this->table";
			$statement = Banco::prepare($sql);
			$statement->execute();
			return $statement->fetchAll();
		}

		public function delete($id){
			$sql = "DELETE FROM $this->table WHERE id_pro = :id";
			$statement = Banco::prepare($sql);
			$statement->bindParam(':id', $id, PDO::PARAM_INT);
			return $statement->execute();
		}


	}
 ?>