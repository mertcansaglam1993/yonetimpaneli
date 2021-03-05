<?php
    include_once SINIF . 'class.upload.php';
    include_once SINIF . 'VT.php';

    $VT = new VT();

    $ayarlar = $VT->VeriGetir("ayarlar","WHERE ID=?",array(1),"ORDER BY ID ASC",1);
	
    if ($ayarlar!=false) {
        $site_baslik        = $ayarlar[0]["baslik"];
        $site_anahtar       = $ayarlar[0]["anahtar"];
        $site_aciklama      = $ayarlar[0]["aciklama"];
        $site_telefon       = $ayarlar[0]["telefon"];
        $site_mail          = $ayarlar[0]["mail"];
        $site_adres         = $ayarlar[0]["adres"];
        $site_fax           = $ayarlar[0]["fax"];
        $site_url           = $ayarlar[0]["url"];
    }
?>