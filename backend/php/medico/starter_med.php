<?php
session_start();
if (isset($_SESSION['tipo'])) {
  if ($_SESSION['tipo'] != "MED") {
    header("location: login_med.php");
  }
} else {
  header("location: login_med.php");
}
include "../planos/medicos.php";
$medicos = mostraMedico($_SESSION['CRM']);
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Início Admin</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" type="text/css" href="../../../frontend/css/index.css" />

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css" />
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body>

  <nav class="nav-extended">
    <div></div>
    <div class="nav-wrapper">
      <a href="./starter_med.php" class="brand-logo"><img src="../../../frontend/img/logo.png" /></a>
      <ul class="right hide-on-med-and-down">
        <li><a href="./starter_med.php">Inicio</a></li>
        <li><a href="./exibir_consultas_med.php">Ver consultas</a></li>

        <li><a class="dropdown-trigger" href="#!" data-target="dropdown">Cadastro<i class="material-icons right">arrow_drop_down</i></a></li>
        <li>
          <a style="display: flex; flex-direction: row" href="../../../home.html">
            <i class="material-icons">exit_to_app</i>Logout</a>
        </li>
      </ul>
    </div>
    <ul id="dropdown" class="dropdown-content">
      <li><a href="./editar_med.php">Editar meu cadastro</a></li>
      <li><a href="./form_consultas.php">Adicionar consultas</a></li>
    </ul>
    <div class="nav-content">
      <span class="nav-title"></span>

    </div>
  </nav>
  <div class="center" style="font-size: 30px;margin-top:20px">
    <?php
    if($medicos['genero'] == 'Masculino' || $medicos['genero'] == 'masculino'){
    echo "<strong>Seja bem vindo ao nosso sistema, Dr. {$medicos['nome']}.";
  }else{
    echo "<strong>Seja bem vindo ao nosso sistema, Dra. {$medicos['nome']}.";
  }
    ?>
  </div>
  <!-- <div class="center z-depth-1  " style=";text-align:center; display: grid;
 placeontent: center;margin-top:100px ">
 <h5>Meus Dados</h5>
            <?php
         if($medicos != null){
          
           echo
             "
             <p>CRM: {$medicos['CRM']}</p>
             <p>{$medicos['nome']}</p>
             <p>{$medicos['especialidade']}</p>
             <p>{$medicos['email']}</p>
             <p>{$medicos['telefone']}</p>
             <p>{$medicos['endNum']}</p>
             <p>{$medicos['CEP']}</p>
             ";
           }
            ?>
          </table>
         
        </div> -->

  <!-- REQUIRED JS SCRIPTS -->

  <!-- jQuery 3 -->
  <script src="jquery-3.5.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
  <script src="../../js/buttonsEffect.js"></script>

</body>

</html>