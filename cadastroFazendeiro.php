<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Fazendeiro</title>
    <link rel="stylesheet"  type="text/css" href="style/cadastroFazenda.css">
</head>
<header>
   <img src="img/Logo1.png" width="180px">
</header>
<body>
<?php
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        session_start();
        // Recebe os dados do formulário
        $nome = $_POST["nome_Fazendeiro"];
        $cpf = $_POST["cpf_Fazendeiro"];
        $dt_nasc = $_POST["dt_nascFazendeiro"];
        $telefone = $_POST["telefone_Fazendeiro"];
        $senha = $_POST["senha_Fazendeiro"];
        $nome_Fazenda = $_SESSION['nome_Fazenda'];
        function formatarCPF($cpf) {
            return preg_replace('/^(\d{3})(\d{3})(\d{3})(\d{2})$/', '$1.$2.$3-$4', $cpf);
        }
        
        function formatarTelefone($telefone) {
            return preg_replace('/^(\d{2})(\d{1})(\d{4})(\d{4})$/', '$1 $2 $3-$4', $telefone);
        }
        
        function validarSenha($senha) {
            return preg_match('/^(?=.*[!@#$%^&*])(.{8,})$/', $senha);
        }
        
        $cpfFormatado = formatarCPF($cpf);
        echo "CPF formatado: " . $cpfFormatado . "\n";
        
        $telefoneFormatado = formatarTelefone($telefone);
        echo "Telefone formatado: " . $telefoneFormatado . "\n";
        
        $senhaValida = validarSenha($senha);
        echo "Senha válida? " . ($senhaValida ? 'Sim' : 'Não') . "\n";
        // Aplica as formatações
        $cpfFormatado = formatarCPF($cpf);
        $telefoneFormatado = formatarTelefone($telefone);

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
        if (!$cpfFormatado || !$telefoneFormatado || !$senhaValida) {
            echo '<script>alert("Preencha os campos corretamente!");</script>';
            echo "<script>window.location.href = 'login.php';</script>";
        } else {
            $partesNome = explode(" ", $nome);
            $primeiroNome = $partesNome[0];
            $ultimoNome = end($partesNome);
            $email = $primeiroNome . '.' . $ultimoNome . '@' . $nome_Fazenda . '.com.br';
            $sql = "INSERT INTO Fazendeiro (nome_Fazendeiro, cpf_Fazendeiro, dt_nascFazendeiro, telefone_Fazendeiro, senha_Fazendeiro, email_Fazendeiro) 
            VALUES ('$nome', '$cpf', '$dt_nasc', '$telefone', '$senha', '$email')";
            $fk = "UPDATE Fazenda SET FK_cpf_Fazendeiro = '$cpf' WHERE nome_Fazenda = '$nome_Fazenda'";

            echo "<script>window.location.href = 'cadastroVeterinario.php';</script>";
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
   
        <p><h1>Cadastrar Fazendeiro</h1></p><br>
        <form action="cadastroFazendeiro.php" method="POST">
            <label>Nome:</label>             <!--adicionado atributo pattern para regex-->
            <input type="text" id="nome" name="nome_Fazendeiro" size="20" maxlength="20" pattern="[a-zA-Z\u00C0-\u00FF ]{10,100}$" required>
            <label>CPF:</label>
            <input type="text" name="cpf_Fazendeiro" size="20" maxlength="20" pattern="[0-9]{11}" required ><br><br>

            <label>Data de Nascimento:</label>
            <input type="date" name="dt_nascFazendeiro" size="20" maxlength="20" required>

            <label>Telefone:</label>            <!--adicionado atributo pattern para regex-->
            <input type="text" name="telefone_Fazendeiro" placeholder="(XX) XXXXX - XXXX" pattern="[0-9]{11}"  required><br><br>

            <label>Senha:</label>
            <input type="password" name="senha_Fazendeiro" required>

            <label>Confirmar senha: </label>
            <input type="password" pattern="^(?=.*[!@#$%^&*])(.{8,})$" required><br><br>

            <div class="btns">
                <button onclick= "limparCampos()" id="btn-cancelar" class="btn-cancelar">Cancelar</button>
                <a href="cadastroVeterinario.php"><button class="btn-cadastrar" type="submit" name="cadastrar">Cadastrar</button></a>
            </div>
        </form>
        <div>
            <div id="resultado"></div>
            <div id="mensagem-erro"></div>
        <footer>
            *Ao clicar  em Cadastrar, todas as informações digitadas<br>
             serão salvas, confira se os dados estão corretos.
        </footer>


        </div>
    </div>

    <script src="scripts/script.js">

        function gerarEmail() { //funcao que gera email
            var nomeCompleto = document.getElementById("nome").value;
            var primeiroNome = nomeCompleto.split(" ")[0];
            var ultimoNome = nomeCompleto.split(" ").pop();
            var nomeFazenda = document.getElementById("nome_fazenda").value;
            var email = primeiroNome + "." + ultimoNome + "@" + nomeFazenda + ".com.br";
            document.getElementById("resultado").innerHTML = "O endereço de e-mail é: " + email;
            alert("O endereço de e-mail é: " + email);
        }

        function validarFormulario() { //funcao q sinaliza erros nos campos de cadastro
            // Pega os valores dos inputs
            var nome = document.getElementById("nome").value;
            var cpf = document.getElementById("cpf").value;
            var nomeFazenda = document.getElementById("nome_fazenda").value;
            var dataNascimento = document.getElementById("date_nascimento").value;
            var telefone = document.getElementById("telefone").value;
            var senha = document.getElementById("senha").value;

            // Verifica se o campo nome não está vazio e tem pelo menos 3 caracteres
            if (nome == "" || nome.length < 3) {
                alert("Por favor, digite um nome válido.");
                return false;
            }

            // Verifica se o CPF tem 11 dígitos
            if (cpf == "" || cpf.length != 11) {
                alert("Por favor, digite um CPF válido.");
                return false;
            }

            // Verifica se o campo nome da fazenda não está vazio e tem pelo menos 3 caracteres
            if (nomeFazenda == "" || nomeFazenda.length < 3) {
                alert("Por favor, digite um nome de fazenda válido.");
                return false;
            }

            // Verifica se a data de nascimento é válida (não está no futuro)
            var dataAtual = new Date();
            var dataNasc = new Date(dataNascimento);
            if (dataNasc >= dataAtual) {
                alert("Por favor, digite uma data de nascimento válida.");
                return false;
            }

            // Verifica se o telefone tem pelo menos 10 dígitos
            if (telefone == "" || telefone.length < 10) {
                alert("Por favor, digite um telefone válido.");
                return false;
            }

            // Verifica se a senha tem pelo menos 6 caracteres
            if (senha == "" || senha.length < 6) {
                alert("Por favor, digite uma senha válida (pelo menos 6 caracteres).");
                return false;
            }

            // Se chegou até aqui, significa que todos os campos são válidos
            return true;
        }
    </script>
</body>

</html>