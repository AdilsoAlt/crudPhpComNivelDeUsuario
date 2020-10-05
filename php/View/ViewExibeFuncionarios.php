<?php
$titulo="Exibir Funcionários";
include $_SESSION["root"].'includes/header.php';

?>
<body>
	<div class="container" >
		<!-- add no menu -->
		<?php include $_SESSION["root"].'includes/menu.php';?>
		<!-- fim menu -->	
		<div id="principal">
			<h1 class="text-center">Funcionários</h1>
			<table class="table table-striped">


			<?php 
				//$funcionarios foi criado no controller que chamou essa classe;
				echo "<tr>";
					echo "<th style="."cursor:"."pointer ".
						 "onclick=location.href='orderFuncionario?orderBy=nomeFunc'".">Nome".
						 "</th>";
					echo "<th>Salário</th>";
					echo "<th>Login</th>";
					echo "<th style="."cursor:"."pointer ".
						 "onclick=location.href='orderFuncionario?orderBy=idDepartamento'".">Departamento".
						 "</th>";
					echo "<th>Permissao</th>";
					//echo "<th>Açoes</th>";
					if ($_SESSION["permissao"] == "1") echo "<th>Editar</th><th>Excluir</th>";
				echo "</tr>";
				foreach ($funcionariosDTO as $value) {
					echo "<tr>";
						echo "<td>".$value->getNome()."</td>";
						echo "<td>".$value->getSalario()."</td>";
						echo "<td>".$value->getLogin()."</td>";
						echo "<td>".$value->getNomeDepartamento()."</td>";
						echo "<td>".$value->getNomePermissao()."</td>";
						//echo "<td>"."<img src="."includes/imgs/edit-solid.svg >"."</td>";

						if ($_SESSION["permissao"] == "1") echo "<td> <a href=editaFuncionario?id='".$value->getIdFuncionario()."'><img style='width: 2.5rem' src='includes/imgs/edit-solid.svg'></a>";

						if ($_SESSION["permissao"] == "1") echo "<td style='cursor:pointer'><img style='width: 2rem' src='includes/imgs/trash-alt-regular.svg' onclick='excluiFuncionario(".$value->getIdFuncionario().")'></td>";										
						//echo "<td style='cursor:pointer'><img src='includes/imgs/trash-alt-regular.svg' onclick='excluiFuncionario($value->getIdFuncionario())></td>";
						//echo "<td>"."<img src="."includes/imgs/edit-solid.svg>"."</td>";
						//<img src="imagens/search.png" onclick="ocultaForm()">
						echo "</tr>";

				}
			?>
			</table>
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
        $('.visualizarFuncionario').addClass('active');

    });

	function excluiFuncionario(id){
		$.ajax({
			type:'post',
			url: "excluiFuncionario",
			data:{
				"id":id
			},
			success: function(){
				location.reload();
				console.log(id);
				alert("Funcionário excluído com sucesso");
			},
			error: function(){
				alert("Não foi possível excluir o funcionário")
			}

		})	
	}
	
</script>

