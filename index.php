<?php include_once 'Products.php'; 	?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>CRUD - Produtos</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
</head>
<body>
	<?php $produto = new Produto(); 
		if(isset($_POST['cadastrar'])):
			$nome 		= filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
			$preco 		= filter_input(INPUT_POST, 'preco');
			$descricao	= filter_input(INPUT_POST, 'descricao', FILTER_SANITIZE_SPECIAL_CHARS);

			$produto->__set('nome',$nome);
			$produto->__set('preco',$preco);
			$produto->__set('descricao',$descricao);

			$formatosPermitidos = array("png","jpeg","jpg","gif");
			$extensao = pathinfo($_FILES['imagem']['name'],PATHINFO_EXTENSION);
			    if(in_array($extensao, $formatosPermitidos)):
			        $pasta = "imagens/";
			        $temporario = $_FILES['imagem']['tmp_name'];
			        $novoNome = time().".$extensao";
    	            move_uploaded_file($temporario, $pasta.$novoNome);
		            $produto->__set('imagem',$novoNome);				     
					
					$produto->insert();
		        else:  ?>
				       <div class="alert alert-dark mt-3" role="alert">
						  Formato Invalido: Escolha uma imagem do tipo (PNG, JPEG, JPG )
						</div>    
		  <?php endif;
		  header("Location:index.php");
		endif;
	?>
	<nav class="navbar navbar-expand-sm navbar-dark bg-info">
		<a href="" class="navbar-brand">CRUD  - Produtos</a>
	</nav>

	<div class="container">		
		<div class="row">
			<div class="col col-md-10 offset-1 jumbotron" style="margin-top: 10px;">

					<form action="<?=$_SERVER['PHP_SELF'];?>" method="POST" enctype="multipart/form-data">
						<div class="form-row">

							<div class="form-group col-md-6">
								<input type="hidden" name="id_pro">
								<label for="nomeProduto">Nome do Produto.:</label>
								<input type="text" name="nome"  placeholder="Produto:" required class="form-control" autofocus><br>							
							</div>
							<div class="form-group col-md-6">
								<label for="preco">Preço.:</label>
								<input type="number" name="preco" step="any" min="0" max="9999.99" placeholder="R$ 0.00" required class="form-control"><br>
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-12">
								<label for="descricao">Descrição.:</label>
								<input type="text" name="descricao" placeholder="Descrição:" required class="form-control"><br>						
							</div>

							 <div class="col-md-10">
							 	<label for="imagem"></label>
							    <input type="file" name="imagem" required class="form-control">
							 </div>

						</div>
						<input type="submit" class="btn btn-block btn-info" name="cadastrar" value="Cadastrar" style="margin-top: 18px;">
					</form>				
		
					 <table class="table" style="margin-top: 5px;">
					 	<thead class="thead-dark">
					 		<tr>
					 			<th>#</th>
					 			<th>Produto</th>
					 			<th>Preço</th>
					 			<th>Descrição</th>
					 			<th>Imagem</th>
					 			<th>Excluir</th>
					 			<th>Editar</th>
					 		</tr>
					 	</thead>
						
					 	<tbody>
							<tbody>
								<?php 
								 foreach($produto->findAll() as $key=>$value): ?>
									<tr>
										<td><?=$value->id_pro;?></td>
										<td><?=$value->nome_pro;?></td>
										<td><?=$value->preco_pro;?></td>
										<td><?=$value->desc_pro;?></td>
										<td><img src="imagens/<?=$value->imagem_pro;?>" width="30px" alt=""></td>
										<td>
											<a href="update.php?acao=editar&id=<?=$value->id_pro;?>" class="btn btn-warning"><i class="fas fa-edit"></i></a>
										</td>
										<td>
											<a href="delete.php?acao=delete&id=<?=$value->id_pro;?>" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>
										</td>
									</tr>
								<?php endforeach; ?>
							</tbody>					 	 
					 	</tbody>
					 </table>
				
			</div>
		</div>
	</div>	
</body>
</html>