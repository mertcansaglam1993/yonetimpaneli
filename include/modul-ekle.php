<div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Modül Ekle</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Anasayfa</a></li>
              <li class="breadcrumb-item active">Modül Ekle</li>
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

            $calistir = $VT->ModulEkle();
            if($calistir!=false)
            { ?>

              <div class="alert alert-success">
                Modülünüz Başarıyla Eklenmiştir. !
              </div>

              <meta http-equiv="refresh" content="2;url=<?=SITE?>">

            <?php } else
            { ?>

              <div class="alert alert-danger">
                Modülünüz Oluşturulurken Bir Sorunla Karşılaştı. Sorunlar Şunlar Olabilir;<br>
                - Boş Alan Olabilir.<br>
                - Aynı İsimde Zaten Kayıtlı Bir Veri Mevcut Olabilir.<br>
                - Sistemsel Bir Sorun Oluşmuş Olabilir.
              </div>

              <meta http-equiv="refresh" content="2;url=<?=SITE?>">

            <?php }

          } else {

        ?>
          <div class="col-md-8 container">
          <div class="card card-default">
              <div class="card-header">
                <h3 class="card-title">Modül Tanımlama Ekranı</h3>
              </div>
              <form role="form" accept="" method="POST">
                <div class="card-body">
                  <div class="form-group">
                    <label>Modül Adı</label>
                    <input type="text" class="form-control" name="baslik" placeholder="Modül İsmini Giriniz..">
                  </div>
                  <div class="form-check">
                    <input type="checkbox" class="form-check-input" name="durum" value="1" checked="checked">
                    <label class="form-check-label">Aktif Yap</label>
                  </div>
                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Modül Ekle</button>
                </div>
              </form>
            </div>
      </div>
    </div>
    </section>
  </div>
  <?php } ?>
