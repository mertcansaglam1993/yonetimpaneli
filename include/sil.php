<?php

if(!empty($_GET['tablo']))

{

  $tablo    = $VT->filter_var($_GET['tablo']);
  $id       = $VT->filter_var($_GET['id']);
  $kontrol  = $VT->VeriGetir("moduller","WHERE tablo=? AND durum=?",array($tablo,1),"ORDER BY id ASC",1);

  if($kontrol!=false)
  {

    $veri = $VT->VeriGetir($kontrol[0]["tablo"],"WHERE id=?",array($id),"ORDER BY id ASC",1);
    if($veri!=false)
    {
      $sil = $VT->sorguCalistir("DELETE FROM ".$tablo,"WHERE id=?",array($id),1);

      ?>

      <div class="alert alert-success">
        İstediğiniz Veri Başarıyla Silinmiştir !
      </div>

      <meta http-equiv="refresh" content="2;url=<?=SITE?>liste/<?=$kontrol[0]["tablo"]?>">

      <?php

    }
    else
    { ?>

      <div class="alert alert-success">
        İstediğiniz Veri Silinirken Bir Hata Oluştu ! Lütfen Tekrar Deneyiniz.
      </div>

    <meta http-equiv="refresh" content="2;url=<?=SITE?>liste/<?=$kontrol[0]["tablo"]?>">

    <?php

    }


  }
  else

  { ?>

  <meta http-equiv="refresh" content="0;url=<?=SITE?>">

  <?php

    }

    }

    else

    { ?>

    <meta http-equiv="refresh" content="0;url=<?=SITE?>">

   <?php } ?>
