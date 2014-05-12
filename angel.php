<?php
require './lib/facebook.php';
require './lib/library.php';

if (!$user) {
  header("Location: ".$loginUrl);
}

$linkActive=1;
include './lib/header.php';
?>
<ul class="nav nav-tabs">
  <li class=""><a href="join.php">報名</a></li>
  <li><a href="master.php">照顧小主人</a></li>
  <li class="active"><a href="angel.php">小天使現身</a></li>
  <?php
  if(isAdmin($user)){
    echo '<li><a href="list.php">負責人專區</a></li>';
  }
  ?>
</ul>
<?php
/*
if(!isAdmin($user)){
	die();
}
*/
    $str="SELECT * FROM mapping,register WHERE mapping.angel=register.fbid AND mapping.master_id='".$user."';";
    $result=qMysql($str);
    $record=mysql_fetch_array($result);
    if($record[0]==''){
    	echo '<h4>Sorry~你沒有報名參加這次的活動噢!</h4>';
    }else{
//    	echo '<pre>';
//    	print_r($record);
?>
<h4>關於我的小天使</h4>
<div class="row-fluid">
<div class="span2">
<img class="img-circle" width="100px" src="https://graph.facebook.com/<?php echo $record['angel'];?>/picture?type=large&width=100&height=100" alt="">
</div>
<div class="span4">
<h5><a href="https://www.facebook.com/profile.php?id=<?php echo $record['angel'];?>" target="_blank" title="<?php echo $record['realname'];?>"><?php echo $record['fbname'];?></a></h5>
<p>性別: <?php echo gender_trans($record['gender']);?><br>
綽號: <?php if($record['nickname_new']){
        echo $record['nickname_new'];
      }else{
        echo $record['nickname'];
      }
      ?><br>
系級: <?php echo substr($record['stuid'],0,3);?></p>
</div>
</div>
<?php
}
include './lib/footer.php';
?>