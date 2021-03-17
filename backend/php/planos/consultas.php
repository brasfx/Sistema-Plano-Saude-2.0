<?php

// function existeConsulta($CPF){
//   $xml = new DOMDocument();
//   libxml_use_internal_errors(true); //TOTALMENTE NECESSÁRIO, ÚTIL DESABILITAR SOMENTE PARA VER ERROS HUMANOS
//   $arquivoxml = "../DB/consultas.xml";
//   $xml->load($arquivoxml);
//   $existe=FALSE;
//   foreach ($xml->getElementsByTagName('consulta') as $consulta) {
//     if ($consulta->getAttribute('CPF')==$CPF) {
//       $existe=TRUE;
//       break;
//     }
//   }
//   return $existe;
// }

function incluiConsulta($CPF, $CRM, $data, $receita, $observacoes)
{
  require_once __DIR__ . '/vendor/autoload.php';
  try{
    $url = "mongodb+srv://davi:cruzeiro09@bootcampigti.rq8t9.mongodb.net/SistemaPlanoDeSaude?retryWrites=true&w=majority";
    $connection = (new MongoDB\Client($url))->SistemaPlanoDeSaude->consultas;
    
    $insereConsulta = array("CPF"=>$CPF,"CRM"=> $CRM ,"data"=>$data,"receita"=>$receita,"observacoes"=>$observacoes);
    $connection->insertOne($insereConsulta);
    echo ("Consulta inserida com sucesso!");
  }catch(MongoDB\Exception $error){
    die($error->getMessage());
  }
  // if (!existeConsulta($CPF)) {
  // $arquivoxml = "../../db/consultas.xml";
  // $xml = new DOMDocument();
  // $xml->load($arquivoxml);
  // $consultas = $xml->getElementsByTagName('consultas')[0];
  // $consulta = $consultas->appendChild(new DOMElement('consulta'));
  // $xml->save($arquivoxml);
  // $consulta->setAttribute('CPF', $CPF);
  // $consulta->setAttribute('CRM', $CRM);
  // $consulta->appendChild(new DOMElement('data', $data));
  // $consulta->appendChild(new DOMElement('receita', $receita));
  // $consulta->appendChild(new DOMElement('observacoes', $observacoes));
  // $xml->save($arquivoxml);
  // }
}

function mostraConsultaPAC($CPF)
{ // consultas por paciente

  require_once __DIR__ . '/vendor/autoload.php';
  $url = "mongodb+srv://davi:cruzeiro09@bootcampigti.rq8t9.mongodb.net/SistemaPlanoDeSaude?retryWrites=true&w=majority";
  $connection = (new MongoDB\Client($url))->SistemaPlanoDeSaude->consultas;
  $query = array("CPF"=> $CPF);
  $result = $connection->find($query);
  $busca = array();
  $count = 0;
  foreach($result as $doc){
    if($CPF == $doc['CPF']){
      $busca[$count]['CRM'] = $doc['CRM'];
      $busca[$count]['data'] = $doc['data'];
      $busca[$count]['receita'] = $doc['receita'];
      $busca[$count]['observacoes'] = $doc['observacoes'];  
      $count++; 
  }
  //echo 'console.log('. json_encode( $doc ) .')';
  
}
return $busca;
  // $xml = new DOMDocument();
  // $arquivoxml = "../../db/consultas.xml";
  // $xml->load($arquivoxml);
  // $busca = array();
  // $count = 0;
  // foreach ($xml->getElementsByTagName('consulta') as $consulta) {
  //   if ($consulta->getAttribute('CPF') == $CPF) {
  //     $busca[$count]['CRM'] = $consulta->getAttribute('CRM');
  //     $busca[$count]['data'] = $consulta->getElementsByTagName('data')[0]->nodeValue;
  //     $busca[$count]['receita'] = $consulta->getElementsByTagName('receita')[0]->nodeValue;
  //     $busca[$count]['observacoes'] = $consulta->getElementsByTagName('observacoes')[0]->nodeValue;
  //     $count++;
  //     // break;
  //   }
  // }
  // return $busca;
}
function mostraConsultaMED($CRM)
{ // Econsultas por medico
  require_once __DIR__ . '/vendor/autoload.php';
  $url = "mongodb+srv://davi:cruzeiro09@bootcampigti.rq8t9.mongodb.net/SistemaPlanoDeSaude?retryWrites=true&w=majority";
  $connection = (new MongoDB\Client($url))->SistemaPlanoDeSaude->consultas;
  $query = array("CRM"=> $CRM);
  $result = $connection->find($query);
  $busca = array();
  $count=0;
  foreach($result as $doc){ 
    if($CRM == $doc['CRM']){
      $busca[$count]['CPF']=$doc['CPF'];
      $busca[$count]['data']=$doc['data'];
      $busca[$count]['receita']=$doc['receita'];
      $busca[$count]['observacoes']=$doc['observacoes'];
      $count++;
  }
  //echo 'console.log('. json_encode( $doc ) .')';
}
return $busca;
  // $xml = new DOMDocument();
  // libxml_use_internal_errors(true); //TOTALMENTE NECESSÁRIO, ÚTIL DESABILITAR SOMENTE PARA VER ERROS HUMANOS
  // $arquivoxml = "../../db/consultas.xml";
  // $xml->load($arquivoxml);
  // $busca = array();
  // $count = 0;
  // foreach ($xml->getElementsByTagName('consulta') as $consulta) {
  //   // echo $consulta->getAttribute('CRM');
  //   if ($consulta->getAttribute('CRM') == $CRM) {
  //     $busca[$count]['CPF'] = $consulta->getAttribute('CPF');
  //     $busca[$count]['data'] = $consulta->getElementsByTagName('data')[0]->nodeValue;
  //     $busca[$count]['receita'] = $consulta->getElementsByTagName('receita')[0]->nodeValue;
  //     $busca[$count]['observacoes'] = $consulta->getElementsByTagName('observacoes')[0]->nodeValue;
  //     $count++;
  //     // break;
  //   }
  // }
  // return $busca;
}

function filtraConsultaMedico($CRM){

  require_once __DIR__ . '/vendor/autoload.php';
  $url = "mongodb+srv://davi:cruzeiro09@bootcampigti.rq8t9.mongodb.net/SistemaPlanoDeSaude?retryWrites=true&w=majority";
  $connection = (new MongoDB\Client($url))->SistemaPlanoDeSaude->consultas;
  $query = array("CRM"=> $CRM);
  $result = $connection->count($query);
  
  return $result;
}

function filtraConsultaPaciente($CPF){

  require_once __DIR__ . '/vendor/autoload.php';
  $url = "mongodb+srv://davi:cruzeiro09@bootcampigti.rq8t9.mongodb.net/SistemaPlanoDeSaude?retryWrites=true&w=majority";
  $connection = (new MongoDB\Client($url))->SistemaPlanoDeSaude->consultas;
  $query = array("CPF"=> $CPF);
  $result = $connection->count($query);
  
  return $result;
}
