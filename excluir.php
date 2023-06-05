<?php
// Verifique se o parâmetro 'num_ID_Vaca' foi passado
if (isset($_GET['num_ID_Vaca'])) {
    // Obtém o num_ID_Vaca da vaca a ser excluída
    $idVaca = $_GET['num_ID_Vaca'];

    // Conecte-se ao banco de dados
    $servername = "localhost";
    $username = "agrocare";
    $password = " ";
    $database = "agrocarefinal";

    $conn = new mysqli($servername, $username, $password, $database);

    // Verifique se houve erro na conexão
    if ($conn->connect_error) {
        die("Falha na conexão: " . $conn->connect_error);
    }

    // Execute a lógica de exclusão da vaca
    $excluirVacaQuery = "DELETE FROM Vaca WHERE num_ID_Vaca = '$idVaca'";
    $result = $conn->query($excluirVacaQuery);

    // Verifique se houve erro na execução da query
    if (!$result) {
        die("Erro na exclusão da vaca: " . $conn->error);
    }

    // Feche a conexão com o banco de dados
    $conn->close();

    // Redirecione para a página desejada após a exclusão (por exemplo, uma página de confirmação)
    header("Location: deletarVacas.php");
    exit;
} else {
    // Caso o parâmetro 'num_ID_Vaca' não tenha sido passado, redirecione para a página de erro ou outra página adequada
    header("Location: deletarVacas.php");
    exit;
}
?>
