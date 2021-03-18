<?php
session_start();
if (isset($_POST["CRM"], $_POST["senha"])) {
  // print_r($_POST);
  if (!empty($_POST["CRM"]) && !empty($_POST["senha"])) {
    require_once __DIR__ . '/vendor/autoload.php';
    $url = "mongodb+srv://davi:cruzeiro09@bootcampigti.rq8t9.mongodb.net/SistemaPlanoDeSaude?retryWrites=true&w=majority";
    $connection = (new MongoDB\Client($url))->SistemaPlanoDeSaude->medicos;
    $login = $_POST["CRM"];
    $senha = $_POST["senha"];
  
    $query = array("CRM"=> $login,"senha"=>$senha);
    $result = $connection->find($query);
    
    foreach($result as $doc){
      if($login == $doc['CRM'] && $senha == $doc['senha']){
        $_SESSION['tipo'] = "MED";
        $_SESSION['CRM'] = $_POST["CRM"];
        header("location: ./starter_med.php");
    }
  }
   
  }if($login != $doc['CRM'] || $senha != $doc['senha']){
    header("location: ./login_med.html");
  }
} else {
  include "login_med.html";
}
