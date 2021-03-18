<?php
session_start();
if (isset($_POST["CPF"], $_POST["senha"])) {
  // print_r($_POST);
  if (!empty($_POST["CPF"]) && !empty($_POST["senha"])) {

    require_once __DIR__ . '/vendor/autoload.php';
    $url = "mongodb+srv://davi:cruzeiro09@bootcampigti.rq8t9.mongodb.net/SistemaPlanoDeSaude?retryWrites=true&w=majority";
    $connection = (new MongoDB\Client($url))->SistemaPlanoDeSaude->pacientes;
    $login = $_POST["CPF"];
    $senha = $_POST["senha"];
  
    $query = array("CPF"=> $login,"senha"=>$senha);
    $result = $connection->find($query);
    foreach($result as $doc){
      if($login == $doc['CPF'] && $senha == $doc['senha']){
        $_SESSION['tipo'] = "PAC";
        $_SESSION['CPF'] = $_POST["CPF"];
        header("location: ./starter_pac.php");
    }
  }
   
  }if($login != $doc['CPF'] || $senha != $doc['senha']){
    header("location: ./login_pac.html");
  }
} else {
  include "./login_pac.html";
}
