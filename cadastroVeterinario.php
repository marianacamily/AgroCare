<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Veterinário</title>
    <link rel="stylesheet"  type="text/css" href="style/veterinario.css">
</head>
<header>
   <img src="img/Logo1.png" width="180px">
</header>
<body>
<?php
    if($_SERVER["REQUEST_METHOD"] == "POST") {
    
        // Recebe os dados do formulário
        $nome_Vet = $_POST["nome_Vet"];
        $cpf_Vet = $_POST["cpf_Vet"];
        $dt_nasc_Vet = $_POST["dt_nascVet"];
        $telefone_Vet = $_POST["telefone_Vet"];
        $senha_Vet = $_POST["senha_Vet"];

        
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

        // Crie a consulta SQL para inserir os dados na tabela de veterinário
        $sql = "INSERT INTO Veterinário (nome_Vet, cpf_Vet, dt_nascVet, telefone_Vet, senha_Vet) 
        VALUES ('$nome_Vet', '$cpf_Vet', '$dt_nasc_Vet', '$telefone_Vet', '$senha_Vet')";   

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
        <p><h1>Cadastrar Veterinário</h1></p><br>
        <form action="cadastroVeterinario.php" method="post">
            <label>Nome Completo:</label>        
            <input type="text" id="nome" name="nome_Vet" size="20" maxlength="20" pattern="[a-zA-Z\u00C0-\u00FF ]{10,100}$" required>
            <label>CPF:</label>
            <input type="text" name="cpf_Vet" size="20" maxlength="20" required><br><br>
            
            <label>Data de Nascimento:</label>
            <input type="date" name="dt_nascVet" size="20" maxlength="20" required>

            <label>Telefone:</label>            
            <input type="text" name="telefone_Vet" placeholder="(XX) XXXXX - XXXX" pattern="^\d{4}-\d{3}-\d{4}$" required><br><br>

            <label>Senha:</label>
            <input type="password" name="senha_Vet" required>

            <label>Confirmar senha: </label>
            <input type="password" required><br><br>

            <div class="btns">
                <a href="../Login/index.html"><button id="btn-cancelar" class="btn-cancelar">Cancelar</button></a>
                <button onclick="gerarEmail()" class="btn-cadastrar" type="submit" name="cadastrar">Cadastrar</button>
            </div>
        </form>
        <div>
   
        
        <footer>
          *Ao clicar  em Cadastrar, todas as informações digitadas<br>
             serão salvas, confira se os dados estão corretos.
        </footer>
        
    </fieldset>
</body>

</html>