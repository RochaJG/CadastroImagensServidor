<?php

function saveOnDB($name, $path) {
	$conn = mysqli_connect('localhost', 'root', 'root', 'testeimg') or die ('Error connecting to database');
	
	$validate_query = "SELECT `nome`, `path` FROM imagens where nome = '$name' and `path` = '$path'";
	$result = mysqli_query($conn, $validate_query);
	
	
	if(mysqli_num_rows($result) == 0) { // Ferifica se a imagen já foi cadastrada
		
		// Inserção a ser feita no banco
		$registre_query = "INSERT INTO imagens(nome, `path`)
		VALUES ('$name', '$path'.'$name')";
		// executamos a query à base de dados e obtemos os valores
		$result = mysqli_query($conn, $registre_query) or die('MySQL Error:<br>'.mysqli_error($conn));
	
		return true;
	} else {
		return false;
	}
}

//if they DID upload a file...
if($_FILES['userfile']['name']) {
	//if no errors...
	if(!$_FILES['userfile']['error']) {
		//now is the time to modify the future file name and validate the file
		$new_file_name = strtolower($_FILES['userfile']['tmp_name']); //rename file
		if($_FILES['userfile']['size'] > (1024000 * 8)) { //can't be larger than 8 MB
			$valid_file = false;
			$message = 'Oops!  Your file\'s size is to large.';
			echo $message;
		} else {
			$valid_file = true;
		}

		//if the file has passed the test
		if($valid_file) {
			//move it to where we want it to be
			$currentdir = getcwd();
			$arquivo = $_FILES['userfile']['name'];
			$target = $currentdir .'/imgs/';
			move_uploaded_file($_FILES['userfile']['tmp_name'], $target);

			if(saveOnDB($arquivo, 'imgs/'.$arquivo)) {	
				echo "<script>
						alert('Imagem Cadastrada com sucesso!');
						window.location = 'index.php';
					</script>";
			} else {
				echo "<script>
						alert('ERRO! Imagem já existente no sistema!');
						window.location = 'index.php';
					</script>";
			}
		}
	}
	//if there is an error...
	else {
		//set that to be the returned message
		$message = 'Ooops!  Your upload triggered the following error:  '.$_FILES['userfile']['error'];
		echo $message;
	}
}

?>