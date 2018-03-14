<?php
include_once './config/config.inc.php';
$rootPath = _SUX_ROOT_;
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>스트림유엑스 : SUX CMS 삭제 완료</title>
  <link rel="stylesheet" type="text/css" href="./common/css/sux.min.css?20180202">
  <style>
    body{
      text-align: center;
    }
    h1 img{
      width:80px;
    }
    p {
      font-size: 1.125em;
    }
    .wrapper{
      padding: 0 15px;
    }    
    .section{
      margin-top:45px;
      padding:45px 20px;
      background-color: #fafafa;
      word-break:keep-all;
    }
    .section p{
      line-height: 34px;
    }
    .section .link_reinstall{
      margin-top:120px;
      text-align-last: center;
    }
    .section .link_reinstall a{
      text-decoration: none;
    }
    .section .link_reinstall .sx-btn{
      padding: 10px 20px;
    }
    .footer{
      display: inline-block;
      position: fixed;
      left:0;
      bottom:0;
      width:100%;
      height: 45px;
      background-color: #222;
      color:#e3e3e3;
    }
    .footer a{
      line-height: 45px;
      color:#e3e3e3;
    }
  </style>
</head>
<body>
  <div class="wrapper">
    <header><h1 class="sx-logo">
        <a href="http://streamux.com" target="_blank"><img src="./common/images/sux_logo.svg" onerror='this.src="{$rootPath}common/images/sux_logo.png"' title="streamxux" alt="streamxux"></a>
      </h1>
    </header>
    <section class="section sx-edgebox">
      <p>SUX CMS 생성 파일과 데이터베이스 데이터 삭제가 완료되었습니다.</p><br>
      <p>그동안 스트림유엑스 서비스를 이용해주셔서 감사합니다.</p>
      <p class="link_reinstall"><a href="<?=$rootPath?>" class="sx-btn sx-btn-info">다시 설치하기</a></p>
    </section>
    <footer class="footer">
      <?php include './modules/admin/tpl/copyright.tpl' ?>
    </footer>        
  </div>  
</body>
</html>