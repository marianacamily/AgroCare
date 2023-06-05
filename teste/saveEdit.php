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

    if(isset($_POST['update'])) {
        $email = $_POST['email_Fazendeiro'];
        $nome = $_POST["nome_Fazendeiro"];
        $cpf = $_POST["cpf_Fazendeiro"];
        $dt_nasc = $_POST["dt_nascFazendeiro"];
        $telefone = $_POST["telefone_Fazendeiro"];
        $senha = $_POST["senha_Fazendeiro"];
        $senha_teste = $_POST["senha_teste"];


        $sql = "UPDATE Fazendeiro SET cpf_Fazendeiro = '$cpf', nome_Fazendeiro='$nome', dt_nascFazendeiro='$dt_nasc', telefone_Fazendeiro='$dt_nasc', senha_Fazendeiro= '$senha' WHERE email_Fazendeiro = '$email'";
        $result = $conn->query($sql);
    }
    echo 'sucesso';
?>