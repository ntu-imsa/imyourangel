<?php
require './lib/facebook.php';
require './lib/library.php';

if (!$user) {
  header("Location: ".$loginUrl);
}
if(isAdmin($user)){
$linkActive=1;
include './lib/header.php';
?>
<ul class="nav nav-tabs">
  <li><a href="join.php">報名</a></li>
  <li><a href="master.php">照顧小主人</a></li>
  <li><a href="angel.php">小天使現身</a></li>
  <li class="active"><a href="list.php">負責人專區</a></li>
</ul>
<ul class="nav nav-tabs">
  <li class="active"><a href="list.php">報名狀況</a></li>
  <li><a href="relation.php">大相認</a></li>
</ul>
<?php
		$atteinding_list=array();
        $event = $facebook->api('/179117955617452/invited', 'GET');
		foreach($event['data'] as $invited_idv){
			if($invited_idv['rsvp_status']=="attending"){
				$attending_list[$invited_idv['id']]=$invited_idv['name'];
			}
		}
//		print_r($attending_list);
?>
<table class="table table-bordered no-wrap">
	<thead>
		<tr>
			<th>#</th>
			<th width="45">姓名</th>
			<th></th>
			<th>學號</th>
			<th>暱稱</th>
			<th>有空</th>
			<th>備註</th>
			<th>報名時間</th>
			<th width="40">f活動</th>
		</tr>
	</thead>
	<tbody>
<?php
$freshman=array();
for($i=1;$i<=50;$i++){
	$toSet="b027050";
	if($i<10){
		$toSet=$toSet."0";
	}
	$freshman[$toSet.$i]="";
}
$result=qMysql("SELECT * FROM register ORDER BY regtime DESC;");
while($row = mysql_fetch_array($result)){
    $rows[] = $row;}
    $last=sizeof($rows);
    $count=0;
foreach($rows as $row){
	echo '<tr><td>'.($last-$count).'</td><td><a href="http://www.facebook.com/profile.php?id='.$row['fbid'].'">'.htmlspecialchars($row['realname']).'</a></td><td>'.gender_trans($row['gender']).'</td><td>'.$row['stuid'].'</td><td>'.$row['nickname'].'</td><td>'.$row['available'].'</td><td>'.nl2br(htmlspecialchars($row['comments'])).'</td><td>'.$row['regtime'].'</td><td>';
	if(isset($attending_list[$row['fbid']])){
		echo 'O';
		unset($attending_list[$row['fbid']]);
	}
	if(isset($freshman[$row['stuid']])){
		unset($freshman[$row['stuid']]);
	}
	echo '</td></tr>';
	$count++;
}
?>
</tbody></table>
<div class="row-fluid">
<div class="span6">
<table class="table table-bordered"><thead><tr><th>按參加未報名</th></tr></thead><tbody>
<?php
foreach($attending_list as $fbid => $name){
	echo '<tr><td><a href="http://www.facebook.com/profile.php?id='.$fbid.'">'.$name.'</a></td></tr>';
}
?>
</tbody></table></div>
<div class="span6">
<table class="table table-bordered"><thead><tr><th>B02未報名</th></tr></thead><tbody>
<?php
foreach($freshman as $stuid => $k){
	echo '<tr><td>'.$stuid.'</td></tr>';
}
?>
</tbody></table>
</div>
</div>
<?php
include './lib/footer.php';
}
?>