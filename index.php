<?php
require './lib/facebook.php';
require './lib/library.php';

$linkActive=0;
include './lib/header.php';
?>
<div class="hero-unit">
            <h1>IM Your Angel!</h1>
            <p class="lead"><br>蔚藍的天被染紅，殷紅的鮮血灑滿了整地。
			<br>彩虹不再出現，取而代之的是充滿恐懼的腥風血雨。
			<br>人們失去了勇氣，失去了活力，在這個悲慘的世界中苟延殘喘。<br>
			天使們卻在這時候墮入人間，拯救活在痛苦深淵的人們。<br>
			人們天天搭著那五班公車，到管圖車站跂望天使們的到來，<br>只為收到一份活下去的希望。<br>
			各位天使，準備好你的展開羽翼，帶領痛苦的人們飛翔了嗎？<br>12/2，讓我們一起在這個瘋狂世界中散播希望！IM Your Angel！</p>
            <a class="btn btn-large btn-primary" href=<?php
            if($user){
              echo '"master.php">照顧我的小主人';
            }else{
              echo '"'.$loginUrl.'">登入 Facebook';
            }
            ?></a>
        </div>
<?php
include './lib/footer.php';
?>