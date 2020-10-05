<?php
$titulo="Editar Funcionário";
include $_SESSION["root"].'includes/header.php';
//print_r($departamentos);
//print_r($func);
?>
<body>
	<div class="container" >
		<!-- add no menu -->
		<?php include $_SESSION["root"].'includes/menu.php';?> 
		<!-- fim menu -->	
		<div id="principal">
			<h1 class="text-center">Editar Funcionário</h1>
			<form action="alteraFuncionario" method="POST">

				<input type="hidden" name="idFuncionario" class="form-control" id="idFuncionario" value= "<?=$func->getIdFuncionario();?>">
	
				
				<div class="row">

					<div class="col-md-6">
						<div class="form-group">
							<label for="email">Login:<span class="requerido">*</span></label>
							<input type="login" name="login" class="form-control" id="login"
								value="<?php echo $func->getLogin();?>">
						</div>
						<div class="form-group">
							<label for="pwd">Senha:<span class="requerido">*</span></label>
							<input type="password" name="senha" class="form-control" id="pwd" value="">
						</div>

						<div class="form-group">
							<label for="departamento">Departamento:<span class="requerido">*</span></label>
							<select id="idDepartamento" name="idDepartamento" class="form-control" value="">
								<?php foreach($departamentos as $row) :?>
									<option value="<?= $row->getId()?>"  <?php if ($func->getIdDepartamento() == $row->getId())echo "selected";?>>
										<?=$row->getNome() ?>
								</option>
								<?php endforeach ?>
							</select>
						</div>		
						
					</div>

					<div class="col-md-6">
						<div class="form-group">
							<label for="nomeFunc">Nome:<span class="requerido">*</span></label>
							<input type="text" name="nomeFunc" class="form-control" id="nomeFunc" value="<?php echo $func->getNomeFunc();?>">
						</div>	
						<div class="form-group">
							<label for="salario">Salario:<span class="requerido">*</span></label>
							<input type="text" name="salario" class="form-control" id="salario" value="<?php echo $func->getSalario();?>">
						</div>
						
				
						<div class="form-group">
							<label for="idPermissao">Permissão:<span class="requerido">*</span></label>
							<select  id="idPermissao" name="idPermissao" class="form-control" >">


							<?php foreach($permissoes as $row) :?>
									<option value="<?= $row->getId()?>"  <?php if ($func->getIdPermissao() == $row->getId())echo "selected";?>>
										<?=$row->getTipo()?>
								</option>
		
								<?php endforeach ?>
							</select>
						</div>				
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
        $('.alteraFuncionario').addClass('active');
    });
</script>