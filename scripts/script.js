function limpa_form() {
    window.addEventListener('load', function() {
        var campo1 = document.getElementById('nome');
        var campo2 = document.getElementById('senha');

        // Limpa o valor de cada campo
        campo1.value = '';
        campo2.value = '';
    });
}


function gerarEmail() { //funcao que gera email
    var nomeCompleto = document.getElementById("nome").value;
    var primeiroNome = nomeCompleto.split(" ")[0];
    var ultimoNome = nomeCompleto.split(" ").pop();
    var nomeFazenda = document.getElementById("nome_fazenda").value;
    var email = primeiroNome + "." + ultimoNome + "@" + nomeFazenda + ".com.br";
    document.getElementById("resultado").innerHTML = "O endereço de e-mail é: " + email;
    alert("O endereço de e-mail é: " + email);
}

function limparCampos() {
    // Obtém todos os inputs do formulário
    var inputs = document.getElementsByTagName('input');
  
    // Percorre os inputs e limpa o conteúdo
    for (var i = 0; i < inputs.length; i++) {
      if (inputs[i].type === 'text' || inputs[i].type === 'password') {
        inputs[i].value = '';
      }
    }
  }

  
  function gerarEmail() {
    var nomeCompleto = document.getElementById("nome").value;
    var primeiroNome = nomeCompleto.split(" ")[0];
    var ultimoNome = nomeCompleto.split(" ").pop();
    var nomeFazenda = document.getElementById("nome_fazenda").value;
    var email = primeiroNome + "." + ultimoNome + "@" + nomeFazenda + ".com.br";
    document.getElementById("resultado").innerHTML = "O endereço de e-mail é: " + email;

    // Criar objeto XMLHttpRequest
    var xhr = new XMLHttpRequest();

    // Definir a URL do arquivo PHP que receberá os dados
    var url = "cadastroFazendeiro.php";

    // Definir os dados a serem enviados
    var data = "email=" + encodeURIComponent(email);

    // Configurar a requisição
    xhr.open("POST", url, true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    // Definir a função de callback para tratar a resposta do servidor
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            alert(xhr.responseText);
            // Aqui você pode fazer algo com a resposta do servidor, se necessário
        }
    };

    // Enviar a requisição
    xhr.send(data);
}

