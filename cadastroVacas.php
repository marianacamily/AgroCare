<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/cadastroVacas.css">
    <title>Cadastro Vacas</title>
</head>
<body>
    <div class="header">
        <h1>Funcionário</h1>
        <img src="img/vaca.png" class="imagem-vaca" width="110px">
        <button class="menu-button" id="menuButton"></button>
            <div class="menu-box" id="menuBox">
                <ul>
                    <li><a href=telaPrincipal.php>Home</a></li>
                    <li><a href="#">Perfil</a></li>
                    <li><a href="javascript:history.back()">Voltar</a></li>
                    <li><a href="">Fechar</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="main">
        <div class="inputs">
            <h2>Cadastro de Vacas</h2>
            <form>
                <div class="box1">
                    <label>N° Identificador:</label>
                    <input type="text" name= "num_ID_Vaca" size="21" placeholder="Digite o N° Identificador" pattern="[0-9]" maxlength="10" required>
                </div>
                <div class="box1">
                    <label>Data de Nascimento:</label>
                    <input class="date" type="date" name= "data_Nasc_Vaca" size="21" placeholder="Digite a data de nascimento" maxlength="20" required>
                </div>
                <h6>*Informe uma Data aproximada, apenas para o cálculo da idade do animal.</h6>
                <div class="box1">
                    <label>Raça:</label>
                    <input type="text" name= "raça_Vaca" size="21" placeholder="Digite a raça da Vaca" maxlength="20" required>
            </form>
            </div>
        </div>
        <div class="btns">
            <button onclick="limparCampos()" id="btn-cancelar" class="btn-cancelar">Cancelar</button>
            <a href="login.php"><button  class="btn-cadastrar" type="submit" name="cadastrar">Cadastrar</button></a>
    </div>
    <script src="scripts/scriptCadVacas.js"></script>
    
</body>
<?php
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        session_start();
        // Recebe os dados do formulário
        $num_ID_Vaca = $_POST["num_ID_Vaca"];
        $data_Nasc_Vaca = $_POST["data_Nasc_Vaca"];
        $raça_Vaca = $_POST["raça_Vaca"];

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
        
        $sql = "INSERT INTO Vaca (num_ID_Vaca, data_Nasc_Vaca, raça_Vaca) 
        VALUES ('$num_ID_Vaca', '$data_Nasc_Vaca', '$raça_Vaca')";
        
        
        // Execute a consulta
        if ($conn->query($sql) === TRUE) {
            echo "Dados cadastrados com sucesso!";
        } else {
            echo "Erro ao cadastrar os dados: " . $conn->error;
        }
        mysqli_close($conn);
}
?>
</html>