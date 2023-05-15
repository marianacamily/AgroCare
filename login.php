<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta lang="pt-br">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style_login.css">
    <title>Login Agrocare</title>
</head>
<body>
<?php
    if(isset($_POST['submit'])){
        session_start();
                    // Verificar o valor do input radio recebido
        $funcao = $_POST['função'];
        $email = $_POST['usuario'];
        $senha = $_POST['senha'];


        $servername = "localhost";
        $username = "agrocare";
        $password = " ";
        $database = "agrocarefinal";

        // Crie uma conexão com o banco de dados
        $conn = new mysqli($servername, $username, $password, $database);
    
        // Verifique se ocorreu um erro na conexão
        if ($conn->connect_error) {
            die("Falha na conexão: " . $conn->connect_error);
        }

        // Realizar a consulta no banco de dados correspondente
        if ($funcao === 'Fazendeiro') {
            // Consulta na tabela dos Fazendeiro
            
                // Crie a consulta SQL
            $sql = "SELECT * FROM Fazendeiro WHERE email_Fazendeiro = '$email' AND senha_Fazendeiro = '$senha'";
                // Executa a consulta
            $resultado = $conn->query($sql);
                
                // Verifica se houve um erro na consulta
            if (!$resultado) {
                die("Erro na consulta: " . $conn->error);
            }

            } elseif ($funcao === 'Veterinário') {
            // Consulta na tabela dos veterinários
                // Crie a consulta SQL
                $sql = "SELECT * FROM Veterinário WHERE email_Vet = '$email' AND senha_Vet = '$senha'";
                // Executa a consulta
                $resultado = $conn->query($sql);
                            
                // Verifica se houve um erro na consulta
                if (!$resultado) {
                die("Erro na consulta: " . $conn->error);
                }
            } elseif ($funcao === 'Funcionário') {
            // Consulta na tabela dos auxiliar
                // Crie a consulta SQL
                $sql = "SELECT * FROM Funcionário WHERE email_Func = '$email' AND senha_Func = '$senha'";
                // Executa a consulta
                $resultado = $conn->query($sql);
                echo"login bem-sucedido!";
                            
                // Verifica se houve um erro na consulta
                if (!$resultado) {
                die("Erro na consulta: " . $conn->error);
                }
        }

        // Verifica o número de linhas retornadas pelo resultado da consulta
        if (mysqli_num_rows($resultado) == 1) {

            // Iniciar a sessão (se já não estiver iniciada)
            session_start();
            $_SESSION['usuario'] = $email;

            // Dados validados
            echo "Dados validados! Redirecionando...";
            // Definir variáveis de sessão para armazenar informações do usuário logado
            echo "<script>window.location.href = 'telaPrincipal.php';</script>";
            exit;

            $_SESSION['usuario'] = $email;

        } else {
            //combinacao de email e senha invalida
            echo "combinacao de email e senha invalida.!";
        }

        $conn->close();
    }
?>

<div class="main-login"> <!-- div de todo o login -->
        <div class="left-login"> <!-- div da parte esquerda do container inteiro de todo o login-->
            <img src="img/agrocare.png" class="imagem1" alt="Logo agrocare branca">
            <img src="img/vaca.png" class="imagem2" alt="Vaca logo agrocare branca">
        </div>
        <div class="right-login"> <!-- div da parte esquerda do container inteiro de todo o login-->
            <div class="card-login">
                <form action="login.php" method = "POST" class= "form col" id= "form-el">
                    <h1>LOGIN</h1>
                    <p>Escolha sua função:</p>
                    <div >
                        <input type="radio" id="Fazendeiro" name="função" value="Fazendeiro" required>
                        <label for="Fazendeiro">Fazendeiro</label>
                        <input type="radio" id="Veterinário" name="função" value="Veterinário" required>
                        <label for="Veterinário">Veterinário</label>
                        <input type="radio" id="Funcionário" name="função" value="Funcionário" required>
                        <label for="Funcionário">Funcionário</label>
                    </div>
                    <div class="texto-login">
                        <label for="usuario">Email:</label>
                        <input type="text" name="usuario" placeholder="Digite seu email" required>
                    </div>
                    <div class="senha-login">
                        <label for="senha">Senha:</label>
                        <input type="password" name="senha" placeholder="Digite sua senha" required>
                    </div>
                    <div class= "center">
                        <button id="login-button" class="btn" type="submit" name="submit">Entrar</button> 
                    </div>
                    <div>
                        <p>Não possui sua Fazenda cadastrada? Cadastre-se <a href="cadastroFazenda.php" class="button-link" >aqui.</a></p>
                    </div>
                </form> 
            </div>
        </div>
    </div>

    <script>


        const btn = document.querySelector(".btn");
        const formEl = document.querySelector(".form");

        var position;


        btn.addEventListener("mouseover", function () {

        if (!formEl.checkValidity()) {
            position ? (position = 0) : (position = 100);

            btn.style.transform = `translate(${position}px, 0px)`;
            btn.style.transition = "all 0.3s ease";
        } else {
            return;
        }
        });


        btn.addEventListener("click", function () {
        e.preventDefault();
        alert("welldone");
        });

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