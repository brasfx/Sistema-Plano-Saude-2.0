<?php
session_start();
if (isset($_POST["CNPJ"], $_POST["senha"])) {
  // print_r($_POST);
  if (!empty($_POST["CNPJ"]) && !empty($_POST["senha"])) {

    require_once __DIR__ . '/vendor/autoload.php';
    $url = "mongodb+srv://davi:cruzeiro09@bootcampigti.rq8t9.mongodb.net/SistemaPlanoDeSaude?retryWrites=true&w=majority";
    $connection = (new MongoDB\Client($url))->SistemaPlanoDeSaude->laboratorios;
    $login = $_POST["CNPJ"];
    $senha = $_POST["senha"];
  
    $query = array("CNPJ"=> $login,"senha"=>$senha);
    $result = $connection->find($query);
    
    foreach($result as $doc){
      if($login == $doc['CNPJ'] && $senha == $doc['senha']){
        $_SESSION['tipo'] = "LAB";
        $_SESSION['CNPJ'] = $_POST["CNPJ"];
        header("location: ./starter_lab.php");
    }
  }
    
  }if($login != $doc['CNPJ'] || $senha != $doc['senha']){
    header("location: ./login_lab.html");
  }
} else {

  include "./login_lab.html";
}
