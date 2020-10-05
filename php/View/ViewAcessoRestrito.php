<?php 
$titulo="Acesso Restrito";
include $_SESSION["root"].'includes/header.php';
?>
<body>
	<div class="container" >
    <?php include $_SESSION["root"].'includes/menu.php';?>
		<div id="principal" >
            <div class="alert alert-danger" role="alert">
                <h1>PÁGINA RESTRITA</h1>
            </div>
		</div>
	</div>	
<?php 
	include $_SESSION["root"].'includes/footer.php';
	if(isset($_SESSION["flash"])){
		foreach ($_SESSION["flash"] as $key => $value) {
			unset($_SESSION["flash"][$key]);	
		}
	}
	
?>