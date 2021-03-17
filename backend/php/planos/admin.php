<?php
//verifica se o admin já existe
function existeAdmin($CPF)
{
require_once __DIR__ . '/vendor/autoload.php';

$url = "mongodb+srv://davi:cruzeiro09@bootcampigti.rq8t9.mongodb.net/SistemaPlanoDeSaude?retryWrites=true&w=majority";
$connection = (new MongoDB\Client($url))->SistemaPlanoDeSaude->admin;
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

  // $xml = new DOMDocument();
  // libxml_use_internal_errors(true); //TOTALMENTE NECESSÁRIO, ÚTIL DESABILITAR SOMENTE PARA VER ERROS HUMANOS
  // $arquivoxml = "../../db/admin.xml";
  // $xml->load($arquivoxml);
  // $existe = FALSE;
  // foreach ($xml->getElementsByTagName('admin') as $admin) {
  //   if ($admin->getAttribute('CPF') == $CPF) {
  //     $existe = TRUE;
  //     break;
  //   }
  // }
  // return $existe;
}
//cadastra um novo admin
function insereAdmin($CPF, $senha, $nome)
{

  require_once __DIR__ . '/vendor/autoload.php';
try{
  if(!existeAdmin( $CPF)){
  $url = "mongodb+srv://davi:cruzeiro09@bootcampigti.rq8t9.mongodb.net/SistemaPlanoDeSaude?retryWrites=true&w=majority";
  $connection = (new MongoDB\Client($url))->SistemaPlanoDeSaude->admin;
  
  $insereAdmin = array("login"=> $CPF ,"senha"=>$senha,"nome"=>$nome);
  $connection->insertOne($insereAdmin);
}
  echo ("Admin inserido com sucesso!");
}catch(MongoDB\Exception $error){
  die($error->getMessage());
}

}

function alteraAdmin($CPF, $senha, $nome)
{
  
  require_once __DIR__ . '/vendor/autoload.php';
try{
  $url = "mongodb+srv://davi:cruzeiro09@bootcampigti.rq8t9.mongodb.net/SistemaPlanoDeSaude?retryWrites=true&w=majority";
  $connection = (new MongoDB\Client($url))->SistemaPlanoDeSaude->admin;
  $filter = array('login'=>$CPF);
  $update = array('$set' => array('nome'=>$nome,'senha'=>$senha));
  $query = $connection->findOneAndUpdate($filter,$update);
  echo ("Admin inserido com sucesso!");
}catch(MongoDB\Exception $error){
  die($error->getMessage());
}


//   $xml = new DOMDocument();
//   libxml_use_internal_errors(true); //TOTALMENTE NECESSÁRIO, ÚTIL DESABILITAR SOMENTE PARA VER ERROS HUMANOS
//   $arquivoxml = "../../db/admin.xml";
//   $xml->load($arquivoxml);
//   foreach ($xml->getElementsByTagName('admin') as $admin) {
//     if ($admin->getAttribute('login') == $CPF) {
//       /*verifica o que vai entrar de dados antigos ou atuais*/
//       $senha = ($senha ? $senha : $admin->getAtribute('senha'));
//       $nome = ($nome ? $nome : $admin->getElementsByTagName('nome')[0]->nodeValue);
//       /*repopula o elemento Admin com a decisão anterior*/
//       $adminatualizado = $xml->createElement('admin');
//       $adminatualizado->setAttribute('login', $CPF);
//       $adminatualizado->setAttribute('senha', $senha);
//       $adminatualizado->appendChild(new DOMElement('nome', $nome));
//       $admin->parentNode->replaceChild($adminatualizado, $admin);
//       $xml->save($arquivoxml);
//       break;
//     }
//   }
}

function mostraAdmin($nome)
{
  require_once __DIR__ . '/vendor/autoload.php';
  try {
$url = "mongodb+srv://davi:cruzeiro09@bootcampigti.rq8t9.mongodb.net/SistemaPlanoDeSaude?retryWrites=true&w=majority";
$connection = (new MongoDB\Client($url))->SistemaPlanoDeSaude->admin;
$query = array("nome"=>$nome);
$result = $connection->find($query);
foreach($result as $doc){
  if($nome == $doc['nome']){
  $doc['nome'];
}
return $doc;
 }
 
  }catch(MongoDB\Exception $error){
    die($error->getMessage());
  }
  // $xml = new DOMDocument();
  // libxml_use_internal_errors(true); //TOTALMENTE NECESSÁRIO, ÚTIL DESABILITAR SOMENTE PARA VER ERROS HUMANOS
  // $arquivoxml = "../../db/admin.xml";
  // $xml->load($arquivoxml);
  // $busca = array();
  // foreach ($xml->getElementsByTagName('admin') as $admin) {
  //   if ($admin->getAttribute('login') == $CPF) {
  //     //$busca['senha'] = $admin->getAtribute('senha');
  //     $busca['nome'] = $admin->getElementsByTagName('nome')[0]->nodeValue;
  //     break;
  //   }
  // }
  // return $busca;
}

function countAdmin(){
  $url = "mongodb+srv://davi:cruzeiro09@bootcampigti.rq8t9.mongodb.net/SistemaPlanoDeSaude?retryWrites=true&w=majority";
$connection = (new MongoDB\Client($url))->SistemaPlanoDeSaude->admin;
$result = $connection->count();
return $result;
}
function countLab(){
  $url = "mongodb+srv://davi:cruzeiro09@bootcampigti.rq8t9.mongodb.net/SistemaPlanoDeSaude?retryWrites=true&w=majority";
$connection = (new MongoDB\Client($url))->SistemaPlanoDeSaude->laboratorios;
$result = $connection->count();
return $result;
}
function countMed(){
  $url = "mongodb+srv://davi:cruzeiro09@bootcampigti.rq8t9.mongodb.net/SistemaPlanoDeSaude?retryWrites=true&w=majority";
$connection = (new MongoDB\Client($url))->SistemaPlanoDeSaude->medicos;
$result = $connection->count();
return $result;
}
function countPac(){
  $url = "mongodb+srv://davi:cruzeiro09@bootcampigti.rq8t9.mongodb.net/SistemaPlanoDeSaude?retryWrites=true&w=majority";
$connection = (new MongoDB\Client($url))->SistemaPlanoDeSaude->pacientes;
$result = $connection->count();
return $result;
}