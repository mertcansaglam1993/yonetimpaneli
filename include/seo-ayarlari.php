<div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Seo Ayarları</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?=SITE?>">Anasayfa</a></li>
              <li class="breadcrumb-item active">Seo Ayarları</li>
            </ol>
          </div>
        </div>
      </div>
    </div>

    <section class="content">
      <div class="container-fluid">
          <?php

          if($_POST)
          {
            if(!empty($_POST["baslik"]) && !empty($_POST["anahtar"]) && !empty($_POST["description"]))
            {

              $baslik         = $VT->filter_var($_POST["baslik"]);
              $anahtar        = $VT->filter_var($_POST["anahtar"]);
              $description    = $VT->filter_var($_POST["description"]);

                  $guncelle = $VT->sorguCalistir("UPDATE ayarlar","SET baslik=?, anahtar=?, aciklama=? WHERE id=?",array($baslik,$anahtar,$description,1),1);

              if($guncelle!=false)
              { ?>
                <div class="alert alert-success">
                  İşleminiz Başarıyla Kaydedildi.
                </div>
                <meta http-equiv="refresh" content="2;url=<?=SITE?>seo-ayarlari">
                <?php

              }
              else
              { ?>
                <div class="alert alert-danger">
                  İşleminiz Sırasında Bir Sorunla Karşılaşıldı ! Lütfen Daha Sonra Tekrar Deneyiniz.
                </div>
                <meta http-equiv="refresh" content="2;url=<?=SITE?>seo-ayarlari">
                <?php

              }

            }
            else
            { ?>
              <div class="alert alert-danger">
                Bu Alanlar Kesinlikle Boş Bırakılamaz !<br>
                - Boş Bıraktığınız Alanları Doldurunuz ...
              </div>
              <meta http-equiv="refresh" content="2;url=<?=SITE?>seo-ayarlari">
              <?php
            }
          }
          else {

          ?>
          <form action="" method="POST">
          <div class="col-md-8 container">
          <div class="card-body card card-default">
            <div class="row">
              
              <div class="col-md-12">
                <div class="form-group">
                  <label>Site Başlık</label>
                    <input type="text" class="form-control" name="baslik" placeholder="Site Başlık ..." value="<?=$site_baslik?>">
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label>Site Anahtar Kelimeler</label>
                    <input type="text" class="form-control" name="anahtar" placeholder="Site Anahtar Kelimeler ..." value="<?=$site_anahtar?>">
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label>Site Description</label>
                    <input type="text" class="form-control" name="description" placeholder="Site Description ..." value="<?=$site_aciklama?>">
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                    <button type="submit" class="btn btn-block btn-primary">GÜNCELLE</button>
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
