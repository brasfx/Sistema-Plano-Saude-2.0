<?php
session_start();
if (isset($_POST["login"], $_POST["senha"])) {
  // print_r($_POST);

if (!empty($_POST["login"]) && !empty($_POST["senha"])) {
  require_once __DIR__ . '/vendor/autoload.php';
  $url = "mongodb+srv://davi:cruzeiro09@bootcampigti.rq8t9.mongodb.net/SistemaPlanoDeSaude?retryWrites=true&w=majority";
  $connection = (new MongoDB\Client($url))->SistemaPlanoDeSaude->admin;
  $login = $_POST["login"];
  $senha = $_POST["senha"];

  $query = array("login"=> $login,"senha"=>$senha);
  $result = $connection->find($query);
  
  foreach($result as $doc){
    if($login == $doc['login'] && $senha == $doc['senha']){
      $_SESSION['tipo'] = "ADMIN";
      $_SESSION['nome'] = $doc['nome'];
      header("location: ./starter_admin.php");
      //echo 'console.log('. json_encode( $doc ) .')';
  }
}
  
//header("location: ./starter_admin.php");
}
    // $xml = new DOMDocument();
    // libxml_use_internal_errors(true); //TOTALMENTE NECESSÁRIO, ÚTIL DESABILITAR SOMENTE PARA VER ERROS HUMANOS
    // $arquivoxml = "../../db/admin.xml";
    // $xml->load($arquivoxml);
    // $busca = array();
    // foreach ($xml->getElementsByTagName('admin') as $admin) {
    //   if ($admin->getAttribute('login') == $_POST["login"] && $admin->getAttribute('senha') == $_POST["senha"]) {
    //     $_SESSION['tipo'] = "ADMIN";
    //     $_SESSION['nome'] = $admin->nodeValue;
    //     header("location: ./starter_admin.php");
    //   }
    // }
    //header("location: ./starter_admin.php");
  //}
} else {

  include "./login_admin.html";
}