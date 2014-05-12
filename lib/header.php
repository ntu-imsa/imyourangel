<!doctype html>
<html>
  <head>
    <title>IM Your Angel</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<!--    <link href="http://bootswatch.com/cyborg/bootstrap.min.css" rel="stylesheet" media="screen"> -->
    <link href="./css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="./css/angel.css" rel="stylesheet" media="screen">
  </head>
  <body>
  <div class="container-narrow">

        <div class="masthead">
            <ul class="nav nav-pills pull-right">
              <?php
              $linkName=array("首頁","我的小主人","活動專頁","關於",$loginText);
              $linkHref=array("./","master.php","https://www.facebook.com/IMYourAngel\" target=\"_blank","about.php",$loginUrl);
              for($i=0;$i<sizeof($linkName);$i++){
                echo '<li';
                if(isset($linkActive)&&$i==$linkActive){
                  echo ' class="active"';
                }
                echo '><a href="'.$linkHref[$i].'">'.$linkName[$i].'</a></li>';
              }
              ?>
            </ul>
            <h3 class="muted">IM Your Angel!</h3>
        </div>

        <hr>
