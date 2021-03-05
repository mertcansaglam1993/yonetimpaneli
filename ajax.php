<?php
session_start();
ob_start();
define("DATA", "data/");
define("SAYFA", "include/");
define("SINIF", "class/");
include_once DATA . 'baglanti.php';
define("SITE",$site_url);

  if($_POST)
  {
    if(!empty($_POST["tablo"]) && !empty($_POST["id"]) && !empty($_POST["durum"]))
    {
      $tablo  = $VT->filter_var($_POST["tablo"]);
      $id     = $VT->filter_var($_POST["id"]);
      $durum  = $VT->filter_var($_POST["durum"]);

      $guncelle = $VT->sorguCalistir("UPDATE ".$tablo,"SET durum=? WHERE id=?",array($durum,$id),1);
      if($guncelle!=false)
      {
        echo "TAMAM";
      }
      else
      {
        echo "HATA";
      }

    }
    else
    {
        echo "BOŞ";
    }
  }

?>
