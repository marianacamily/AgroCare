<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Fazenda</title>
    <link rel="stylesheet"  type="text/css" href="style/cadastroFazenda.css">
</head>
<header>
   <img src="img/Logo1.png" width="180px">
</header>
<body>
<?php
        if($_SERVER["REQUEST_METHOD"] == "POST") {
    
            // Recebe os dados do formulário
            $nome_Faz = $_POST['nome_Fazenda'];
            $endereço_Faz = $_POST['endereço_Fazenda'];
            $bairro_Faz = $_POST['bairro_Fazenda'];
            $numero_Faz = $_POST['numero_Fazenda'];
            $cidade_Faz = $_POST['cidade_Fazenda'];
            $estado_Faz = $_POST['estado_Fazenda'];
            $cep_Faz = $_POST['cep_Fazenda'];
    
            $servername = "localhost";
            $username = "agrocare";
            $password = " ";
            $database = "agrocarefinal";
    
            // Cria a conexão com o banco de dados
            $conn = new mysqli("localhost", "agrocare", " ", "agrocarefinal");
    
            // Verifique se ocorreu um erro na conexão
            if ($conn->connect_error) {
                die("Falha na conexão: " . $conn->connect_error);
            }
            // Crie a consulta SQL para inserir os dados na tabela fazenda
            $sql = "INSERT INTO Fazenda(nome_Fazenda, endereço_Fazenda, bairro_Fazenda, numero_Fazenda, cidade_Fazenda, estado_Fazenda, cep_Fazenda) 
            VALUES ('$nome_Faz', '$endereço_Faz', '$bairro_Faz', '$numero_Faz', '$cidade_Faz', '$estado_Faz', '$cep_Faz')";   
    
            // Execute a consulta
            if ($conn->query($sql) === TRUE) {
                echo "Dados cadastrados com sucesso!";
            } else {
                echo "Erro ao cadastrar os dados: " . $conn->error;
            }
            mysqli_close($conn);
    }
?>
    <div class="cadastro">

        <p><h1>Cadastrar Fazenda</h1></p><br>
        <form action="cadastroFazenda.php" method="POST">
            <label>Nome da Fazenda:</label>
            <input type="text" name= "nome_Fazenda" size="20" maxlength="20">
            <label>Endereço:</label>
            <input type="text" name= "endereço_Fazenda" size="20" maxlength="20"><br>
            <label>Bairro:</label>
            <input type="text" name= "bairro_Fazenda">
            <label>Número:</label>
            <input type="text" name= "numero_Fazenda" size="20" maxlength="20"><br>
            <label>Cidade:</label>
            <input type="text" name= "cidade_Fazenda" size="20" maxlength="20">
            <label>CEP:</label>
            <input type="text" name= "cep_Fazenda" size="20" maxlength="20"><br>
            <label>Estado:</label>
            <input type="text" name="estado_Fazenda"size="20" maxlength="20"><br><br>
            <div class="btns">
                <button class="btn-cancelar">Cancelar</button>
                <button class="btn-cadastrar">Cadastrar</button>
            </div>
        </form>

        <footer>
            *Ao clicar  em Cadastrar, todas as informações digitadas<br>
             serão salvas, confira se os dados estão corretos.
        </footer>
        
    </fieldset>
</body>

</html>