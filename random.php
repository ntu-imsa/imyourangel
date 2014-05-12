<?php
die();
require './lib/facebook.php';
require './lib/library.php';

$result=qMysql("SELECT fbid FROM register WHERE gender='female';");
while($row = mysql_fetch_array($result)){
    $female[] = $row;}
$result=qMysql("SELECT fbid FROM register WHERE gender='male';");
while($row = mysql_fetch_array($result)){
    $male[] = $row;}

for($i=0;$i<=18;$i++){
	$mkey=array_rand($male);
	echo $male[$mkey]['fbid'].',male<br>';
	unset($male[$mkey]);
	$fkey=array_rand($female);
	echo $female[$fkey]['fbid'].',female<br>';
	unset($female[$fkey]);
	$mkey=array_rand($male);
	echo $male[$mkey]['fbid'].',male<br>';
	unset($male[$mkey]);
}

echo '<br><pre>';
print_r($male);
print_r($female);

?>