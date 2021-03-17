<?php

function existeMedico($CRM)
{
  require_once __DIR__ . '/vendor/autoload.php';

$url = "mongodb+srv://davi:cruzeiro09@bootcampigti.rq8t9.mongodb.net/SistemaPlanoDeSaude?retryWrites=true&w=majority";
$connection = (new MongoDB\Client($url))->SistemaPlanoDeSaude->medicos;
$findCRM = array("CRM"=> $CRM);
$result = $connection->findOne($findCRM);
$existe = false;

foreach($result as $doc){
 if($doc == $CRM){
   $existe = true;
 break;
 }
}
  // $xml = new DOMDocument();
  // libxml_use_internal_errors(true); //TOTALMENTE NECESSÁRIO, ÚTIL DESABILITAR SOMENTE PARA VER ERROS HUMANOS
  // $arquivoxml = "../../db/medicos.xml";
  // $xml->load($arquivoxml);
  // $existe = FALSE;
  // foreach ($xml->getElementsByTagName('medico') as $medico) {
  //   if ($medico->getAttribute('CRM') == $CRM) {
  //     $existe = TRUE;
  //     break;
  //   }
  // }
  // return $existe;
}

function incluiMedico($CRM, $email,$telefone, $senha, $nome, $CEP, $endNum, $especialidade,$genero)
{

  require_once __DIR__ . '/vendor/autoload.php';
  try{
    if(!existeMedico( $CRM)){
    $url = "mongodb+srv://davi:cruzeiro09@bootcampigti.rq8t9.mongodb.net/SistemaPlanoDeSaude?retryWrites=true&w=majority";
    $connection = (new MongoDB\Client($url))->SistemaPlanoDeSaude->medicos;
    
    $insereMedico = array("CRM"=> $CRM ,"senha"=>$senha,"nome"=>$nome,"email"=>$email,"telefone"=>$telefone,"especialidade"=>$especialidade,"endNum"=>$endNum,"CEP"=>$CEP,"genero"=>$genero);
    $connection->insertOne($insereMedico);
  }
    echo ("Medico inserido com sucesso!");
  }catch(MongoDB\Exception $error){
    die($error->getMessage());
  }
  // if (!existeMedico($CRM)) {
  //   $arquivoxml = "../../db/medicos.xml";
  //   $xml = new DOMDocument();
  //   $xml->load($arquivoxml);
  //   $medicos = $xml->getElementsByTagName('medicos')[0];
  //   $medico = $medicos->appendChild(new DOMElement('medico'));
  //   $xml->save($arquivoxml);
  //   $medico->setAttribute('CRM', $CRM);
  //   $medico->setAttribute('senha', $senha);
  //   $medico->appendChild(new DOMElement('nome', $nome));
  //   $medico->appendChild(new DOMElement('email', $email));
  //   $medico->appendChild(new DOMElement('telefone', $telefone));
  //   $medico->appendChild(new DOMElement('CEP', $CEP));
  //   $medico->appendChild(new DOMElement('endNum', $endNum));
  //   $medico->appendChild(new DOMElement('especialidade', $especialidade));
  //   $xml->save($arquivoxml);
  // }
}

function mostraMedico($CRM)
{
  require_once __DIR__ . '/vendor/autoload.php';
  $url = "mongodb+srv://davi:cruzeiro09@bootcampigti.rq8t9.mongodb.net/SistemaPlanoDeSaude?retryWrites=true&w=majority";
  $connection = (new MongoDB\Client($url))->SistemaPlanoDeSaude->medicos;
  $query = array("CRM"=> $CRM);
  $result = $connection->find($query);
  
  foreach($result as $doc){
    if($CRM == $doc['CRM']){
      $doc['senha'];
      $doc['nome'];
      $doc['email'];
      $doc['telefone'];
      $doc['CEP'];
      $doc['endNum'];
      $doc['especialidade'];
      $doc['genero'];
  }
  return $doc;
}
  // $xml = new DOMDocument();
  // libxml_use_internal_errors(true); //TOTALMENTE NECESSÁRIO, ÚTIL DESABILITAR SOMENTE PARA VER ERROS HUMANOS
  // $arquivoxml = "../../db/medicos.xml";
  // $xml->load($arquivoxml);
  // $busca = array();
  // foreach ($xml->getElementsByTagName('medico') as $medico) {
  //   if ($medico->getAttribute('CRM') == $CRM) {
  //     $busca['senha'] = $medico->getAttribute('senha');
  //     $busca['email'] = $medico->getElementsByTagName('email')[0]->nodeValue;
  //     $busca['nome'] = $medico->getElementsByTagName('nome')[0]->nodeValue;
  //     $busca['telefone'] = $medico->getElementsByTagName('telefone')[0]->nodeValue;
  //     $busca['CEP'] = $medico->getElementsByTagName('CEP')[0]->nodeValue;
  //     $busca['endNum'] = $medico->getElementsByTagName('endNum')[0]->nodeValue;
  //     $busca['especialidade'] = $medico->getElementsByTagName('especialidade')[0]->nodeValue;
  //     break;
  //   }
  // }
  // return $busca;
}

function listaMedicos()
{
  $xml = new DOMDocument();
  libxml_use_internal_errors(true); //TOTALMENTE NECESSÁRIO, ÚTIL DESABILITAR SOMENTE PARA VER ERROS HUMANOS
  $arquivoxml = "../../db/medicos.xml";
  $xml->load($arquivoxml);
  $busca = array();
  foreach ($xml->getElementsByTagName('medico') as $medico) {
    $CRM = $medico->getAttribute('CRM');
    $busca[$CRM]['senha'] = $medico->getAttribute('senha');
    $busca[$CRM]['email'] = $medico->getElementsByTagName('email')[0]->nodeValue;
    $busca[$CRM]['nome'] = $medico->getElementsByTagName('nome')[0]->nodeValue;
    $busca[$CRM]['telefone'] = $medico->getElementsByTagName('telefone')[0]->nodeValue;
    $busca[$CRM]['CEP'] = $medico->getElementsByTagName('CEP')[0]->nodeValue;
    $busca[$CRM]['endNum'] = $medico->getElementsByTagName('endNum')[0]->nodeValue;
    $busca[$CRM]['especialidade'] = $medico->getElementsByTagName('especialidade')[0]->nodeValue;
  }
  return $busca;
}
/*
CRM não se altera, é só para a busca, os demais, coloque os valores a serem atualizados
caso não queira atualizar um campo, deixe o respectivo parâmetro NULL (ñ é em branco)
 */
function alteraMedico($CRM, $email,$senha,$telefone, $nome, $CEP, $endNum, $especialidade,$genero)
{

  require_once __DIR__ . '/vendor/autoload.php';
  try{
    $url = "mongodb+srv://davi:cruzeiro09@bootcampigti.rq8t9.mongodb.net/SistemaPlanoDeSaude?retryWrites=true&w=majority";
    $connection = (new MongoDB\Client($url))->SistemaPlanoDeSaude->medicos;
    $filter = array('CRM'=>$CRM);
    $update = array('$set' => array("senha"=>$senha,"nome"=>$nome,"email"=>$email,"telefone"=>$telefone,"especialidade"=>$especialidade,"endNum"=>$endNum,"CEP"=>$CEP,"genero"=>$genero));
    $query = $connection->findOneAndUpdate($filter,$update);
    echo ("Medico atualizado com sucesso!");
  }catch(MongoDB\Exception $error){
    die($error->getMessage());
  }
  // $xml = new DOMDocument();
  // libxml_use_internal_errors(true); //TOTALMENTE NECESSÁRIO, ÚTIL DESABILITAR SOMENTE PARA VER ERROS HUMANOS
  // $arquivoxml = "../../db/medicos.xml";
  // $xml->load($arquivoxml);
  // foreach ($xml->getElementsByTagName('medico') as $medico) {
  //   if ($medico->getAttribute('CRM') == $CRM) {
  //     /*verifica o que vai entrar de dados antigos ou atuais*/
  //     $senha = ($senha ? $senha : $medico->getAttribute('senha'));
  //     $email = ($email ? $email : $medico->getElementsByTagName('email')[0]->nodeValue);
  //     $nome = ($nome ? $nome : $medico->getElementsByTagName('nome')[0]->nodeValue);
  //     $telefone = ($telefone ? $telefone : $medico->getElementsByTagName('telefone')[0]->nodeValue);
  //     $CEP = ($CEP ? $CEP : $medico->getElementsByTagName('CEP')[0]->nodeValue);
  //     $endNum = ($endNum ? $endNum : $medico->getElementsByTagName('endNum')[0]->nodeValue);
  //     $especialidade = ($especialidade ? $especialidade : $medico->getElementsByTagName('especialidade')[0]->nodeValue);
  //     /*repopula o elemento Medico com a decisão anterior*/
  //     $medicoatualizado = $xml->createElement('medico');
  //     $medicoatualizado->setAttribute('CRM', $CRM);
  //     $medicoatualizado->setAttribute('senha', $senha);
  //     $medicoatualizado->appendChild(new DOMElement('nome', $nome));
  //     $medicoatualizado->appendChild(new DOMElement('email', $email));
  //     $medicoatualizado->appendChild(new DOMElement('telefone', $telefone));
  //     $medicoatualizado->appendChild(new DOMElement('CEP', $CEP));
  //     $medicoatualizado->appendChild(new DOMElement('endNum', $endNum));
  //     $medicoatualizado->appendChild(new DOMElement('especialidade', $especialidade));
  //     $medico->parentNode->replaceChild($medicoatualizado, $medico);
  //     $xml->save($arquivoxml);
  //     break;
  //   }
  // }
}

function excluiMedico($CRM)
{

  require_once __DIR__ . '/vendor/autoload.php';
try {
$url = "mongodb+srv://davi:cruzeiro09@bootcampigti.rq8t9.mongodb.net/SistemaPlanoDeSaude?retryWrites=true&w=majority";
$connection = (new MongoDB\Client($url))->SistemaPlanoDeSaude->medicos;
$filter = array('CRM'=>$CRM);
$query = $connection->findOneAndDelete($filter);
echo ("Medico excluido com sucesso!");
} catch (MongoDB\Exception\InvalidArgumentException $error) {
  die($error);
}
  // $xml = new DOMDocument();
  // libxml_use_internal_errors(true); //TOTALMENTE NECESSÁRIO, ÚTIL DESABILITAR SOMENTE PARA VER ERROS HUMANOS
  // $arquivoxml = "../../db/medicos.xml";
  // $xml->load($arquivoxml);
  // foreach ($xml->getElementsByTagName('medico') as $medico) {
  //   if ($medico->getAttribute('CRM') == $CRM) {
  //     $parent = $medico->parentNode;
  //     $parent->removeChild($medico);
  //     break;
  //   }
  // }
  // $xml->save($arquivoxml);
}


