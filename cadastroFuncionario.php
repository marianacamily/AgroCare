<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Funcionario</title>
    <link rel="stylesheet" type="text/css" href="style/style_fun.css">
</head>
<header>
    <img src="img/Logo1.png" width="180px">
</header>
<body>
<?php
    if($_SERVER["REQUEST_METHOD"] == "POST") {
    
        // Recebe os dados do formulário
        $nome_Fun = $_POST["nome_Func"];
        $cpf_Fun = $_POST["cpf_Func"];
        $dt_nasc_Fun = $_POST["dt_nascFunc"];
        $telefone_Fun = $_POST["telefone_Func"];
        $senha_Fun = $_POST["senha_Func"];

        
        $servername = "localhost";
        $username = "agrocare";
        $password = " ";
        $database = "agrocarefinal";

        // Crie a conexão com o banco de dados
        $conn = new mysqli("localhost", "agrocare", " ", "agrocarefinal");

        // Verifique se ocorreu um erro na conexão
        if ($conn->connect_error) {
            die("Falha na conexão: " . $conn->connect_error);
        }

        // Crie a consulta SQL para inserir os dados na tabela de funcionário
        $sql = "INSERT INTO Funcionário (nome_Func, cpf_Func, dt_nascFunc, telefone_Func, senha_Func) 
        VALUES ('$nome_Fun', '$cpf_Fun', '$dt_nasc_Fun', '$telefone_Fun', '$senha_Fun')";   

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
   
        <p><h1>Cadastrar Funcionário da Fazenda</h1></p><br>
        <form action="cadastrarFuncionario.php" method="POST">
            <label>Nome Completo:</label>             <!--adicionado atributo pattern para regex-->
            <input type="text" id="nome" name="nome_Func" size="20" maxlength="20" pattern="[a-zA-Z\u00C0-\u00FF ]{10,100}$" required>
            <label>CPF:</label>
            <input type="text" name="cpf_Func" size="20" maxlength="20" required><br><br>
            <label>Data de Nascimento:</label>
            <input type="date" name="dt_nascFunc" size="20" maxlength="20" required>

            <label>Telefone:</label>            <!--adicionado atributo pattern para regex-->
            <input type="text" name="telefone_Func" placeholder="(XX) XXXXX - XXXX" pattern="^\d{4}-\d{3}-\d{4}$" required><br><br>

            <label>Senha:</label>
            <input type="password" name="senha_Func" required>

            <label>Confirmar senha: </label>
            <input type="password" required><br><br>

            <div class="btns">
                <a href="../Login/index.html"><button id="btn-cancelar" class="btn-cancelar">Cancelar</button></a>
                <button onclick="gerarEmail()" class="btn-cadastrar" type="submit" name="cadastrar">Cadastrar</button>
            </div>
            <footer>
                *Ao clicar  em Cadastrar, todas as informações digitadas<br>
                 serão salvas, confira se os dados estão corretos.
            </footer>
            
        </form>
</body>
</html>