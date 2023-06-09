<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style_principal.css">
    <title>Tabela de valores</title>
</head>
<body>
    <body>
        <h1>Tabela de Valores</h1>
        
        <table class="container">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>nome</th>
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
                    $sql = "SELECT * FROM Funcionário UNION SELECT * FROM Veterinário UNION SELECT * FROM Fazendeiro";
                    $result = $conn->query($sql);
    
                    // Verificação de erros na consulta
                    if (!$result) {
                        die("Erro na consulta: " . $conn->error);
                    }
    
                    // Exibição dos valores na tabela
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";

                        echo "<td>" . $row["email_Func"] . "</td>";
                        echo "<td>" . $row["nome_Func"] . "</td>";

                        echo "</tr>";
                    }
    
                    // Fechamento da conexão com o banco de dados
                    $conn->close();
                ?>
                
            </tbody>
        </table>
    </body>
    </html>
</body>
</html>