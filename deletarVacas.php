<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/areaVet.css">
    <title>Deletar Vacas</title>
</head>
<body>

    <?php
        session_start();
        include_once('bd/conexao_agrocare.php');
        if((!isset($_SESSION['usuario']) == true) and (!isset($_SESSION['senha']) == true))
        {
            unset($_SESSION['usuario']);
            unset($_SESSION['senha']);
            header('location: login.php');
        }
        if(!empty($_GET['search'])) {

            $data = $_GET['search'];
            $sql = "SELECT * FROM Vaca WHERE num_ID_Vaca LIKE '%$data' ORDER BY num_ID_Vaca DESC";
            $result = $connectbd->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='dados-vaca'>";
                    echo "<script>alert('Número Identificador: " . $row['num_ID_Vaca'] . " - Remoção Realizada')</script>";
                    echo "</div>";
                }
            } else{
                echo "<script>alert('Vaca não encontrada no sistema, confira o Identificador informado.')</script>";
            }
        } 
        if (!empty($_GET['search'])) {
            $data = $_GET['search'];
        
            // Consulta SQL para obter a vaca correspondente ao número identificador
            $sql = "SELECT * FROM Vaca WHERE num_ID_Vaca LIKE '%$data' ORDER BY num_ID_Vaca DESC";
            $result = $connectbd->query($sql);
        
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $sql_update = "DELETE FROM Vaca WHERE num_ID_Vaca = '$data'";
                    $connectbd->query($sql_update);
                }
            } 
        }
    ?>


    <div class="header">
        <h1>Funcionário</h1>
        <img src="img/vaca.png" class="imagem-vaca" width="110px">
        <button class="menu-button" id="menuButton"></button>
            <div class="menu-box" id="menuBox">
                <ul>
                <li><a href=cadastroVacas.php>Cadastro de Vacas</a></li>
                    <li><a href="deletarVacas.php">Voltar</a></li>
                    <li><a href="login.php">Sair</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="main">
        <div class="inputs">
            <h2>Remover Vacas</h2>
            <form mehtod = "GET" action= "deletarVacas.php">
                <div class="box1">
                    <label>N° Identificador:</label>
                    <input type="search"class = "form-control w-25" id ="pesquisar" name= "search" size="30" placeholder="ID da Vaca que será Deletada" pattern="[0-9]{3}" maxlength="10" required><br>
                    <button oncanplay ="searchData()" id="btn-buscar" class="btn-buscar">Buscar</button>
                </div>
            </form>
            <form>
                <div class="box1">
                    <footer>*Ao informar a Identificação do Animal e Realizar a busca, você estará confirmando sua Remoção no sistema</footer>
                </div>
            </form>
        </div>
        <script src="scripts/scriptCadVacas.js"></script>
</body>
</html>
