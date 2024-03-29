<!DOCTYPE html>
<html>
<head>

    <title>Cadastro de Exames</title>
	<link rel="icon" type="image/jpg" href="imagens/logo.jpg"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <style>
        .w3-theme {
            color: #ffff !important;
            background-color: #380077 !important
        }

        .w3-code {
            border-left: 4px solid #380077
        }

        .myMenu {
            margin-bottom: 150px
        }
    </style>
</head>
<body onload="w3_show_nav('menuDisc')">
<!-- Inclui MENU.PHP  -->
<?php require 'menu.php'; ?>

<!-- Conteúdo Principal: deslocado para direita em 270 pixels quando a sidebar é visível -->
<div class="w3-main w3-container" style="margin-left:270px;margin-top:117px;">

    <div class="w3-panel w3-padding-large w3-card-4 w3-light-grey">
        <h1 class="w3-xxlarge">Editar exame</h1>

        <p class="w3-large">
            <div class="w3-code cssHigh notranslate">
                <!-- Acesso em:-->
                <?php

                date_default_timezone_set("America/Sao_Paulo");
                $data = date("d/m/Y H:i:s", time());
                echo "<p class='w3-small' > ";
                echo "Acesso em: ";
                echo $data;
                echo "</p> "
                ?>

                <!-- Acesso ao BD-->
				<?php
				
				$servername = "localhost:3306";
				$username = "usu@IE_Exe";
				$password = "php@PUCPR";
				$database = "IE_Exemplo";
				$id=$_GET['id'];
				
				// Cria conexão
				$conn = mysqli_connect($servername, $username, $password, $database);

				// Verifica conexão
				if (!$conn) {
					die("Connection failed: " . mysqli_connect_error());
				}
				// Configura para trabalhar com caracteres acentuados do português
				mysqli_query($conn,"SET NAMES 'utf8'");
				mysqli_query($conn,"SET NAMES 'utf8'");
				mysqli_query($conn,'SET character_set_connection=utf8');
				mysqli_query($conn,'SET character_set_client=utf8');
				mysqli_query($conn,'SET character_set_results=utf8');
				// Faz Select na Base de Dados
				$sql = "SELECT CodDisciplina, NomeDisc, Ementa FROM disciplina WHERE codDisciplina = $id";
				echo "<div class='w3-responsive w3-card-4'>"; //Inicio form
				 if ($result = mysqli_query($conn, $sql)) {
						if (mysqli_num_rows($result) > 0) {
						// Apresenta cada linha da tabela
							while ($row = mysqli_fetch_assoc($result)) {
				?>				
								<div class="w3-container w3-blue">
									<h2>Altere os dados do Exame || Código = [<?php echo $row['CodDisciplina']; ?>]</h2>
								</div>
								<form class="w3-container" action="discAtualizar_exe.php" method="post" onsubmit="return check(this.form)">
									<input type="hidden" id="Id" name="Id" value="<?php echo $row['CodDisciplina']; ?>">
									<p>
									<label class="w3-text-deep-black"><b>Nome</b></label>
									<input class="w3-input w3-border w3-light-grey" name="Nome" type="text" pattern="[a-zA-Z\u00C0-\u00FF ]{10,100}$"
										   title="Nome da disciplina entre 10 e 100 letras." value="<?php echo $row['NomeDisc']; ?>" required></p>
									<p>
									<label class="w3-text-deep-black"><b>Receita</b></label>
									<textarea class="w3-input w3-border w3-light-grey " name="Ementa"  rows="5" title="Texto Descritivo" required><?php echo $row['Ementa']; ?></textarea>
									
									<p>
									<input type="submit" value="Alterar" class="w3-btn w3-red" >
									<input type="button" value="Cancelar" class="w3-btn w3-blue" onclick="window.location.href='discListar.php'"></p>
								</form>
			<?php 
							}
						}
				}
				else {
					echo "Erro executando UPDATE: " . mysqli_error($conn);
				}
				echo "</div>"; //Fim form
				mysqli_close($conn);  //Encerra conexao com o BD

			?>

			</div>
		</p>
	</div>
<!-- FIM PRINCIPAL -->
</div>
<!-- Inclui RODAPE.PHP  -->
<?php require 'rodape.php';?>

</body>
</html>
