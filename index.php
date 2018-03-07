<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Teste IMG</title>
<script src="main.js"></script>
</head>
<body>
<p align="center"><b>Acessando imagens do servidor</b>
<br><br>
<table border="1" cellpadding="6">
	<tr>
		<td align="center"><b>Selecione uma imagem</b></td>
	</tr>
	<tr>
		<td align="center">
			<select name="id_user" id="id_user" onchange="showUserData(this.value)">
				<option value="" >Escolha a imagem:</option>
			<?php
				// abrimos ligação à base de dados e escolhemos a tabela
				$conn = mysqli_connect('localhost', 'root', 'root', 'testeimg') or die ('Error connecting to database');
				
				// executamos a query para listar todos os utilizadores (id e nome)
				$myquery = "SELECT id, nome from imagens";
				$result = mysqli_query($conn, $myquery) or error_handle($myquery, mysqli_error());					
				while ($row = mysqli_fetch_array($result)){
					// e vamos criando tantas opções na lista quantos os utilizadores
					// colocando o id como valor e escrevendo o nome dos utilizadores
					// a mostrar na lista
			?>
					<option value="<?php echo $row['id']; ?>" ><?php echo utf8_encode($row['nome']); ?></option>
			<?php
				}
			?>
			</select>
		</td>
	</tr>
	<tr>
		<td colspan=2><img id="imageResp" width="500px"></td>
	</tr>
	<tr>
		<td><a href="upload.html">Enviar Imagem</a></td>
	</tr>
</table>
</p>
</body>
</html>