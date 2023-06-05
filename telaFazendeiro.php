<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/telaFazendeiro.css">
    <title>Tela Fazendeiro</title>
</head>
<body>
    <div class="header">
        <h1>Fazendeiro</h1>
        <img src="img/vaca.png" class="imagem-vaca" width="110px">
        <button class="menu-button" id="menuButton"></button>
            <div class="menu-box" id="menuBox">
                <ul>
                    <li><a href="telaPrincipal.php">Gerenciar Cadastros</a></li>
                    <li><a href="telaFazendeiro.php">Acompanhamento</a></li>
                    <li><a href="javascript:history.back()">Voltar</a></li>
                    <li><a href="Login.php">Sair</a></li>
                </ul>
            </div>
    </div>
    <div class="main">
        <h2>Acompanhamento</h3>
        <table class="container">
            <thead>
                <tr>
                    <th>N° Identificador</th>
                    <th>Nascimento</th>
                    <th>Raça</th>
                    <th>Inseminação</th>
                </tr>
            </thead>
            <tbody>
                
                <?php
                    // Conexão com o banco de dados 
                    $servername = "localhost";   
                    $username = "agrocare";
                    $password = " ";
                    $database = "agrocarefinal";
                    $conn = new mysqli($servername, $username, $password, $database);
    
                    // Verificação de erros na conexão
                    if ($conn->connect_error) {
                        die("Falha na conexão: " . $conn->connect_error);
                    }
    
                    // Consulta ao banco de dados
                    $sql = "SELECT * FROM Vaca";
                    $result = $conn->query($sql);
    
                    // Verificação de erros na consulta
                    if (!$result) {
                        die("Erro na consulta: " . $conn->error);
                    }
    
                    // Exibição dos valores na tabela
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";

                        echo "<td>" . $row["num_ID_Vaca"] . "</td>";
                        echo "<td>" . $row["data_Nasc_Vaca"] . "</td>";
                        echo "<td>" . $row["raça_Vaca"] . "</td>";
                        echo "<td>" . $row["estado_Inseminação"] . "</td>";


                    }
    
                    // Fechamento da conexão com o banco de dados
                    $conn->close();
                ?>
                
            </tbody>
        </table>
    </div>
    <script src="scripts/scriptFazendeiro.js"></script>
</body>
</html>