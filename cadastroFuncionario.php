<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Funcionario</title>
    <link rel="stylesheet" type="text/css" href="/style/style_func.css">
</head>
<header>
    <img src="logo.png" width="180px">
</header>
<body>
    <?php
        include("conexao_agrocare.php")
        
    ?>
    <div class="cadastro">
   
        <p><h1>Cadastrar Funcionário da Fazenda</h1></p><br>
        <form action="cadastrar_fazendo.php" method="post">
            <label>Nome Completo:</label>             <!--adicionado atributo pattern para regex-->
            <input type="text" id="nome" name="nome" size="20" maxlength="20" pattern="[a-zA-Z\u00C0-\u00FF ]{10,100}$" required>
            <label>CPF:</label>
            <input type="text" name="cpf" size="20" maxlength="20" required><br><br>
            <!--adicionado input de nome da fazendo-->
            <label>Data de Nascimento:</label>
            <input type="date" name="date_nascimento" size="20" maxlength="20" required>

            <label>Telefone:</label>            <!--adicionado atributo pattern para regex-->
            <input type="text" name="telefone" placeholder="(XX) XXXXX - XXXX" pattern="^\d{4}-\d{3}-\d{4}$" required><br><br>

            <label>Senha:</label>
            <input type="password" name="senha" required>

            <label>Confirmar senha: </label>
            <input type="password" required><br><br>

            <div class="btns">
                <a href="../Login/index.html"><button id="btn-cancelar" class="btn-cancelar">Cancelar</button></a>
                <button onclick="gerarEmail()" class="btn-cadastrar" type="submit" name="cadastrar">Cadastrar</button>
            </div>
            <footer>
                *Ao clicar  em Cadastrar, todas as informações digitadas<br>
                 serão salvas, confira se os dados estão corretos.
            </footer>
            
        </form>
</body>
</html>