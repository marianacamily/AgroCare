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
        session_start();
        // Recebe os dados do formulário
        $nome_Vet = $_POST["nome_Vet"];
        $cpf_Vet = $_POST["cpf_Vet"];
        $dt_nasc_Vet = $_POST["dt_nascVet"];
        $telefone_Vet = $_POST["telefone_Vet"];
        $senha_Vet = $_POST["senha_Vet"];
        $senha_teste = $_POST["senha_teste"];
        $nome_Fazenda = $_SESSION['nome_Fazenda'];

        function formatarCPF($cpf_Vet) {
            return preg_replace('/^(\d{3})(\d{3})(\d{3})(\d{2})$/', '$1.$2.$3-$4', $cpf_Vet);
        }
        
        function formatarTelefone($telefone_Vet) {
            return preg_replace('/^(\d{2})(\d{4})(\d{4})$/', '$1 $2-$3', $telefone_Vet);
        }
        
        function validarSenha($senha_Vet) {
            return preg_match('/^(?=.*[!@#$%^&*])(.{8,})$/', $senha_Vet);
        }
        
        $cpfFormatado = formatarCPF($cpf_Vet);
        echo "CPF formatado: " . $cpfFormatado . "\n";
        
        $telefoneFormatado = formatarTelefone($telefone_Vet);
        echo "Telefone formatado: " . $telefoneFormatado . "\n";
        
        $senhaValida = validarSenha($senha_Vet);
        echo "Senha válida? " . ($senhaValida ? 'Sim' : 'Não') . "\n";
        // Aplica as formatações
        $cpfFormatado = formatarCPF($cpf_Vet);
        $telefoneFormatado = formatarTelefone($telefone_Vet);

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

        // Verifica as exceções
        if ((!$cpfFormatado || !$telefoneFormatado || !$senhaValida)|| ($senha_Vet !== $senha_teste)) {
            
            echo "<script>window.location.href = 'cadastroVeterinario.php';</script>";
            echo '<script>alert("Preencha os campos corretamente!");</script>';
        } else {
            $partesNome = explode(" ", $nome_Vet);
            $primeiroNome = $partesNome[0];
            $ultimoNome = end($partesNome);
            $email = $primeiroNome . '.' . $ultimoNome . '@' . $nome_Fazenda . '.com.br';
            $sql = "INSERT INTO Veterinário (nome_Vet, cpf_Vet, dt_nascVet, telefone_Vet, senha_Vet, email_Vet) 
            VALUES ('$nome_Vet', '$cpf_Vet', '$dt_nasc_Vet', '$telefone_Vet', '$senha_Vet', '$email')";
            $fk = "UPDATE Fazenda SET FK_cpf_Vet = '$cpf_Vet' WHERE nome_Fazenda = '$nome_Fazenda'";
            echo "<script>window.location.href = 'cadastroFuncionario.php';</script>";
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
        <p><h1>Cadastrar Veterinário</h1></p><br>
        <form action="cadastroVeterinario.php" method="post">
            <label>Nome Completo:</label>        
            <input type="text" id="nome" name="nome_Vet" size="20" maxlength="20" placeholder="Digite seu nome completo" pattern="[a-zA-Z\u00C0-\u00FF ]{10,100}$" required>
            <label>CPF:</label>
            <input type="text" name="cpf_Vet" size="20" maxlength="20" placeholder="Digite apenas os números" pattern="[0-9]{11}" required><br><br>
            
            <label>Data de Nascimento:</label>
            <input type="date" name="dt_nascVet" size="20" maxlength="20" required>

            <label>Telefone:</label>            
            <input type="text" name="telefone_Vet" placeholder="Digite apenas os números" pattern="[0-9]{11}" required><br><br>

            <label>Senha:</label>
            <input type="password" name="senha_teste" placeholder="8 caracteres, 1 especial" required>

            <label>Confirmar senha: </label>
            <input type="password" name="senha_Vet" pattern="^(?=.*[!@#$%^&*])(.{8,})$" required><br><br>

            <div class="btns">
                <button onclick ="limparCampos()" id="btn-cancelar" class="btn-cancelar">Cancelar</button>
                <a href="cadastroFuncionario.php"><button class="btn-cadastrar" type="submit" name="cadastrar">Cadastrar</button></a>
            </div>
        </form>
        <div>
   
        
        <footer>
          *Ao clicar  em Cadastrar, todas as informações digitadas<br>
             serão salvas, confira se os dados estão corretos.
        </footer>
        
    </fieldset>
    <script src="scripts/script.js"></script>
</body>

</html>