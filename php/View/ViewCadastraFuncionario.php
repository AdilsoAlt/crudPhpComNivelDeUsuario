<?php
$titulo="Cadastrar Funcionario";
include $_SESSION["root"].'includes/header.php';

?>
<body>
	<div class="container" >
		<!-- add no menu -->
		<?php include $_SESSION["root"].'includes/menu.php';?> 
		<!-- fim menu -->	
		<div id="principal">
			<h1 class="text-center">Cadastro de Funcionário</h1>
			<form action="postCadastraFuncionario" method="POST">
				<div class="row">
					<?php if(isset($_SESSION["flash"]["msg"])){
							if($_SESSION["flash"]["sucesso"]==false)
								echo"<div class='bg-danger text-center msg'>".$_SESSION["flash"]["msg"]."</div>";
							else{
								echo"<div class='bg-success text-center msg'>".$_SESSION["flash"]["msg"]."</div>";
							}
						} ?>
					<div class="col-md-6">
						<div class="form-group">
							<label for="email">Login:<span class="requerido">*</span></label>
							<input type="login" name="login" class="form-control" id="login" 
								value="<?php if(isset($_SESSION["flash"]["login"]))echo $_SESSION["flash"]["login"];?>">
						</div>
						<div class="form-group">
							<label for="pwd">Senha:<span class="requerido">*</span></label>
							<input type="password" name="senha" class="form-control" id="pwd" value="">
						</div>
						<div class="form-group">
							<label for="departamento">Departamento:<span class="requerido">*</span></label>
							<select id="idDepartamento" name="idDepartamento" class="form-control" >
								<option selected>Choose...</option>
								<?php foreach($departamentos as $row) :?> 
									<option value="<?= $row->getId()?>"> <?=$row->getNome() ?> </option>

								<?php endforeach ?>
							</select>
						</div>	
						
					</div>

					<div class="col-md-6">
						<div class="form-group">
							<label for="nomeFunc">Nome:<span class="requerido">*</span></label>
							<input type="text" name="nomeFunc" class="form-control" id="nomeFunc" value="<?php if(isset($_SESSION["flash"]["nomeFunc"]))echo $_SESSION["flash"]["nomeFunc"];?>">
						</div>	
						<div class="form-group">
							<label for="salario">Salario:<span class="requerido">*</span></label>
							<input type="text" name="salario" class="form-control" id="salario" value="<?php if(isset($_SESSION["flash"]["salario"]))echo $_SESSION["flash"]["salario"];?>">
						</div>

						
						
						<div class="form-group">
							<label for="idPermissao">Permissão:<span class="requerido">*</span></label>
							<select  id="idPermissao" name="idPermissao" class="form-control">
								<option selected>Choose...</option>
								<?php foreach($permissoes as $row) :?> 
									<option value="<?= $row->getId()?>"> <?=$row->getTipo() ?> </option>
								<?php endforeach ?>
							</select>
						</div>				
					</div>

				

			  	</div>
			  <button type="submit" class="btn btn-default center-block">Submit</button>
			</form>
		</div>
	</div>	
</body>
<!-- add no footer -->
<?php 
	include $_SESSION["root"].'includes/footer.php';
	if(isset($_SESSION["flash"])){
		foreach ($_SESSION["flash"] as $key => $value) {
			unset($_SESSION["flash"][$key]);	
		}
	}?>
<!-- fim footer -->
<script>		
	$(document).ready(function () {
        $('.cadastrarFuncionario').addClass('active');
		
	});

</script>