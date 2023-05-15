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
        session_start();
        // Recebe os dados do formulário
        $nome_Fun = $_POST["nome_Func"];
        $cpf_Fun = $_POST["cpf_Func"];
        $dt_nasc_Fun = $_POST["dt_nascFunc"];
        $telefone_Fun = $_POST["telefone_Func"];
        $senha_Fun = $_POST["senha_Func"];
        $nome_Fazenda = $_SESSION['nome_Fazenda'];
        $senha_teste = $_POST["senha_teste"];
        $_SESSION["cpf_Func"] = $cpf_Fun;
        function formatarCPF($cpf_Fun) {
            return preg_replace('/^(\d{3})(\d{3})(\d{3})(\d{2})$/', '$1.$2.$3-$4', $cpf_Fun);
        }
        
        function formatarTelefone($telefone_Fun) {
            return preg_replace('/^(\d{2})(\d{1})(\d{4})(\d{4})$/', '$1 $2 $3-$4', $telefone_Fun);
        }
        
        function validarSenha($senha_Fun) {
            return preg_match('/^(?=.*[!@#$%^&*])(.{8,})$/', $senha_Fun);
        }
        
        $cpfFormatado = formatarCPF($cpf_Fun);
        echo "CPF formatado: " . $cpfFormatado . "\n";
        
        $telefoneFormatado = formatarTelefone($telefone_Fun);
        echo "Telefone formatado: " . $telefoneFormatado . "\n";
        
        $senhaValida = validarSenha($senha_Fun);
        echo "Senha válida? " . ($senhaValida ? 'Sim' : 'Não') . "\n";
        // Aplica as formatações
        $cpfFormatado = formatarCPF($cpf_Fun);
        $telefoneFormatado = formatarTelefone($telefone_Fun);


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
        // Verifica as exceções
        if ((!$cpfFormatado || !$telefoneFormatado || !$senhaValida) || ($senha_Func !== $senha_teste)) {
            echo '<script>alert("Preencha os campos corretamente!");</script>';
            echo "<script>window.location.href = 'cadastroFuncionario.php';</script>";
        } else {
            $partesNome = explode(" ", $nome_Fun);
            $primeiroNome = $partesNome[0];
            $ultimoNome = end($partesNome);
            $email = $primeiroNome . '.' . $ultimoNome . '@' . $nome_Fazenda . '.com.br';
            $sql = "INSERT INTO Funcionário (nome_Func, cpf_Func, dt_nascFunc, telefone_Func, senha_Func, email_Func) 
            VALUES ('$nome_Fun', '$cpf_Fun', '$dt_nasc_Fun', '$telefone_Fun', '$senha_Fun', '$email')";
            $fk = "UPDATE Fazenda SET FK_cpf_Func = '$cpf_Fun' WHERE nome_Fazenda = '$nome_Fazenda'";
            echo "<script>window.location.href = 'login.php';</script>";
        }

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
        <form action="cadastroFuncionario.php" method="POST">
            <label>Nome Completo:</label>             <!--adicionado atributo pattern para regex-->
            <input type="text" id="nome" name="nome_Func" size="20" maxlength="20" placeholder="Digite seu nome completo" pattern="[a-zA-Z\u00C0-\u00FF ]{10,100}$" required>
            <label>CPF:</label>
            <input type="text" name="cpf_Func" size="20" maxlength="20" placeholder="Digite apenas os números" pattern="[0-9]{11}" required><br><br>
            <label>Data de Nascimento:</label>
            <input type="date" name="dt_nascFunc" size="20" maxlength="20" required>

            <label>Telefone:</label>            <!--adicionado atributo pattern para regex-->
            <input type="text" name="telefone_Func" placeholder="Digite apenas os números" pattern="[0-9]{11}" required><br><br>

            <label>Senha:</label>
            <input type="password" name="senha_teste" placeholder="8 caracteres, 1 especial" required>

            <label>Confirmar senha: </label>
            <input type="password" name="senha_Func" pattern="^(?=.*[!@#$%^&*])(.{8,})$" required><br><br>

            <div class="btns">
                <button onclick="limparCampos()" id="btn-cancelar" class="btn-cancelar">Cancelar</button>
                <a href="login.php"><button  class="btn-cadastrar" type="submit" name="cadastrar">Cadastrar</button></a>
            </div>
            <footer>
                *Ao clicar  em Cadastrar, todas as informações digitadas<br>
                 serão salvas, confira se os dados estão corretos.
            </footer>
            
        </form>

        <script src="scripts/script.js"></script>
</body>
</html>