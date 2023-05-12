<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta lang="pt-br">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/style/style_login.css">
    <title>Login Agrocare</title>
</head>
<body>
    <?php
    if(isset($_POST['submit'])){
                    // Verificar o valor do input radio recebido
        $funcao = $_POST['funcao'];
        $email = $_POST['usuario'];
        $senha = $_POST['senha'];

        // faça a conexão com o banco de dados
        $connectbd = mysqli_connect('localhost', 'agrocare', '', 'agrocarefinal') or die(mysqli_error($connectbd));
        // Verifique se ocorreu algum erro na conexão
        if ($connectbd->connect_error) {
            die("Erro na conexão: " . $connectbd->connect_error);
        }

        // Realizar a consulta no banco de dados correspondente
        if ($funcao === 'fazendeiro') {
            // Consulta na tabela dos fazendeiro
            
                // Crie a consulta SQL
            $sql = "SELECT * FROM [Fazendeiro] WHERE email_Fazendeiro = '$email' AND senha_Fazendeiro = '$senha'";
                // Executa a consulta
            $resultado = $connectbd->query($sql);
                
                // Verifica se houve um erro na consulta
            if (!$resultado) {
                die("Erro na consulta: " . $connectbd->error);
            }

            } elseif ($funcao === 'veterinario') {
            // Consulta na tabela dos veterinários
                // Crie a consulta SQL
                $sql = "SELECT * FROM [Veterinário] WHERE email_Vet = '$email' AND senha_Vet = '$senha'";
                // Executa a consulta
                $resultado = $connectbd->query($sql);
                            
                // Verifica se houve um erro na consulta
                if (!$resultado) {
                die("Erro na consulta: " . $connectbd->error);
                }
            } elseif ($funcao === 'auxiliar') {
            // Consulta na tabela dos auxiliar
                // Crie a consulta SQL
                $sql = "SELECT * FROM [Funcionário] WHERE email_Func = '$email' AND senha_Func = '$senha'";
                // Executa a consulta
                $resultado = $connectbd->query($sql);
                            
                // Verifica se houve um erro na consulta
                if (!$resultado) {
                die("Erro na consulta: " . $connectbd->error);
                }
        }
        // Verifica se houve um erro na consulta
        if (!$resultado) {
            die("Erro na consulta: " . $connectbd->error);
        }

        // Verifica o número de linhas retornadas pelo resultado da consulta
        if (mysqli_num_rows($resultado) == 1) {
            //login bem-sucedido
            echo"login bem-sucedido!";

            // Iniciar a sessão (se já não estiver iniciada)
            session_start();

            // Definir variáveis de sessão para armazenar informações do usuário logado
            $_SESSION['usuario'] = $email;

        } else {
            //combinacao de email e senha invalida
            echo "combinacao de email e senha invalida.!";
        }

        $connectbd->close();
    }
    ?>

    <div class="main-login"> <!-- div de todo o login -->
        <div class="left-login"> <!-- div da parte esquerda do container inteiro de todo o login-->
            <img src="/img/agrocare.png" class="imagem1" alt="Logo agrocare branca">
            <img src="/img/vaca.png" class="imagem2" alt="Vaca logo agrocare branca">
        </div>
        <div class="right-login"> <!-- div da parte esquerda do container inteiro de todo o login-->
                <div class="card-login">
                <form action="index.php" method = "POST">
                    <h1>LOGIN</h1>
                    <p>Escolha sua função:</p>
                    <div style="width: 350px;">
                        <input type="radio" id="fazendeiro" name="funcao" value="fazendeiro" required>
                        <label for="fazendeiro">Fazendeiro</label>
                        <input type="radio" id="veterinario" name="funcao" value="veterinario" required>
                        <label for="veterinario">Veterinário</label>
                        <input type="radio" id="funcionario" name="funcao" value="funcionario" required>
                        <label for="auxiliar">Funcinário</label>
                    </div>
                    <div class="texto-login">
                        <label for="usuario">Email:</label>
                        <input type="email" id="email" name="usuario" placeholder="Digite seu email" required>
                    </div>
                    <div class="senha-login">
                        <label for="senha">Senha:</label>
                        <input type="password" id="password" name="senha" placeholder="Digite sua senha" required>
                    </div>
                    <a href=".#"><button id="login-button" class="btn-login" type="submit" name="submit">Entrar</button></a>
                    <div>
                        <p>Não possui sua Fazenda cadastrada? Cadastre-se <a href="/cadastroFazendeiro.php" class="button-link" >aqui.</a></p>
                    </div>
                </form>
                </div>
        </div>
    </div>

    <script>
        const loginButton = document.getElementById('login-button');
        const emailInput = document.getElementById('email');

        const passwordInput = document.getElementById('password');

        function validateEmail(email) {
            // RegEx para validar formato de e-mail
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return emailRegex.test(email);
        }

        function validatePassword(password) {
            // Validar tamanho da senha
            return password.length >= 6;
        }

        function handleClick () {
            const email = emailInput.value.trim();
            const password = passwordInput.value.trim();
            if (email === "" || passowrd === "" || !validateEmail(email)) {
                loginButton.classList.add('invalid');
            } else {
                loginButton.classList.remove('invalid');
            }
        }
        loginButton.addEventListener("click", handleClick);

        emailInput.addEventListener('input', function() {
            if(!validateEmail(emailInput.value.trim())) {
                loginButton.classList.add('invalid');
            }else {
                loginButton.classList.remove("invalid")
            }
        });
        passwordInput.addEventListener("input", function () {
            if (emailInput.value.trim() === "" || passwordInput.value.trim() === "" || !isValidEmail(emailInput.value.trim())) {
                loginBtn.classList.add("error");
            } else {
                loginBtn.classList.remove("error");
            }
        });
        function validateForm() {
            const email = emailInput.value;
            const password = passwordInput.value;

            if (!validateEmail(email) || !validatePassword(password)) {
                loginButton.classList.add('invalid');
            } else {
                loginButton.classList.remove('invalid');
            }
        }
        // Adiciona evento de validação a cada vez que um input é alterado
        emailInput.addEventListener('input', validateForm);
        passwordInput.addEventListener('input', validateForm);

        // Capturar o valor do input radio selecionado
        var radios = document.getElementsByName('funcao');
        var funcaoSelecionado = '';
        for (var i = 0; i < radios.length; i++) {
        if (radios[i].checked) {
            funcaoSelecionado = radios[i].value;
            break;
        }}
        // Adicionar o valor selecionado como um parâmetro no formulário
        var form = document.querySelector('form');
        form.addEventListener('submit', function() {
        var inputFuncao = document.createElement('input');
        inputFuncao.type = 'hidden';
        inputFuncao.name = 'funcao';
        inputFuncao.value = funcaoSelecionado;
        form.appendChild(inputFuncao);
        });
    </script>
</body>
</html>