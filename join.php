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
  <li class="active"><a href="#">報名</a></li>
  <li><a href="master.php">照顧小主人</a></li>
  <li><a href="angel.php">小天使現身</a></li>
  <?php
  if(isAdmin($user)){
    echo '<li><a href="list.php">負責人專區</a></li>';
  }
  ?>
</ul>
<?php
if(!(isset($_POST['realname'])&&isset($_POST['nickname']))){
    $str="SELECT * FROM register WHERE fbid='".$user."';";
    $result=qMysql($str);
    $record=mysql_fetch_array($result);
    if($record[0]==''){
      echo '<h4>報名截止囉!詳情請洽負責人</h4>';
      die();
?>
<script type="text/javascript">
function checkForm(){
var msg="";
if(document.join.realname.value==''){
	msg+="記得填寫真實姓名喔!\n";
	}
if(document.join.stuid.value==''){
	msg+="記得填寫學號喔!\n";
	}
if(document.join.nickname.value==''){
	msg+="記得填寫綽號喔!\n";
	}
if(msg==""){
	document.join.submit();
	}else{
	alert(msg);
	}
}
</script>

        <form class="form-join" method="POST" action="join.php" name="join">
          <fieldset>
            <h4>2013 IM Your Angel 報名表單</h4>
        Facebook 帳號: <br>

        <div class="row-fluid">
          <div class="span2">
            <img class="thumbnail" src="https://graph.facebook.com/<?php echo $user; ?>/picture"><br>
          </div>
          <div class="span7">
          <input type="text" value="<?php echo htmlspecialchars($user_profile['name']);?>" readonly><br>            
          </div>
        </div>
        <label>真實姓名: <input name="realname" type="text" class="input-block-level" value="<?php echo htmlspecialchars($user_profile['name']);?>"></label>
        <label>學號: <input name="stuid" type="text" class="input-block-level error" placeholder="Ex: B02705020"></label>
        <label>綽號: <input name="nickname" type="text" class="input-block-level" placeholder="綽號"></label>
        <label>哪幾天晚上有空:</label>
        <label class="checkbox inline">
          <input name="available[]" value="1" type="checkbox"> 星期一
        </label>
        <label class="checkbox inline">
          <input name="available[]" value="2" type="checkbox"> 星期二
        </label>
        <label class="checkbox inline">
          <input name="available[]" value="3" type="checkbox"> 星期三
        </label>
        <label class="checkbox inline">
          <input name="available[]" value="4" type="checkbox"> 星期四
        </label>
        <label class="checkbox inline">
          <input name="available[]" value="5" type="checkbox"> 星期五
        </label>
        <span class="help-block">方便參加小天使相見歡的時間 (約莫會在聖誕節前後舉行)</span>
        <label>備註: <textarea name="comment" class="input-block-level" rows="5" style="resize:none"></textarea></label>
<br><br>
        <input type="button" onclick="checkForm();" class="btn btn-primary" value="報名">
      </fieldset>
        </form>
<?php
  }else{
?>
<h4>報名成功 :)</h4>
<p>以下是您的報名資料確認，如有錯誤請洽活動負責人</p>
	Facebook 帳號:
        <div class="row-fluid">
          <div class="span2">
            <img class="thumbnail" src="https://graph.facebook.com/<?php echo $user; ?>/picture"><br>
          </div>
          <div class="span7">
          <input type="text" value="<?php echo $user_profile['name'];?>" readonly><br>
          </div>
        </div>

        <label>真實姓名: <?php echo htmlspecialchars($record['realname']);?></label>
        <label>學號: <?php echo htmlspecialchars($record['stuid']);?></label>
        <label>綽號: <?php echo htmlspecialchars($record['nickname']);?></label>
        <label>哪幾天晚上有空: 星期<?php echo $record['available'];?></label>
        <label>備註: <textarea name="comments" class="input-block-level" rows="5" style="resize:none" readonly><?php echo htmlspecialchars($record['comments']);?></textarea></label>
      </fieldset>
<?php
  }
}else{
  if(!($_POST['realname']==''||$_POST['nickname']==''||$_POST['stuid']==''||$_POST['nickname']=='')){
    $_POST['stuid']=filterString($_POST['stuid']);
    $_POST['stuid']=strtolower($_POST['stuid']);
    foreach ($_POST['available'] as &$value) {
    $value = abs($value);
    }
    
    // check if user exists in database already
    $str="SELECT fbid FROM register WHERE fbid='".$user."';";
    $result=qMysql($str);
    $record=mysql_fetch_array($result);
    if($record[0]==''){
      $str="INSERT INTO `register`(`fbid`,`fbname`,`realname`,`gender`,`stuid`,`nickname`,`available`,`comments`) VALUES('".$user."','".mysql_real_escape_string($user_profile['name'])."','".mysql_real_escape_string($_POST['realname'])."','".$user_profile['gender']."','".$_POST['stuid']."','".mysql_real_escape_string($_POST['nickname'])."','".implode(",",$_POST['available'])."','".mysql_real_escape_string($_POST['comments'])."')";
      //echo $str;
      $result=qMysql($str);
      echo '
                <h4>報名成功 :)</h4>
                    <p>恭喜你報名成功了!趕快揪還沒有報名的同學噢~</p>';
    }else{
      echo '
                <h4>已報名</h4>
                    <p>我們有收到你的報名資料噢親愛的!</p>';
    }
  }else{
  echo '
                <h4>報名錯誤!</h4>
                    <p>請確定每個必填欄位都要填寫喔！<a href="./join.php">點這裡</a>重新嘗試。</p>';
  }
}

include './lib/footer.php';
?>