<?php 
	class Banco{
        // Variavel de conexao estática
		private static $connection;

        // Método estático
		public static function getConnection(){
            // Se não houve existir coneção, será criada
			if(!isset(self::$connection)):
				try{
					self::$connection = new PDO('mysql:host=localhost;dbname=db_bleez','root','info@123',array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
					self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					self::$connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
				}catch(PDOException $e){
					echo $e->getMessage();
				}
			endif;

			return self::$connection;
		}

		public static function prepare($sql){
			return self::getConnection()->prepare($sql);
		}

	}
 ?>