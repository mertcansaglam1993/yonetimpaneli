<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="<?=SITE?>" class="brand-link">
      <span class="text-center container brand-text font-weight-light">Yönetim Paneli</span>
    </a>
    <div class="sidebar">
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?=SITE?>dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="">
        </div>
        <div class="info">
          <a href="<?=SITE?>" class="d-block"><?=$_SESSION["adsoyad"]?></a>
        </div>
      </div>
		
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

        <li class="nav-item">
            <a href="<?=SITE?>modul-ekle" class="nav-link">
            <i class="nav-icon fas fa-th fa-2x"></i>
              <p>
                Modül Ekle
              </p>
            </a>
        </li>

        <li class="nav-item has-treeview">

            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Sayfalar
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>

            <?php 

            $moduller = $VT->VeriGetir("moduller","WHERE durum=?",array(1),"ORDER BY id ASC");
            if($moduller!=false)
            {
              for($i=0;$i<count($moduller);$i++)
              { ?>

                <ul class="nav nav-treeview">
                <li class="nav-item">
                <a href="<?=SITE?>liste/<?=$moduller[$i]["tablo"]?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p><?=$moduller[$i]["baslik"]?></p>
                </a>
                </li>
                </ul>

            <?php  } } ?>

          </li>

          <li class="nav-item">
            <a href="<?=SITE?>seo-ayarlari" class="nav-link">
            <i class="nav-icon fas fa-th fa-2x"></i>
              <p>
                Seo Ayarları
              </p>
            </a>
        </li>

        <li class="nav-item">
            <a href="<?=SITE?>iletisim-ayarlari" class="nav-link">
            <i class="nav-icon fas fa-th fa-2x"></i>
              <p>
                İletişim Ayarları
              </p>
            </a>
        </li>

        <li class="nav-item">
            <a href="<?=SITE?>cikis-yap" class="nav-link">
            <i class="nav-icon fas fa-th fa-2x"></i>
              <p>
                Çıkış Yap
              </p>
            </a>
        </li>


        </ul>
      </nav>
    </div>
  </aside>