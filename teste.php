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
$query = "SELECT f.nome_Func, f.cpf_Func, v.cpf_Vet, v.nome_Vet, fz.cpf_Fazendeiro, fz.nome_Fazendeiro, vc.num_ID_Vaca
          FROM Funcionário f
          CROSS JOIN Veterinário v 
          CROSS JOIN Fazendeiro fz 
          CROSS JOIN Vaca vc";

$result = $conn->query($query);
// Verificação de erros na consulta
if (!$result) {
    die("Erro na consulta: " . $conn->error);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Exemplo de exibição de registros</title>
    <style>
        table {
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid black;
            padding: 5px;
        }
    </style>
    <script>
        function exibirOpcoes(cpfFunc) {
            var opcoes = document.getElementById(cpfFunc);
            if (opcoes.style.display === "none") {
                opcoes.style.display = "block";
            } else {
                opcoes.style.display = "none";
            }
        }
    </script>
</head>
<body>
    <h1>Registros</h1>
    <table>
        <tr>
            <th>Nome Funcionário</th>
            <th>CPF Funcionário</th>
            <th>CPF Veterinário</th>
            <th>Nome Veterinário</th>
            <th>CPF Fazendeiro</th>
            <th>Nome Fazendeiro</th>
            <th>Num. ID Vaca</th>
            <th>Ações</th>
        </tr>
        <?php
        // Exibindo os registros na tabela
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["nome_Func"] . "</td>";
                echo "<td>" . $row["cpf_Func"] . "</td>";
                echo "<td>" . $row["cpf_Vet"] . "</td>";
                echo "<td>" . $row["nome_Vet"] . "</td>";
                echo "<td>" . $row["cpf_Fazendeiro"] . "</td>";
                echo "<td>";
                echo "<span onclick=\"exibirOpcoes('opcoes-" . $row["cpf_Fazendeiro"] . "')\">" . $row["nome_Fazendeiro"] . "</span>";
                echo "<div id='opcoes-" . $row["cpf_Fazendeiro"] . "' style='display: none;'>";
                echo "<a href='editar.php?id=" . $row["cpf_Func"] . "'>Editar</a>";
                echo " | ";
                echo "<a href='excluir.php?id=" . $row["cpf_Func"] . "'>Excluir</a>";
                echo "</div>";
                echo "</td>";
                echo "<td>" . $row["num_ID_Vaca"] . "</td>";
                echo "<td>";
                echo "<a href='editar.php?id=" . $row["cpf_Func"] . "'>Editar</a>";  // Link para a página de edição (passando o CPF como parâmetro)
                echo " | ";
                echo "<a href='excluir.php?id=" . $row["cpf_Func"] . "'>Excluir</a>";  // Link para a página de exclusão (passando o CPF como parâmetro)
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='8'>Nenhum registro encontrado.</td></tr>";
        }
        ?>
    </table>

</body>
</html>

<?php
// Fechamento da conexão com o banco de dados
$conn->close();
?>
