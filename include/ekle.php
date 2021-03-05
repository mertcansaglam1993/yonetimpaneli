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

        <div class="col-md-12">
          <a href="<?=SITE?>ekle/<?=$kontrol[0]["tablo"]?>" class="btn btn-success float-right"><i class="fa fa-plus"></i> YENİ EKLE</a>
          <a href="<?=SITE?>liste/<?=$kontrol[0]["tablo"]?>" class="btn btn-info float-right mr-2"><i class="fas fa-bars"></i> LİSTE</a><br /><br />
        </div>

          <?php

          if($_POST)
          {
            if(!empty($_POST["kategori"]) && !empty($_POST["baslik"]) && !empty($_POST["anahtar"]) && !empty($_POST["description"]) && !empty($_POST["sirano"]))
            {

              $kategori       = $VT->filter_var($_POST["kategori"]);
              $baslik         = $VT->filter_var($_POST["baslik"]);
              $anahtar        = $VT->filter_var($_POST["anahtar"]);
              $seflink        = $VT->seflink($baslik);
              $description    = $VT->filter_var($_POST["description"]);
              $sirano         = $VT->filter_var($_POST["sirano"]);
              $metin          = $VT->filter_var($_POST["metin"],true);

              if(!empty($_FILES["resim"]["name"]))
              {
                $yukle = $VT->upload("resim","../images/".$kontrol[0]["tablo"]."/");
                if($yukle!=false)
                {
                  $ekle = $VT->sorguCalistir("INSERT INTO ".$kontrol[0]["tablo"],"SET baslik=?, seflink=?, kategori=?, metin=?, resim=?, anahtar=?, description=?, durum=?, sirano=?, tarih=?",array($baslik,$seflink,$kategori,$metin,$yukle,$anahtar,$description,1,$sirano,date("Y-m-d H:i:s")));
                }
                else
                { ?>
                  <div class="alert alert-info">
                    Resim Yükleme İşleminiz Başarısız !
                  </div>
                  <meta http-equiv="refresh" content="2;url=<?=SITE?>">
                  <?php
                }
              }
              else
              {
                  $ekle = $VT->sorguCalistir("INSERT INTO ".$kontrol[0]["tablo"],"SET baslik=?, seflink=?, kategori=?, metin=?, anahtar=?, description=?, durum=?, sirano=?, tarih=?",array($baslik,$seflink,$kategori,$metin,$anahtar,$description,1,$sirano,date("Y-m-d H:i:s")));
              }

              if($ekle!=false)
              { ?>
                <div class="alert alert-success">
                  İşleminiz Başarıyla Kaydedildi.
                </div>
                <meta http-equiv="refresh" content="2;url=<?=SITE?>/liste/<?=$kontrol[0]["tablo"]?>">
                <?php

              }
              else
              { ?>
                <div class="alert alert-danger">
                  İşleminiz Sırasında Bir Sorunla Karşılaşıldı ! Lütfen Daha Sonra Tekrar Deneyiniz.
                </div>
                <meta http-equiv="refresh" content="2;url=<?=SITE?>">
                <?php

              }
            }
            else
            { ?>
              <div class="alert alert-danger">
                Bu Alanlar Kesinlikle Boş Bırakılamaz !<br>
                - Boş Bıraktığınız Alanları Doldurunuz ...
              </div>
              <meta http-equiv="refresh" content="2;url=<?=SITE?>ekle/<?=$kontrol[0]["tablo"]?>">
              <?php
            }
          }
          else {

          ?>
          <form action="" method="POST" enctype="multipart/form-data">
          <div class="col-md-8 container">
          <div class="card-body card card-default">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Kategori Seç</label>
                  <select class="form-control select2" style="width: 100%;" name="kategori">
                    <?php
                    $sonuc = $VT->kategoriGetir($kontrol[0]["tablo"],"",-1);
                    if($sonuc!=false)
                    {
                      echo $sonuc;
                    }
                    else
                    {
                      echo $VT->tekKategori($kontrol[0]["tablo"]);
                    }
                    ?>
                  </select>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label>Başlık</label>
                    <input type="text" class="form-control" name="baslik" placeholder="Başlık ...">
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label>Açıklama</label>
                  <textarea class="textarea" placeholder="Açıklama Alanıdır ..." name="metin"
                        style="width: 100%; height: 350px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label>Anahtar Kelimeler</label>
                    <input type="text" class="form-control" name="anahtar" placeholder="Anahtar Kelimeler ...">
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label>Description</label>
                    <input type="text" class="form-control" name="description" placeholder="Description ...">
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label>Resim</label>
                    <input type="file" class="form-control" placeholder="Resim Seçiniz ..." name="resim">
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label>Sıra No</label>
                    <input type="number" class="form-control" name="sirano" placeholder="Sıra No ..." style="width: 120px;">
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                    <button type="submit" class="btn btn-block btn-primary">KAYDET</button>
                </div>
              </div>
            </div>
          </div>
      </form>
      </div>
    </div>
    </section>
  </div>
<?php } ?>

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