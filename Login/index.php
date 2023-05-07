<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta lang="pt-br">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Login Agrocare</title>
</head>
<body>
    <?php
    if(isset($_POST['submit'])){
        $funcao = $_POST['funcao'];
        $email = $_POST['usuario'];
        $senha = $_POST['senha'];

        // faça a conexão com o banco de dados
        $conn = mysqli_connect('localhost', 'usuario', 'senha', 'nome_do_banco') or die(mysqli_error($conn));

        // insira os valores na tabela de login
        $sql = "INSERT INTO login (funcao, email, senha) VALUES ('$funcao', '$email', '$senha')";
        $resultado = mysqli_query($conn, $sql) or die(mysqli_error($sql));

    if (mysqli_query($conn, $sql)) {
        echo "Dados cadastrados com sucesso!";
    } else {
        echo "Erro ao cadastrar os dados: " . mysqli_error($conn);
    }}

    ?>

    <div class="main-login"> <!-- div de todo o login -->
        <div class="left-login"> <!-- div da parte esquerda do container inteiro de todo o login-->
            <img src="agrocare.png" class="imagem1" alt="Logo agrocare branca">
            <img src="vaca.png" class="imagem2" alt="Vaca logo agrocare branca">
        </div>
        <div class="right-login"> <!-- div da parte esquerda do container inteiro de todo o login-->
            <div class="card-login">
                <h1>LOGIN</h1>
                <p>Escolha sua função:</p>
                <div style="width: 350px;">
                    <input type="radio" id="fazendeiro" name="funcao" value="fazendeiro" required>
                    <label for="fazendeiro">Fazendeiro</label>
                    <input type="radio" id="veterinario" name="funcao" value="veterinario" required>
                    <label for="veterinario">Veterinário</label>
                    <input type="radio" id="auxiliar" name="funcao" value="auxiliar" required>
                    <label for="auxiliar">Auxiliar</label>
                </div>
                <div class="texto-login">
                    <label for="usuario">Email:</label>
                    <input type="email" id="email" name="usuario" placeholder="Digite seu email" required>
                </div>
                <div class="senha-login">
                    <label for="senha">Senha:</label>
                    <input type="password" id="password" name="senha" placeholder="Digite sua senha" required>
                </div>
                <a href="../CadastroFazendeiro/index.php"><button id="login-button" class="btn-login" type="submit" name="submit">Entrar</button></a>
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
    </script>
</body>
</html>