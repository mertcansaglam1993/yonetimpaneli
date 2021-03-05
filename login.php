<?php
session_start();
ob_start();
define("DATA", "data/");
define("SAYFA", "include/");
define("SINIF", "class/");
include_once DATA . 'baglanti.php';
define("SITE",$site_url);
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="description" content="<?=$site_aciklama?>">
  <meta name="keywords" content="<?=$site_anahtar?>">
  <meta name="author" content="Mert Can Sağlam">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?=$site_baslik?></title>
  <link rel="stylesheet" href="<?=SITE?>plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="<?=SITE?>plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <link rel="stylesheet" href="<?=SITE?>dist/css/adminlte.min.css">
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="<?=SITE?>"><b>YönetimPaneli</b> Girişi</a>
  </div>

  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Giriş yapmak için bilgilerinizi giriniz...</p>
      
      <?php 

        if($_POST) 
        {

          if(!empty($_POST['kullanici']) && !empty($_POST['sifre'])) 
          {

            $kullanici = $VT->filter_var($_POST['kullanici']);
            $sifre = sha1($VT->filter_var($_POST['sifre']));

            $kontrol = $VT->VeriGetir("kullanicilar","WHERE kullanici=? AND sifre=?",array($kullanici,$sifre),"ORDER BY id ASC",1);

            if($kontrol!=false) 
            { 
              $_SESSION["kullanici"]  = $kontrol[0]["kullanici"];
              $_SESSION["adsoyad"]    = $kontrol[0]["adsoyad"];
              $_SESSION["mail"]       = $kontrol[0]["mail"];
              $_SESSION["id"]         = $kontrol[0]["id"];
              ?>
            <meta http-equiv="refresh" content="0;url=<?=SITE?>">
            <?php 
            exit();
            }
            else 
            { ?>
              <div class="alert alert-danger">
              Kullanıcı Adı Şifre Hatalı Veya Yanlış !
              </div>
           <?php }

          }
          else 
          { ?>
            <div class="alert alert-danger">
              Boş Bıraktığınız Alanları Lütfen Doldurunuz...
            </div>
          <?php }

        }
        else 
        {

        }

      ?>
      <form action="" method="post">
        <div class="input-group mb-3">
          <input type="text" class="form-control" name="kullanici" placeholder="Kullanıcı Adınız...">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="sifre" placeholder="Şifreniz...">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
          </div>
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Giriş Yap</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<script src="<?=SITE?>plugins/jquery/jquery.min.js"></script>
<script src="<?=SITE?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?=SITE?>dist/js/adminlte.min.js"></script>

</body>
</html>
