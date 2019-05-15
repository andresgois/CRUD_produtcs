<?php include_once 'Products.php'; 

	if(isset($_GET['acao']) && $_GET['acao'] == 'editar'):
		$id = (int)$_GET['id'];
		$produto = new Produto();
		$result = $produto->find($id);
	endif;
	$a = $result->imagem_pro;

	if(isset($_POST['atualizar'])):				
		$nome 		= filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
		$preco 		= filter_input(INPUT_POST, 'preco');
		$descricao	= filter_input(INPUT_POST, 'descricao', FILTER_SANITIZE_SPECIAL_CHARS);

		$produto->__set('nome',$nome);
		$produto->__set('preco',$preco);
		$produto->__set('descricao',$descricao);

		if($_FILES['imagem']['name'] == ''):
			$produto->__set('imagem',$a);
			if($produto->update($id)):
				header("Location: index.php");
			endif;
		else:
			$formatosPermitidos = array("png","jpeg","jpg","gif");
			$extensao = pathinfo($_FILES['imagem']['name'],PATHINFO_EXTENSION);
				if(in_array($extensao, $formatosPermitidos)):
				    $pasta = "imagens/";
				    $temporario = $_FILES['imagem']['tmp_name'];
				    $novoNome = time().".$extensao";
				    move_uploaded_file($temporario, $pasta.$novoNome);
				    $produto->__set('imagem',$novoNome);

				    if($produto->update($id)):
						header("Location: index.php");
					endif;
				else:  ?>
						<div class="alert alert-danger mt-3" role="alert">
							Formato da imagem Inválido: Escolha uma imagem do tipo (PNG, JPEG, JPG )
						</div>
				   <?php 
				endif;
		endif;	

	endif;
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>CRUD - Produtos</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
</head>
<body>
	<nav class="navbar navbar-expand-sm navbar-dark bg-info">
		<a href="" class="navbar-brand">CRUD  - Produtos</a>
	</nav>
	<div class="container">		
		<div class="row">
			<div class="col col-md-10 offset-1 jumbotron" style="margin-top: 10px;">
					<form action="" method="POST" enctype="multipart/form-data">
						<div class="form-row">
							<div class="form-group col-md-6">	
							<input type="hidden" name="id" value="<?=$result->id_pro;?>">								
								<label for="nomeProduto">Nome do Produto.:</label>
								<input type="text" name="nome" value="<?=$result->nome_pro;?>" class="form-control" autofocus><br>							
							</div>
							<div class="form-group col-md-6">
								<label for="preco">Preço.:</label>
								<input type="number" step="any" min="0" max="9999.99" name="preco" value="<?=$result->preco_pro;?>" class="form-control"><br>
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-12">
								<label for="descricao">Descrição.:</label>
								<input type="text" name="descricao"  value="<?=$result->desc_pro;?>" class="form-control"><br>						
							</div>

							 <div class="col-md-10">
							 	<label for="imagem"></label>
							    <input type="file" name="imagem"  value="<?=$result->imagem_pro;?>" class="form-control">
							 </div>
						</div>
						<input type="submit" class="btn btn-block btn-info" name="atualizar" value="Atualizar" style="margin-top: 18px;">
					</form>		
			</div>
		</div>
	</div>	
</body>
</html>