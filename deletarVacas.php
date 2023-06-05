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
            } else {
                $sql = "SELECT *FROM Vaca ORDER BY num_ID_Vaca DESC";
            }
            $result = $connectbd->query($sql);
    ?>

    <div class="header">
        <h1>Funcionário</h1>
        <img src="vaca.png" class="imagem-vaca" width="110px">
        <button class="menu-button" id="menuButton"></button>
            <div class="menu-box" id="menuBox">
                <ul>
                    <li><a href=cadastroVacas.php>Cadastrar Vacas</a></li>
                    <li><a href=deletarVacas.php>Deletar Vacas</a></li>
                    <li><a href="javascript:history.back()">Voltar</a></li>
                    <li><a href="login.php">Sair</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="main">
        <form action="deletarVacas.php" method ="GET">
            <div class="inputs">
                <h2>Deletar Vacas</h2>

                    <div class="box1">
                        <label>N° Identificador:</label>
                        <input type="search" id= "id" name= "search" size="21" placeholder="Digite o ID da Vaca" pattern="[0-9]{3}" maxlength="10" required><br>
                        <button oncanplay ="searchData()" id="btn-buscar" class="btn-buscar" >Buscar</button>
                    </div>
            <table class = "container">
                <thead>
                    <tr>
                        <th>num_ID_Vaca</th>
                        <th>raça_Vaca</th>
                        <th>excluir</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        include_once('bd/conexao_agrocare.php');

                        $sql = "SELECT * FROM Vaca";
                        $result =$connectbd->query($sql);

                        if(!$result) {
                            die("erro na consulta: " . $conn->error);
                        }
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row["num_ID_Vaca"] . "</td>";
                            echo "<td>" . $row["raça_Vaca"] . "</td>";
                            echo "<td>";
                            echo "<a href='excluir.php?id=" . $row['num_ID_Vaca'] . "'>excluir</a>";  // Link para a página de edição (passando o CPF como parâmetro)
                            echo "</td>";
                            echo "</tr>";
                        }
                    ?>
                </tbody>
            </table>
        </form>
    </div>
        <script src="scripts/scriptCadVacas.js">
            
        var search = document.getElementById('id');

        search.addEventListener("keydown", function(event) {
            if (event.key === "Enter") {
                searchData();
            }
        });
        function searchData();
        {
            window.location = 'areaVet.php?search='+search.value;
        }
        </script>
</body>
</html>
