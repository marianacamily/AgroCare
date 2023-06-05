<?php
    if (!empty($_GET['email_Fazendeiro']))
    {
        $email = $_GET['email-Fazendeiro'];
    
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
        

        if (isset($_POST['update']))
        {
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
    }




    /*  if(!empty($_GET['email_Fazendeiro'])) {
            $email = $_GET['email_Fazendeiro'];

            $sql = "SELECT * FROM Fazendeiro WHERE email_Fazendeiro = $email";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($user_data = $result->fetch_assoc()){
                    $nome = $user_data["nome_Fazendeiro"];
                    $cpf = $user_data["cpf_Fazendeiro"];
                    $dt_nasc = $user_data["dt_nascFazendeiro"];
                    $telefone = $user_data["telefone_Fazendeiro"];
                    $senha = $user_data["senha_Fazendeiro"];
                    $senha_teste = $user_data["senha_teste"];
                }
                echo $nome;
            }
        } */
?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>editar Fazendeiro</title>
    <link rel="stylesheet"  type="text/css" href="style/style_fazendeiro.css">
</head>
<header>
   <img src="img/Logo1.png" width="180px">
</header>
<body>
    <div class="cadastro">
   
        <p><h1>editar Fazendeiro</h1></p><br>
        <form action="editar.php" method="POST" id="cadastroForm">
            <label>Nome:</label>             <!--adicionado atributo pattern para regex-->
            <input type="text" id="nome" name="nome_Fazendeiro" placeholder="Digite seu nome completo" size="50" maxlength="20" pattern="[a-zA-Z\u00C0-\u00FF ]{10,100}$" value = "<?php echo $nome ?>" required>
            <label>CPF:</label>
            <input type="text" name="cpf_Fazendeiro"  placeholder="Digite apenas os números" size="20" maxlength="20" pattern="[0-9]{11}" value = "<?php echo $cpf ?>" required ><br><br>

            <label>Data de Nascimento:</label>
            <input type="date" name="dt_nascFazendeiro" size="20" maxlength="20" value = "<?php echo $dt_nasc ?>" required>

            <label>Telefone:</label>            <!--adicionado atributo pattern para regex-->
            <input type="text" name="telefone_Fazendeiro" placeholder="Digite apenas os números" pattern="[0-9]{11}" value = "<?php echo $telefone ?>"  required><br><br>

            <label>Senha:</label>
            <input type="password" id="senhaT" name="senha_teste" placeholder="Crie uma Senha" required>
            <label>*Pelo menos 8 caracteres, 1 deles sendo especial.<label><br>

            <label>Confirmar senha: </label>
            <input type="password" onchange ="validarSenhas()" id= "senhaF" name="senha_Fazendeiro" placeholder="Confirme sua Senha" pattern="^(?=.*[!@#$%^&*])(.{8,})$" required><br><br>
            
            <div class="btns">
                <button onclick= "limparCampos()" id="btn-cancelar" class="btn-cancelar">Cancelar</button>
                <a href="telaPrincipal.php"><button id= "btn" class="btn-cadastrar" type="update" name="update">alterar</button></a>
            </div>
            <input type="hidden" name=email_Fazendeiro value <?php echo $email?>>
        </form>
    </div>

    <script src="scripts/script.js">
        function validarSenhas() {
        var senha = document.getElementById('senhaT').value;
        var confirmarSenha = document.getElementById('senhaF').value;
        var botao = document.getElementById('btn');

        if (senha !== confirmarSenha) {
            alert('As senhas não coincidem. Por favor, verifique novamente.');
            botao.disabled = true; // Desabilita o botão
            return false;
        }

        botao.disabled = false; // Habilita o botão
        return true;
        }

    </script>
</body>

</html>