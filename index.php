<?php
session_start();
ob_start();
define("DATA", "data/");
define("SAYFA", "include/");
define("SINIF", "class/");
include_once DATA . 'baglanti.php';
define("SITE",$site_url);
if(!empty($_SESSION["id"]) && !empty($_SESSION["adsoyad"]) && !empty($_SESSION["mail"]))
{

}
else 
{ ?>
	<meta http-equiv="refresh" content="0;url=<?=SITE?>giris-yap"> 
<?php 
exit();
}
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
  <link rel="stylesheet" href="<?=SITE?>plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <link rel="stylesheet" href="<?=SITE?>plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <link rel="stylesheet" href="<?=SITE?>plugins/jqvmap/jqvmap.min.css">
  <link rel="stylesheet" href="<?=SITE?>dist/css/adminlte.min.css">
  <link rel="stylesheet" href="<?=SITE?>dist/css/custom.css">
  <link rel="stylesheet" href="<?=SITE?>plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <link rel="stylesheet" href="<?=SITE?>plugins/daterangepicker/daterangepicker.css">
  <link rel="stylesheet" href="<?=SITE?>plugins/summernote/summernote-bs4.css">
  <link rel="stylesheet" href="<?=SITE?>plugins/datatables-bs4/css/dataTables.bootstrap4.css">
  <link rel="stylesheet" href="<?=SITE?>plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="<?=SITE?>plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <link rel="stylesheet" href="<?=SITE?>plugins/summernote/summernote-bs4.css">
  <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap&subset=latin-ext" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

<?php

  include_once DATA.'ust.php';
  include_once DATA.'menu.php';


  if ($_GET && !empty($_GET['sayfa'])) {

    $sayfa = $_GET['sayfa'].".php";
    if (file_exists(SAYFA.$sayfa)) {
      include_once SAYFA.$sayfa;
    }else {
      include_once SAYFA.'home.php';
    }

  } else {
    include_once SAYFA.'home.php';
  }

  include_once DATA.'footer.php';
?>

  <aside class="control-sidebar control-sidebar-dark">
  </aside>
</div>

<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="<?=SITE?>plugins/jquery-ui/jquery-ui.min.js"></script>
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<script src="<?=SITE?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?=SITE?>plugins/summernote/summernote-bs4.min.js"></script>
<script src="<?=SITE?>plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<script src="<?=SITE?>dist/js/adminlte.js"></script>
<script src="<?=SITE?>plugins/datatables/jquery.dataTables.js"></script>
<script src="<?=SITE?>plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<script src="<?=SITE?>plugins/select2/js/select2.full.min.js"></script>
<script src="<?=SITE?>plugins/summernote/summernote-bs4.min.js"></script>

<script>
  $(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
    });
  });
</script>

<script>
  $(function () {

    $('.select2').select2()

    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

  })
</script>

<script>
  $(function () {
    $('.textarea').summernote()
  })

  function aktifpasif(id,tablo) {
    var durum = 0;
    if($('.aktifpasif'+id).is(':checked')) {
      durum = 1;
    } else {
      durum = 2;
    }

    $.ajax({
      method:'POST',
      url:'<?=SITE?>ajax.php',
      data:{'tablo':tablo,'id':id,'durum':durum},
      success: function(sonuc)
      {
        if(sonuc=="TAMAM")
        {
          alert("İŞLEM TAMAM DURUM GÜNCELLENDİ.");
        }
        else
        {
          alert("İşleminiz Şuan Geçersizdir ! Lütfen Daha Sonra Tekrar Deneyiniz.")
        }
      }
    });

  }
</script>

</body>
</html>
