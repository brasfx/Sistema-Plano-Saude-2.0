<?php

function existePaciente($CPF)
{

  require_once __DIR__ . '/vendor/autoload.php';

$url = "mongodb+srv://davi:cruzeiro09@bootcampigti.rq8t9.mongodb.net/SistemaPlanoDeSaude?retryWrites=true&w=majority";
$connection = (new MongoDB\Client($url))->SistemaPlanoDeSaude->pacientes;
$findCPF = array("login"=> $CPF);
$result = $connection->findOne($findCPF);
$existe = false;

foreach($result as $doc){
 if($doc == $CPF){
   $existe = true;
 break;
 }
}

return $existe;
}

function incluiPaciente($CPF, $email, $telefone, $senha, $nome, $CEP, $endNum, $idade, $genero)
{

  require_once __DIR__ . '/vendor/autoload.php';
  try{
    if(!existeAdmin( $CPF)){
    $url = "mongodb+srv://davi:cruzeiro09@bootcampigti.rq8t9.mongodb.net/SistemaPlanoDeSaude?retryWrites=true&w=majority";
    $connection = (new MongoDB\Client($url))->SistemaPlanoDeSaude->pacientes;
    
    $inserePaciente = array("CPF"=> $CPF,"nome"=>$nome ,"email"=>$email,"senha"=>$senha,"idade"=>$idade,"genero"=>$genero,"telefone"=>$telefone,"endNum"=>$endNum,"CEP"=>$CEP);
    $connection->insertOne($inserePaciente);
  }
    echo ("Paciente inserido com sucesso!");
  }catch(MongoDB\Exception $error){
    die($error->getMessage());
  }

}

function mostraPaciente($CPF)
{
  require_once __DIR__ . '/vendor/autoload.php';
  $url = "mongodb+srv://davi:cruzeiro09@bootcampigti.rq8t9.mongodb.net/SistemaPlanoDeSaude?retryWrites=true&w=majority";
  $connection = (new MongoDB\Client($url))->SistemaPlanoDeSaude->pacientes;
  $query = array("CPF"=> $CPF);
  $result = $connection->find($query);
  
  foreach($result as $doc){
    if($CPF == $doc['CPF']){
      $doc['senha'];
      $doc['nome'];
      $doc['email'];
      $doc['telefone'];
      $doc['CEP'];
      $doc['endNum'];
      $doc['idade'];
      $doc['genero'];
  }
  return $doc;
}
 
}

function listaPacientes()
{
  $xml = new DOMDocument();
  libxml_use_internal_errors(true); //TOTALMENTE NECESSÁRIO, ÚTIL DESABILITAR SOMENTE PARA VER ERROS HUMANOS
  $arquivoxml = "../../db/pacientes.xml";
  $xml->load($arquivoxml);
  $busca = array();
  foreach ($xml->getElementsByTagName('paciente') as $paciente) {
    $CPF = $paciente->getAttribute('CPF');
    $busca[$CPF]['senha'] = $paciente->getAtribute('senha');
    $busca[$CPF]['nome'] = $paciente->getElementsByTagName('nome')[0]->nodeValue;
    $busca[$CPF]['email'] = $paciente->getElementsByTagName('email')[0]->nodeValue;
    $busca[$CPF]['telefone'] = $paciente->getElementsByTagName('telefone')[0]->nodeValue;
    $busca[$CPF]['CEP'] = $paciente->getElementsByTagName('CEP')[0]->nodeValue;
    $busca[$CPF]['endNum'] = $paciente->getElementsByTagName('endNum')[0]->nodeValue;
    $busca[$CPF]['idade'] = $paciente->getElementsByTagName('idade')[0]->nodeValue;
    $busca[$CPF]['genero'] = $paciente->getElementsByTagName('genero')[0]->nodeValue;
  }
  return $busca;
}
/*
CPF não se altera, é só para a busca, os demais, coloque os valores a serem atualizados
caso não queira atualizar um campo, deixe o respectivo parâmetro NULL (ñ é em branco)
 */
function alteraPaciente($CPF, $email, $senha, $telefone, $nome,$CEP, $endNum, $idade, $genero)
{
  require_once __DIR__ . '/vendor/autoload.php';
  try{
    $url = "mongodb+srv://davi:cruzeiro09@bootcampigti.rq8t9.mongodb.net/SistemaPlanoDeSaude?retryWrites=true&w=majority";
    $connection = (new MongoDB\Client($url))->SistemaPlanoDeSaude->pacientes;
    $filter = array('CPF'=>$CPF);
    $update = array('$set' => array("nome"=>$nome ,"email"=>$email,"senha"=>$senha,"idade"=>$idade,"genero"=>$genero,"telefone"=> $telefone,"endNum"=>$endNum,"CEP"=>$CEP));
    $query = $connection->findOneAndUpdate($filter,$update);
    echo ("Paciente atualizado com sucesso!");
  }catch(MongoDB\Exception $error){
    die($error->getMessage());
  }
  
}

function excluiPaciente($CPF)
{
  
require_once __DIR__ . '/vendor/autoload.php';
try {
$url = "mongodb+srv://davi:cruzeiro09@bootcampigti.rq8t9.mongodb.net/SistemaPlanoDeSaude?retryWrites=true&w=majority";
$connection = (new MongoDB\Client($url))->SistemaPlanoDeSaude->pacientes;
$filter = array('CPF'=>$CPF);
$query = $connection->findOneAndDelete($filter);
echo ("Paciente excluido com sucesso!");
} catch (MongoDB\Exception\InvalidArgumentException $error) {
  die($error);
}
 
}

function mostraPerfil($CPF)
{ // mostra dados do paciente
  $xml = new DOMDocument();
  $arquivoxml = "../../db/pacientes.xml";
  $xml->load($arquivoxml);
  $busca = array();
  $count = 0;
  foreach ($xml->getElementsByTagName('paciente') as $paciente) {
    if ($paciente->getAttribute('CPF') == $CPF) {
      $busca[$count]['nome'] = $paciente->getElementsByTagName('nome')[0]->nodeValue;
      $busca[$count]['email'] = $paciente->getElementsByTagName('email')[0]->nodeValue;
      $busca[$count]['telefone'] = $paciente->getElementsByTagName('telefone')[0]->nodeValue;
      $busca[$count]['CEP'] = $paciente->getElementsByTagName('CEP')[0]->nodeValue;
      $busca[$count]['endNum'] = $paciente->getElementsByTagName('endNum')[0]->nodeValue;
      $busca[$count]['idade'] = $paciente->getElementsByTagName('idade')[0]->nodeValue;
      $busca[$count]['genero'] = $paciente->getElementsByTagName('genero')[0]->nodeValue;
      $count++;
      // break;
    }
  }
  return $busca;
}
