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
  <li class="active"><a href="relation">負責人專區</a></li>
</ul>
<ul class="nav nav-tabs">
  <li><a href="list.php">報名狀況</a></li>
  <li class="active"><a href="relation.php">大相認</a></li>
</ul>
<div class="muted">上面是下面的小天使，往下照顧</div>
<table class="table table-bordered no-wrap">
	<thead>
		<tr>
			<th>#</th>
			<th width="150">姓名</th>
			<th></th>
			<th>學號</th>
		</tr>
	</thead>
	<tbody>
<?php
$result=qMysql("select final.id, final.angel_id, register.fbid, register.realname, register.gender, register.stuid, register.nickname_new, register.nickname FROM final, register WHERE final.angel_id=register.fbid ORDER BY id ASC;");
while($row = mysql_fetch_array($result)){
    $rows[] = $row;}
    $last=sizeof($rows);
    $count=0;
foreach($rows as $row){
	echo '<tr><td>'.$row['id'].'</td><td><a href="http://www.facebook.com/profile.php?id='.$row['fbid'].'">'.htmlspecialchars($row['realname']).'</a> (';
	if($row['nickname_new']){
		echo $row['nickname_new'];
	}else{
		echo $row['nickname'];
	}
	echo ')</td><td>'.gender_trans($row['gender']).'</td><td>'.$row['stuid'].'</td></tr>';
}
?>
</tbody></table>
<?php
include './lib/footer.php';
}
?>