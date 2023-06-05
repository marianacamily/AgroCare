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
                    <li><a href="">fechar</a></li>
                    <li><a href="javascript:history.back()">Voltar</a></li>
                    <li><a href="Login.php">Sair</a></li>
                </ul>
            </div>
    </div>
    <div class="main">
        <h2>Acompanhamento funcionario</h3>
        <table class="container">
            <thead>
                <tr>
                    <th>CPF</th>
                    <th>Nome</th>
                    <th>data de nascimento</th>
                    <th>telefone</th>
                    <th>email</th>
                    <th>senha</th>
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
    
                    // Consulta SQL para recuperar os registros
                    $query = "SELECT * FROM Fazendeiro";

                    $result = $conn->query($query);
                    // Verificação de erros na consulta
                    if (!$query) {
                        die("Erro na consulta: " . $conn->error);
                    }
    
                    // Exibição dos valores na tabela
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";

                        echo "<td>" . $row["cpf_Fazendeiro"] . "</td>";
                        echo "<td>" . $row["nome_Fazendeiro"] . "</td>";
                        echo "<td>" . $row["dt_nascFazendeiro"] . "</td>";
                        echo "<td>" . $row["telefone_Fazendeiro"] . "</td>";
                        echo "<td>" . $row["email_Fazendeiro"] . "</td>";
                        echo "<td>" . $row["senha_Fazendeiro"] . "</td>";
                        echo "<td>";
                        echo "<a href='editar.php?id=" . $row["email_Fazendeiro"] . "'>Editar</a>";  // Link para a página de edição (passando o CPF como parâmetro)
                        echo " | ";
                        echo "<a href='teste/excluir.php?id=" . $row["email_Fazendeiro"] . "'>Excluir</a>";  // Link para a página de exclusão (passando o CPF como parâmetro)
                        echo "</td>";
                        echo "</tr>";
                    }
    
                    // Fechamento da conexão com o banco de dados
                    $conn->close();
                ?>
                
            </tbody>
        </table>
    </div>
</body>
</html>