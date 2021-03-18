<?php

// function existeExame($CPF){
//   $xml = new DOMDocument();
//   libxml_use_internal_errors(true); //TOTALMENTE NECESSÁRIO, ÚTIL DESABILITAR SOMENTE PARA VER ERROS HUMANOS
//   $arquivoxml = "../DB/exames.xml";
//   $xml->load($arquivoxml);
//   $existe=FALSE;
//   foreach ($xml->getElementsByTagName('exame') as $exame) {
//     if ($exame->getAttribute('CPF')==$CPF) {
//       $existe=TRUE;
//       break;
//     }
//   }
//   return $existe;
// }

function incluiExame($CPF, $CNPJ, $data, $tipoExame, $resultado)
{
  require_once __DIR__ . '/vendor/autoload.php';
  try{
    $url = "mongodb+srv://davi:cruzeiro09@bootcampigti.rq8t9.mongodb.net/SistemaPlanoDeSaude?retryWrites=true&w=majority";
    $connection = (new MongoDB\Client($url))->SistemaPlanoDeSaude->exames;
    
    $insereExame = array("CPF"=>$CPF,"CNPJ"=> $CNPJ ,"data"=>$data,"tipoExame"=>$tipoExame,"resultado"=>$resultado);
    $connection->insertOne($insereExame);
    echo ("Exame inserida com sucesso!");
  }catch(MongoDB\Exception $error){
    die($error->getMessage());
  }
 
}

function mostraExameLAB($CNPJ)
{ // exames por laboratorio
  require_once __DIR__ . '/vendor/autoload.php';
  $url = "mongodb+srv://davi:cruzeiro09@bootcampigti.rq8t9.mongodb.net/SistemaPlanoDeSaude?retryWrites=true&w=majority";
  $connection = (new MongoDB\Client($url))->SistemaPlanoDeSaude->exames;
  $query = array("CNPJ"=> $CNPJ);
  $result = $connection->find($query);
  $busca = array();
  $count = 0;
  foreach($result as $doc){
    
    if($CNPJ == $doc['CNPJ']){
      $busca[$count]['CPF']=$doc['CPF'];
      $busca[$count]['data']=$doc['data'];
      $busca[$count]['resultado']=$doc['resultado'];
      $busca[$count]['tipoExame']=$doc['tipoExame'];
      $count++;
  }
  //echo 'console.log('. json_encode( $doc ) .')';
 
}
return $busca;
 
}

function mostraExamePAC($CPF)
{ // exames por paciente
  require_once __DIR__ . '/vendor/autoload.php';
  $url = "mongodb+srv://davi:cruzeiro09@bootcampigti.rq8t9.mongodb.net/SistemaPlanoDeSaude?retryWrites=true&w=majority";
  $connection = (new MongoDB\Client($url))->SistemaPlanoDeSaude->exames;
  $query = array("CPF"=> $CPF);
  $result = $connection->find($query);
  $busca = array();
  $count = 0;
  
  foreach($result as $doc){
    
    if($CPF == $doc['CPF']){
      $busca[$count]['CNPJ']=$doc['CNPJ'];
      $busca[$count]['data']=$doc['data'];
      $busca[$count]['resultado']=$doc['resultado'];
      $busca[$count]['tipoExame']=$doc['tipoExame'];
      $count++;
  }
  //echo 'console.log('. json_encode( $doc ) .')';
}
return $busca;
 
}

function listaExames()
{
  $xml = new DOMDocument();
  libxml_use_internal_errors(true); //TOTALMENTE NECESSÁRIO, ÚTIL DESABILITAR SOMENTE PARA VER ERROS HUMANOS
  $arquivoxml = "../../db/exames.xml";
  $xml->load($arquivoxml);
  $busca = array();
  foreach ($xml->getElementsByTagName('exame') as $exame) {
    $CPF = $exame->getAttribute('CPF');
    $busca[$CPF]['resultado'] = $exame->getElementsByTagName('resultado')[0]->nodeValue;
    $busca[$CPF]['CNPJ'] = $exame->getElementsByTagName('CNPJ')[0]->nodeValue;
    $busca[$CPF]['tipoExame'] = $exame->getElementsByTagName('tipoExame')[0]->nodeValue;
    $busca[$CPF]['data'] = $exame->getElementsByTagName('data')[0]->nodeValue;
  }
  return $busca;
}
/*
CPF não se altera, é só para a busca, os demais, coloque os valores a serem atualizados
caso não queira atualizar um campo, deixe o respectivo parâmetro NULL (ñ é em branco)
 */
// function alteraExame($CPF, $CNPJ, $data, $tipoExame, $resultado){ // somente até duas horas depois
//   $xml = new DOMDocument();
//   libxml_use_internal_errors(true); //TOTALMENTE NECESSÁRIO, ÚTIL DESABILITAR SOMENTE PARA VER ERROS HUMANOS
//   $arquivoxml = "../DB/exames.xml";
//   $xml->load($arquivoxml);
//   foreach ($xml->getElementsByTagName('exame') as $exame) {
//     if ($exame->getAttribute('CPF')==$CPF) {
//       /*verifica o que vai entrar de dados antigos ou atuais*/
//       $CNPJ = ($CNPJ ? $CNPJ : $exame->getElementsByTagName('CNPJ')[0]->nodeValue);
//       $resultado = ($resultado ? $resultado : $exame->getElementsByTagName('resultado')[0]->nodeValue);
//       $tipoExame = ($tipoExame ? $tipoExame : $exame->getElementsByTagName('tipoExame')[0]->nodeValue);
//       $data = ($data ? $data : $exame->getElementsByTagName('data')[0]->nodeValue);
//       /*repopula o elemento Exame com a decisão anterior*/
//       $exameatualizado = $xml->createElement('exame');
//       $exameatualizado->setAttribute('CPF', $CPF);
//       $exameatualizado->setAttribute('CNPJ', $CNPJ);
//       $exameatualizado->appendChild(new DOMElement('resultado', $resultado));
//       $exameatualizado->appendChild(new DOMElement('tipoExame', $tipoExame));
//       $exameatualizado->appendChild(new DOMElement('data', $data));
//       $exame->parentNode->replaceChild($exameatualizado, $exame);
//       $xml->save($arquivoxml);
//       break;
//     }
//   }
// }
//
// function excluiExame($CPF){ // não ÚTIL por enquanto
//   $xml = new DOMDocument();
//   libxml_use_internal_errors(true); //TOTALMENTE NECESSÁRIO, ÚTIL DESABILITAR SOMENTE PARA VER ERROS HUMANOS
//   $arquivoxml = "../DB/exames.xml";
//   $xml->load($arquivoxml);
//   foreach ($xml->getElementsByTagName('exame') as $exame) {
//     if ($exame->getAttribute('CPF')==$CPF) {
//       $parent=$exame->parentNode;
//       $parent->removeChild($exame);
//       break;
//     }
//   }
//   $xml->save($arquivoxml);
// }

function filtraExameLab($CNPJ){

  require_once __DIR__ . '/vendor/autoload.php';
  $url = "mongodb+srv://davi:cruzeiro09@bootcampigti.rq8t9.mongodb.net/SistemaPlanoDeSaude?retryWrites=true&w=majority";
  $connection = (new MongoDB\Client($url))->SistemaPlanoDeSaude->exames;
  $query = array("CNPJ"=> $CNPJ);
  $result = $connection->count($query);
  
  return $result;
}
function filtraExamePaciente($CPF){

  require_once __DIR__ . '/vendor/autoload.php';
  $url = "mongodb+srv://davi:cruzeiro09@bootcampigti.rq8t9.mongodb.net/SistemaPlanoDeSaude?retryWrites=true&w=majority";
  $connection = (new MongoDB\Client($url))->SistemaPlanoDeSaude->exames;
  $query = array("CPF"=> $CPF);
  $result = $connection->count($query);
  
  return $result;
}