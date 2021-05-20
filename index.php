<?php
class Kod {
  public $txt = [];
  public $NewFileName = '';
  public function StrKod(){

  while (($buffer = fgets($this->txt)) !== false) 
  {
    $mass[] = $buffer;
  }
  return $mass;
 }
 public function Kod2(){
  for ($i = 0; $i < count($this->txt); $i++){
      fwrite($this->NewFileName, $this->txt[$i]);
  }
 }
}

$kod = new Kod();
$kod->txt = fopen('kod1.php', 'r');

$buffer = $kod->StrKod();

fclose($kod->txt);
$obj = new ArrayObject( $buffer );
$it = $obj->getIterator();

foreach ($it as $key=>$val)
{
  $pos1 = stripos($val, "description");
  $pos2 = stripos($val, "<title");
  $pos3 = stripos($val, "keywords");

if($pos1 || $pos2 || $pos3)
{
$val1 = strip_tags($val);
print_r($key." : ".$val1); //показывает где мета тэги
$obj->offsetSet($key, $val1);
}
}
echo '<br>';
$kod->NewFileName = fopen('kod2.php', 'w');
$kod->txt = $it;
$kod->Kod2();
//просмотр результата:
include 'kod2.php';