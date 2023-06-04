<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/areaVet.css">
    <title>Área do Veterinário</title>
</head>
<body>
    <div class="header">
        <h1>Veterinário</h1>
        <img src="vaca.png" class="imagem-vaca" width="110px">
        <button class="menu-button" id="menuButton"></button>
            <div class="menu-box" id="menuBox">
                <ul>
                    <li><a href="areaVet.php">Sair</a></li>
                    <li><a href="javascript:history.back()">Voltar</a></li>
                    <li><a href="login.php">Sair</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="main">
        <div class="inputs">
            <h2>Inseminação de Vacas</h2>
            <form>
                <div class="box1">
                    <label>N° Identificador:</label>
                    <input type="text" name= "pesquisar_Vaca" size="21" placeholder="Digite o ID da Vaca" pattern="[0-9]{3}" maxlength="10" required><br>
                    <button onclick="" id="btn-buscar" class="btn-buscar">Buscar</button>
                </div>
            </form>
            <form>
                <div class="box1">
                    <label>Vaca: </label><br><br>
                    <label>Será realizada a Inseminação?</label><br><br>
                    <input type="button" class="btn-sim" name="botaosim" id="botaosim" value="Realizar Inseminação"><br>
                    <input type="button" class="btn-nao" name="botaonao" id="botaonao" value="Não Realizar Inseminação"><br>
                    <footer>*Ao clicar em alguma dessas opções será confirmado a execução/não execução do procedimento na vaca</footer>
                </div>
            </form>
        </div>
        <script src="scripts/scriptCadVacas.js"></script>
</body>
</html>
