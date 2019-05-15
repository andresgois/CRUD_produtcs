<?php include_once 'Products.php'; 

	if(isset($_GET['acao']) && $_GET['acao'] == 'delete'):
		$id = (int)$_GET['id'];
		$produto = new Produto();
		if($produto->delete($id)):
			header("Location: index.php");
		endif;
	endif;
?>