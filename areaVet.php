<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/areaVet.css">
    <title>Inseminação</title>
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
                    echo "<script>alert('Número Identificador: " . $row['num_ID_Vaca'] . " - Inseminação Confirmada')</script>";
                    echo "</div>";
                }
            } else{
                echo "<script>alert('Vaca não encontrada no sistema, tente outro ID')</script>";
            }
        } 
        if (!empty($_GET['search'])) {
            $data = $_GET['search'];
        
            // Consulta SQL para obter a vaca correspondente ao número identificador
            $sql = "SELECT * FROM Vaca WHERE num_ID_Vaca LIKE '%$data' ORDER BY num_ID_Vaca DESC";
            $result = $connectbd->query($sql);
        
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    // Obtenha o ID da vaca
                    $id_vaca = $row['num_ID_Vaca'];
        
                    // Atualize o campo de inseminação da vaca adicionando +1
                    $string = "Inseminação Realizada";
                    $sql_update = "UPDATE Vaca SET estado_Inseminação = '$string' WHERE num_ID_Vaca = '$id_vaca'";
                    $connectbd->query($sql_update);
                }
            } 
        }
    ?>


    <div class="header">
        <h1>Veterinário</h1>
        <img src="img/vaca.png" class="imagem-vaca" width="110px">
        <button class="menu-button" id="menuButton"></button>
            <div class="menu-box" id="menuBox">
                <ul>
                    <li><a href="areaVet.php">Voltar</a></li>
                    <li><a href="login.php">Sair</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="main">
        <div class="inputs">
            <h2>Inseminação de Vacas</h2>
            <form mehtod = "GET" action= "areaVet.php">
                <div class="box1">
                    <label>N° Identificador:</label>
                    <input type="search"class = "form-control w-25" id ="pesquisar" name= "search" size="30" placeholder="ID da Vaca que será Inseminada" pattern="[0-9]{3}" maxlength="10" required><br>
                    <button oncanplay ="searchData()" id="btn-buscar" class="btn-buscar">Buscar</button>
                </div>
            </form>
            <form>
                <div class="box1">
                    <footer>*Ao informar o ID da vaca e Realizar a busca, você estará confirmando a realização da Inseminação</footer>
                </div>
            </form>
        </div>
        <script src="scripts/scriptCadVacas.js"></script>
</body>
</html>
