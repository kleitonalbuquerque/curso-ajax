function buscaDados() {

  var nome   = document.getElementById('buscanome').value;
  var result = document.getElementById('dados');

  var ajax = new XMLHttpRequest();

  // Animação no carregamento dos dados
  result.innerHTML = '<center><img src="loading.gif" width="100px"></center>';

  ajax.open('GET', 'processa.php?buscanome=' + nome, true);

  ajax.onreadystatechange = function(){
    if(ajax.readyState == 4){
      if(ajax.status == 200){
        result.innerHTML = ajax.responseText
      } else {
        result.innerHTML = 'Houve um erro na conexão AJAX: ' + ajax.statusText;
      }
    }
  };

  ajax.send(null);

}

function insereDados() {
  // Dados de entrada do formulário
  var nome     = document.getElementById('insereNome').value;
  var email    = document.getElementById('insereEmail').value;
  var telefone = document.getElementById('insereTelefone').value;
  var endereco = document.getElementById('insereEndereco').value;

  var resposta = document.getElementById('resposta');

  var ajax = new XMLHttpRequest();

  // Animação no carregamento dos dados
  resposta.innerHTML = '<center><img src="loading.gif" width="100px"></center>';

  ajax.open("GET", "processa.php?nome="+nome+"&endereco="+endereco+"&telefone="+telefone+"&email="+email, true);

  ajax.onreadystatechange = function(){
    if(ajax.readyState == 4){
      if(ajax.status == 200){
        resposta.innerHTML = ajax.responseText;
      } else {
        resposta.innerHTML = 'Houve um erro na conexão AJAX: ' + ajax.statusText;
      }
    }
  };

  ajax.send(null);
  
}

function deletaUsuario(id){

  var result = document.getElementById('dados');

  var ajax = new XMLHttpRequest();

  // Animação no carregamento dos dados
  result.innerHTML = '<center><img src="loading.gif" width="100px"></center>';

  ajax.open("GET", "processa.php?deleta="+id, true);

  ajax.onreadystatechange = function(){
    if(ajax.readyState == 4){
      if(ajax.status == 200){
        result.innerHTML = ajax.responseText;
      } else {
        result.innerHTML = 'Houve um erro na conexão AJAX: ' + ajax.statusText;
      }
    }
  };

  ajax.send(null);  
}
