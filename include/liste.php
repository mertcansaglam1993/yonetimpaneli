<?php

if(!empty($_GET['tablo']))

{

  $tablo = $VT->filter_var($_GET['tablo']);
  $kontrol = $VT->VeriGetir("moduller","WHERE tablo=? AND durum=?",array($tablo,1),"ORDER BY id ASC",1);

  if($kontrol!=false)
  {

?>

<div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"><?=$kontrol[0]["baslik"]?></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?=SITE?>">Anasayfa</a></li>
              <li class="breadcrumb-item active"><?=$kontrol[0]["baslik"]?></li>
            </ol>
          </div>
        </div>
      </div>
    </div>

    <section class="content">
      <div class="container-fluid">
	  
		<div class="row">
		
		<div class="col-lg-12 col-md-12 col-sm-12 col-xl-12">

        <a href="<?=SITE?>ekle/<?=$kontrol[0]["tablo"]?>" class="btn btn-success float-right"><i class="fa fa-plus"></i> YENİ EKLE</a><br><br>
		
        <div class="card">
            <div class="card-body">
              <table id="example1" class="table table-striped">
                <thead>
                <tr>
                  <th style="width: 50px;">Sıra</th>
                  <th>Açıklama</th>
                  <th style="width: 80px;">Durum</th>
                  <th style="width: 80px;">Tarih</th>
                  <th>İşlem</th>
                </tr>
                </thead>
                <tbody>

                  <?php

                  $veriler = $VT->VeriGetir($kontrol[0]["tablo"],"","","ORDER BY id ASC");
                  if($veriler!=false)
                  {
                    $sira = 0;
                    for($i=0; $i<count($veriler); $i++)
                    {
                      $sira++;
                      if($veriler[$i]["durum"]==1) {$aktifpasif='checked="checked"';} else {$aktifpasif='';}
                      ?>

                      <tr>
                        <td align="center"><?=$sira?></td>
                        <td align="center"><?php
                        echo stripslashes($veriler[$i]["baslik"]);
                        echo '<br />'.mb_substr(strip_tags(stripslashes($veriler[$i]["metin"])),0,130,"UTF-8")."...";

                        ?>
                        </td>
                        <td align="center">
                          <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                            <input type="checkbox" class="custom-control-input aktifpasif<?=$veriler[$i]["id"]?>" id="customSwitch3" <?=$aktifpasif?> value="<?=$veriler[$i]["id"]?>" onclick="aktifpasif('<?=$veriler[$i]["id"]?>','<?=$kontrol[0]["tablo"]?>');">
                            <label class="custom-control-label" for="customSwitch3"></label>
                        </div>
                        </td>
                        <td align="center"><?=$veriler[$i]["tarih"]?></td>
                        <td align="center">
                          <a href="<?=SITE?>duzenle/<?=$kontrol[0]["tablo"]?>/<?=$veriler[$i]["id"]?>" class="btn btn-warning btn-sm">Düzenle</a>
                          <a href="<?=SITE?>sil/<?=$kontrol[0]["tablo"]?>/<?=$veriler[$i]["id"]?>" class="btn btn-danger btn-sm">Sil</a>
                        </td>
                      </tr>

                        <?php
                    }
                  }
                  else
                  {

                  }

                  ?>

                </tbody>
              </table>
            </div>
          </div>
		  
		  </div>
		  </div>

      </div>
    </section>
  </div>

  <?php

    }

    else
    { ?>

    <meta http-equiv="refresh" content="0;url=<?=SITE?>">

   <?php }

    }

    else

    { ?>

    <meta http-equiv="refresh" content="0;url=<?=SITE?>">

   <?php } ?>
