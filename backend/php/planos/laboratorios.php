<?php

function existeLaboratorio($CNPJ)
{

require_once __DIR__ . '/vendor/autoload.php';

$url = "mongodb+srv://davi:cruzeiro09@bootcampigti.rq8t9.mongodb.net/SistemaPlanoDeSaude?retryWrites=true&w=majority";
$connection = (new MongoDB\Client($url))->SistemaPlanoDeSaude->laboratorios;
$findCNPJ = array("CNPJ"=> $CNPJ);
$result = $connection->findOne($findCNPJ);
$existe = false;

foreach($result as $doc){
 if($doc == $CRM){
   $existe = true;
 break;
 }
}
  // $xml = new DOMDocument();
  // libxml_use_internal_errors(true); //TOTALMENTE NECESSÁRIO, ÚTIL DESABILITAR SOMENTE PARA VER ERROS HUMANOS
  // $arquivoxml = "../../db/laboratorios.xml";
  // $xml->load($arquivoxml);
  // $existe = FALSE;
  // foreach ($xml->getElementsByTagName('laboratorio') as $laboratorio) {
  //   if ($laboratorio->getAttribute('CNPJ') == $CNPJ) {
  //     $existe = TRUE;
  //     break;
  //   }
  // }
  // return $existe;
}

function incluiLaboratorio($CNPJ, $email, $telefone, $senha, $nome, $CEP, $endNum, $exametipos)
{

  require_once __DIR__ . '/vendor/autoload.php';
  try{
    if(!existeMedico( $CNPJ)){
    $url = "mongodb+srv://davi:cruzeiro09@bootcampigti.rq8t9.mongodb.net/SistemaPlanoDeSaude?retryWrites=true&w=majority";
    $connection = (new MongoDB\Client($url))->SistemaPlanoDeSaude->laboratorios;
    
    $insereLab = array("CNPJ"=> $CNPJ ,"senha"=>$senha,"nome"=>$nome,"email"=>$email,"telefone"=>$telefone,"examestipos"=>$exametipos,"endNum"=>$endNum,"CEP"=>$CEP);
    $connection->insertOne($insereLab);
  }
    echo ("Laboratorio inserido com sucesso!");
  }catch(MongoDB\Exception $error){
    die($error->getMessage());
  }
  // echo "goo";
  // if (!existeLaboratorio($CNPJ)) {
  //   $arquivoxml = "../../db/laboratorios.xml";
  //   $xml = new DOMDocument();
  //   $xml->load($arquivoxml);
  //   $laboratorios = $xml->getElementsByTagName('laboratorios')[0];
  //   $laboratorio = $laboratorios->appendChild(new DOMElement('laboratorio'));
  //   $xml->save($arquivoxml);
  //   $laboratorio->setAttribute('CNPJ', $CNPJ);
  //   $laboratorio->setAttribute('senha', $senha);
  //   $laboratorio->appendChild(new DOMElement('nome', $nome));
  //   $laboratorio->appendChild(new DOMElement('email', $email));
  //   $laboratorio->appendChild(new DOMElement('telefone', $telefone));
  //   $laboratorio->appendChild(new DOMElement('CEP', $CEP));
  //   $laboratorio->appendChild(new DOMElement('endNum', $endNum));
  //   $laboratorio->appendChild(new DOMElement('exametipos', $exametipos));
  //   $xml->save($arquivoxml);
  // }
}

function mostraLaboratorio($CNPJ)
{
  require_once __DIR__ . '/vendor/autoload.php';
  $url = "mongodb+srv://davi:cruzeiro09@bootcampigti.rq8t9.mongodb.net/SistemaPlanoDeSaude?retryWrites=true&w=majority";
  $connection = (new MongoDB\Client($url))->SistemaPlanoDeSaude->laboratorios;
  $query = array("CNPJ"=> $CNPJ);
  $result = $connection->find($query);
  
  foreach($result as $doc){
    if($CNPJ == $doc['CNPJ']){
      $doc['senha'];
      $doc['nome'];
      $doc['email'];
      $doc['telefone'];
      $doc['CEP'];
      $doc['endNum'];
      $doc['examestipos'];
  }
  return $doc;
}
  // $xml = new DOMDocument();
  // libxml_use_internal_errors(true); //TOTALMENTE NECESSÁRIO, ÚTIL DESABILITAR SOMENTE PARA VER ERROS HUMANOS
  // $arquivoxml = "../../db/laboratorios.xml";
  // $xml->load($arquivoxml);
  // $busca = array();
  // foreach ($xml->getElementsByTagName('laboratorio') as $laboratorio) {
  //   if ($laboratorio->getAttribute('CNPJ') == $CNPJ) {
  //     $busca['senha'] = $laboratorio->getAttribute('senha');
  //     $busca['nome'] = $laboratorio->getElementsByTagName('nome')[0]->nodeValue;
  //     $busca['email'] = $laboratorio->getElementsByTagName('email')[0]->nodeValue;
  //     $busca['telefone'] = $laboratorio->getElementsByTagName('telefone')[0]->nodeValue;
  //     $busca['CEP'] = $laboratorio->getElementsByTagName('CEP')[0]->nodeValue;
  //     $busca['endNum'] = $laboratorio->getElementsByTagName('endNum')[0]->nodeValue;
  //     $busca['exametipos'] = $laboratorio->getElementsByTagName('exametipos')[0]->nodeValue;
  //     break;
  //   }
  // }
  // return $busca;
}

function listaLaboratorios()
{
  $xml = new DOMDocument();
  libxml_use_internal_errors(true); //TOTALMENTE NECESSÁRIO, ÚTIL DESABILITAR SOMENTE PARA VER ERROS HUMANOS
  $arquivoxml = "../../db/laboratorios.xml";
  $xml->load($arquivoxml);
  $busca = array();
  foreach ($xml->getElementsByTagName('laboratorio') as $laboratorio) {
    $CNPJ = $laboratorio->getAttribute('CNPJ');
    $busca[$CNPJ]['senha'] = $laboratorio->getAttribute('senha');
    $busca[$CNPJ]['nome'] = $laboratorio->getElementsByTagName('nome')[0]->nodeValue;
    $busca[$CNPJ]['email'] = $laboratorio->getElementsByTagName('email')[0]->nodeValue;
    $busca[$CNPJ]['telefone'] = $laboratorio->getElementsByTagName('telefone')[0]->nodeValue;
    $busca[$CNPJ]['CEP'] = $laboratorio->getElementsByTagName('CEP')[0]->nodeValue;
    $busca[$CNPJ]['endNum'] = $laboratorio->getElementsByTagName('endNum')[0]->nodeValue;
    $busca[$CNPJ]['exametipos'] = $laboratorio->getElementsByTagName('exametipos')[0]->nodeValue;
  }
  return $busca;
}
/*
CNPJ não se altera, é só para a busca, os demais, coloque os valores a serem atualizados
caso não queira atualizar um campo, deixe o respectivo parâmetro NULL (ñ é em branco)
 */
function alteraLaboratorio($CNPJ, $email, $senha, $telefone, $nome, $CEP, $endNum, $exametipos)
{

  require_once __DIR__ . '/vendor/autoload.php';
  try{
    $url = "mongodb+srv://davi:cruzeiro09@bootcampigti.rq8t9.mongodb.net/SistemaPlanoDeSaude?retryWrites=true&w=majority";
    $connection = (new MongoDB\Client($url))->SistemaPlanoDeSaude->laboratorios;
    $filter = array("CNPJ"=> $CNPJ);
    $update = array('$set' => array("senha"=>$senha,"nome"=>$nome,"email"=>$email,"telefone"=>$telefone,"examestipos"=>$exametipos,"endNum"=>$endNum,"CEP"=>$CEP));
    $query = $connection->findOneAndUpdate($filter,$update);
    echo ("Laboratorio atualizado com sucesso!");
  }catch(MongoDB\Exception $error){
    die($error->getMessage());
  }
  // $xml = new DOMDocument();
  // libxml_use_internal_errors(true); //TOTALMENTE NECESSÁRIO, ÚTIL DESABILITAR SOMENTE PARA VER ERROS HUMANOS
  // $arquivoxml = "../../db/laboratorios.xml";
  // $xml->load($arquivoxml);
  // foreach ($xml->getElementsByTagName('laboratorio') as $laboratorio) {
  //   if ($laboratorio->getAttribute('CNPJ') == $CNPJ) {
  //     /*verifica o que vai entrar de dados antigos ou atuais*/
  //     $senha = ($senha ? $senha : $laboratorio->getAttribute('senha'));
  //     $nome = ($nome ? $nome : $laboratorio->getElementsByTagName('nome')[0]->nodeValue);
  //     $email = ($email ? $email : $laboratorio->getElementsByTagName('email')[0]->nodeValue);
  //     $telefone = ($telefone ? $telefone : $laboratorio->getElementsByTagName('telefone')[0]->nodeValue);
  //     $CEP = ($CEP ? $CEP : $laboratorio->getElementsByTagName('CEP')[0]->nodeValue);
  //     $endNum = ($endNum ? $endNum : $laboratorio->getElementsByTagName('endNum')[0]->nodeValue);
  //     $exametipos = ($exametipos ? $exametipos : $laboratorio->getElementsByTagName('exametipos')[0]->nodeValue);
  //     /*repopula o elemento laboratorio com a decisão anterior*/
  //     $laboratorioatualizado = $xml->createElement('laboratorio');
  //     $laboratorioatualizado->setAttribute('CNPJ', $CNPJ);
  //     $laboratorioatualizado->setAttribute('senha', $senha);
  //     $laboratorioatualizado->appendChild(new DOMElement('nome', $nome));
  //     $laboratorioatualizado->appendChild(new DOMElement('email', $email));
  //     $laboratorioatualizado->appendChild(new DOMElement('telefone', $telefone));
  //     $laboratorioatualizado->appendChild(new DOMElement('CEP', $CEP));
  //     $laboratorioatualizado->appendChild(new DOMElement('endNum', $endNum));
  //     $laboratorioatualizado->appendChild(new DOMElement('exametipos', $exametipos));
  //     $laboratorio->parentNode->replaceChild($laboratorioatualizado, $laboratorio);
  //     $xml->save($arquivoxml);
  //     break;
  //   }
  // }
}

function excluiLaboratorio($CNPJ)
{

  require_once __DIR__ . '/vendor/autoload.php';
  try {
  $url = "mongodb+srv://davi:cruzeiro09@bootcampigti.rq8t9.mongodb.net/SistemaPlanoDeSaude?retryWrites=true&w=majority";
  $connection = (new MongoDB\Client($url))->SistemaPlanoDeSaude->laboratorios;
  $filter = array('CNPJ'=>$CNPJ);
  $query = $connection->findOneAndDelete($filter);
  echo ("Laboratorio excluido com sucesso!");
  } catch (MongoDB\Exception\InvalidArgumentException $error) {
    die($error);
  }
  // $xml = new DOMDocument();
  // libxml_use_internal_errors(true); //TOTALMENTE NECESSÁRIO, ÚTIL DESABILITAR SOMENTE PARA VER ERROS HUMANOS
  // $arquivoxml = "../../db/laboratorios.xml";
  // $xml->load($arquivoxml);
  // foreach ($xml->getElementsByTagName('laboratorio') as $laboratorio) {
  //   if ($laboratorio->getAttribute('CNPJ') == $CNPJ) {
  //     $parent = $laboratorio->parentNode;
  //     $parent->removeChild($laboratorio);
  //     break;
  //   }
  // }
  // $xml->save($arquivoxml);
}
