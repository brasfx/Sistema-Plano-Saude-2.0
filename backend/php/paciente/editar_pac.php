<?php
session_start();
if (isset($_SESSION['tipo'])) {
  if ($_SESSION['tipo'] != "PAC") {
    header("location: login_pac.php");
  }
} else {
  header("location: login_pac.php");
}
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Editar paciente</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" type="text/css" href="../../../frontend/css/cadastro.css" />

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css" />
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body>

<nav class="nav-extended">
    <div></div>
    <div class="nav-wrapper">
      <a href="./starter_pac.php" class="brand-logo"><img src="../../../frontend/img/logo.png" /></a>
      <ul class="right hide-on-med-and-down">
        <li><a href="./starter_pac.php">Inicio</a></li>
        <li><a class="dropdown-trigger" href="#!" data-target="dropdown-perfil">Perfil<i class="material-icons right">arrow_drop_down</i></a></li>

        <li><a class="dropdown-trigger" href="#!" data-target="dropdown">Consultas<i class="material-icons right">arrow_drop_down</i></a></li>
        <li>
          <a style="display: flex; flex-direction: row" href="../../../home.html">
            <i class="material-icons">exit_to_app</i>Logout</a>
        </li>
      </ul>
    </div>
    <ul id="dropdown" class="dropdown-content">
      <li><a href="./exibir_consultas_pac.php">Ver consulta</a></li>
      <li><a href="./exibir_exames_pac.php">Ver exame</a></li>
    </ul>
    <ul id="dropdown-perfil" class="dropdown-content">
      <li><a href="./exibir_perfil_pac.php">Ver perfil</a></li>
      <li><a href="./editar_pac.php">Editar perfil</a></li>
    </ul>
    <div class="nav-content">
      <span class="nav-title"></span>

    </div>
  </nav>

  <div class="content-wrapper">

    <div class="medico">
      <div class="input-field col s12">

        <h5>Meu cadastro</h5>
        <div id="login-page" class="row">
          <div class="col s12 z-depth-2 card-panel">
          <form class="login-form" action="../../php/planos/funcao.php" method="post" onsubmit="return formPac(this)">
              <div class="row">
                <div class="input-field col s12">
                  <i class="material-icons prefix">person_outline</i>
                  <input class="validate" id="nome" type="text" name="nome" required />
                  <label for="nome" data-error="wrong" data-success="right">Nome</label>
                </div>
              </div>
              <div class="row">
                <div class="input-field col s12">
                  <i class="material-icons prefix">subtitles</i>
                  <input class="validate" id="CPF" type="text" name="CPF" required />
                  <label for="CPF" data-error="wrong" data-success="right">CPF</label>
                </div>
              </div>
              <div class="row">
                <div class="input-field col s12">
                  <i class="material-icons prefix">loupe</i>
                  <input class="validate" id="idade" type="number" name="idade" required />
                  <label for="idade" data-error="wrong" data-success="right">Idade</label>
                </div>
              </div>
              <div class="row">
                <div class="input-field col s12">
                  <i class="material-icons prefix">face</i>
                  <input class="validate" id="genero" type="text" name="genero" required />
                  <label for="genero" data-error="wrong" data-success="right">Gênero</label>
                </div>
              </div>
              <div class="row">
                <div class="input-field col s12">
                  <i class="material-icons prefix">phone</i>
                  <input class="validate" id="telefone" type="number" name="telefone" required />
                  <label for="telefone" data-error="wrong" data-success="right">Telefone</label>
                </div>
              </div>
              <div class="row">
                <div class="input-field col s12">
                  <i class="material-icons prefix">room</i>
                  <input class="validate" id="CEP" type="number" name="CEP" required />
                  <label for="CEP" data-error="wrong" data-success="right">CEP</label>
                </div>
              </div>
              <div class="row">
                <div class="input-field col s12">
                  <i class="material-icons prefix">home</i>
                  <input class="validate" id="endNum" type="text" name="endNum" required />
                  <label for="endNum" data-error="wrong" data-success="right">Endereço</label>
                </div>
              </div>

              <div class="row">
                <div class="input-field col s12">
                  <i class="material-icons prefix">mail_outline</i>
                  <input class="validate" id="email" type="email" name="email" required />
                  <label for="email" data-error="wrong" data-success="right">Email</label>
                </div>
              </div>
              <div class="row">
                <div class="input-field col s12">
                  <i class="material-icons prefix">lock_outline</i>
                  <input class="validate" id="senha" type="password" name="senha" required />
                  <label for="senha">Senha</label>
                </div>
              </div>

              <div class="row">
                <div class="input-field col s12">
                  <input type="hidden" name="acao" value="alteraPaciente">
                  <button type="submit" class="btn waves-effect waves-light">Enviar</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>

    </div>

    <!-- REQUIRED JS SCRIPTS -->

    <!-- jQuery 3 -->
    <script src="jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="../../js/buttonsEffect.js"></script>
    <script src="../../js/validaForm.js"></script>

</body>

</html>