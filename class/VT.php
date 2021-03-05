<?php

class VT {

    // Veritabanı Ayar Bilgileri

    var $sunucu 	= "localhost";
    var $user 		= "mertca10_saglam";
    var $password 	= "L2t4onv1U2";
    var $dbname 	= "mertca10_yonetimpaneli";
    var $baglanti;
	
    // Veritabanı Bağlantısını Çalıştır
    function __construct()
    {
        try
        {

            $this->baglanti = new PDO("mysql:host=".$this->sunucu.";dbname=".$this->dbname.";charset=utf8",$this->user,$this->password);

        } catch(PDOException $error)
        {
            echo $error->getMessage();
            exit();
        }
    }
	
	// Veritabanı Sorgularını Çalıştırıp Getiren Method
    public function VeriGetir($tablo,$wherealanlar="",$wherearraydeger="",$orderby="ORDER BY ID ASC",$limit="")
    {
        $this->baglanti->query("SET CHARACTER SET utf8");
        $sql = "SELECT * FROM ".$tablo;
        if (!empty($wherealanlar) && !empty($wherearraydeger))
        {
            $sql.=" ".$wherealanlar;
            if (!empty($orderby)) { $sql.= " ".$orderby; }
            if (!empty($limit)) { $sql.= " LIMIT ".$limit; }
            $calistir = $this->baglanti->prepare($sql);
            $sonuc = $calistir->execute($wherearraydeger);
            $veri = $calistir->fetchAll(PDO::FETCH_ASSOC);
        }
        else
        {
            if (!empty($orderby)) { $sql.= " ".$orderby; }
            if (!empty($limit)) { $sql.= " LIMIT ".$limit; }
            $veri = $this->baglanti->query($sql,PDO::FETCH_ASSOC);
        }

        if ($veri!=false && !empty($veri)) {

            $datalar = array();
            foreach ($veri as $bilgiler) {
                $datalar [] = $bilgiler;
            }
            return $datalar;

        }
        else
        {
            return false;
        }

    }
	
	// Veritabanı Sorgularını Çalıştıran Method
    public function sorguCalistir($tablo,$alanlar="",$degerlerarray="",$limit="")
    {
        $this->baglanti->query("SET CHARACTER SET utf8");
        if (!empty($alanlar) && !empty($degerlerarray)){
        $sql = $tablo. " ".$alanlar;
        if (!empty($limit)) { $sql.= " LIMIT ".$limit; }
        $calistir=$this->baglanti->prepare($sql);
        $sonuc = $calistir->execute($degerlerarray);
        }
        else
        {
            $sql = $tablo;
            if (!empty($limit)) { $sql.= " LIMIT ".$limit; }
            $sonuc = $this->baglanti->exec($sql);
        }

        if ($sonuc!=false) {
            return true;
        }
        else
        {
            return false;
        }

        $this->baglanti->query("SET CHARACTER SET utf8");
    }
	
	// SEO İçin SefLink Uyumlu Çalışan Method
    public function seflink($val) {

        $find = array('Ç', 'Ş', 'Ğ', 'Ü', 'İ', 'Ö', 'ç', 'ş', 'ğ', 'ü', 'ö', 'ı', '+', '#','?','*','!','.','(',')');
        $replace = array('c', 's', 'g', 'u', 'i', 'o', 'c', 's', 'g', 'u', 'o', 'i', 'plus', 'sharp','','','','','','');
        $string = strtolower(str_replace($find, $replace, $val));
        $string = preg_replace("@[^A-Za-z0-9\-_\.\+]@i", ' ', $string);
        $string = trim(preg_replace('/\s+/', ' ', $string));
        $string = str_replace(' ', '-', $string);
        return $string;
    }
	
	// Sisteme Yeni Modül Ekleyen Method
    public function ModulEkle()
    {
        if(!empty($_POST['baslik']))
        {
            $baslik = $_POST["baslik"];

            if(!empty($_POST['durum'])) { $durum=1; } else { $durum=2; }
            $tablo = str_replace(" ", "-", $this->seflink($baslik));

            $kontrol = $this->VeriGetir("moduller","WHERE tablo=?",array($tablo),"ORDER BY id ASC",1);

            if($kontrol!=false)
            {
                return false;
            }
            else
            {

                $tabloOlustur = $this->sorguCalistir('CREATE TABLE `'.$tablo.'` (
                  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                  `baslik` varchar(255) COLLATE utf8_general_ci DEFAULT NULL,
                  `seflink` varchar(255) COLLATE utf8_general_ci DEFAULT NULL,
                  `kategori` varchar(255) COLLATE utf8_general_ci DEFAULT NULL,
                  `metin` text COLLATE utf8_general_ci,
                  `resim` varchar(255) COLLATE utf8_general_ci DEFAULT NULL,
                  `anahtar` varchar(255) COLLATE utf8_general_ci DEFAULT NULL,
                  `description` varchar(255) COLLATE utf8_general_ci DEFAULT NULL,
                  `durum` int(5) DEFAULT NULL,
                  `sirano` int(11) DEFAULT NULL,
                  `tarih` date DEFAULT NULL
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;');

                $modulekle = $this->sorguCalistir("INSERT INTO moduller","SET baslik=?, tablo=?, durum=?, tarih=?",array($baslik,$tablo,$durum,date("Y-m-d H:i:s")));

                $kategoriekle = $this->sorguCalistir("INSERT INTO kategoriler","SET baslik=?,
                    seflink=?, tablo=?, durum=?, tarih=?",array($baslik,$tablo,'modul',1,date("Y-m-d H:i:s")));

                if($modulekle!=false)
                {
                    return true;
                }
                else
                {
                    return false;
                }
            }

        }
        else
        {
              return false;
        }
    }
	
	// Güvenlik Filtresi Method
    public function filter_var($val,$tf=false)
    {
        if($tf==false) { $val = strip_tags($val); }
        $val = addslashes(trim($val));
        return $val;
    }
	
	// Resim Upload Sınıfı İçin Uzantı Method
    public function uzanti($dosyaadi)
    {
        $parca    = explode(".", $dosyaadi);
        $uzanti   = end($parca);
        $donustur = strtolower($uzanti);
        return $donustur;
    }
	
	// Resim Upload Sınıfı İçin Method
    public function upload($nesnename,$yuklenecekyer='images/',$tur='img',$w='',$h='',$resimyazisi='')
	  {
		if($tur=="img")
		{
			if(!empty($_FILES[$nesnename]["name"]))
			{
				$dosyanizinadi=$_FILES[$nesnename]["name"];
				$tmp_name=$_FILES[$nesnename]["tmp_name"];
				$uzanti=$this->uzanti($dosyanizinadi);
				if($uzanti=="png" || $uzanti=="jpg" || $uzanti=="jpeg" || $uzanti=="gif")
				{
					$classIMG=new upload($_FILES[$nesnename]);
					if($classIMG->uploaded)
					{
						if(!empty($w))
						{
							if(!empty($h))
							{
								$classIMG->image_resize=true;
								$classIMG->image_x=$w;
								$classIMG->image_y=$h;
							}
							else
							{
								if($classIMG->image_src_x>$w)
								{
									$classIMG->image_resize=true;
									$classIMG->image_ratio_y=true;
									$classIMG->image_x=$w;
								}
							}
						}
						else if(!empty($h))
						{
								if($classIMG->image_src_h>$h)
								{
									$classIMG->image_resize=true;
									$classIMG->image_ratio_x=true;
									$classIMG->image_y=$h;
								}
						}

						if(!empty($resimyazisi))
						{
							$classIMG->image_text = $resimyazisi;

						$classIMG->image_text_direction = 'v';

						$classIMG->image_text_color = '#FFFFFF';

						$classIMG->image_text_position = 'BL';
						}
						$rand=uniqid(true);
						$classIMG->file_new_name_body=$rand;
						$classIMG->Process($yuklenecekyer);
						if($classIMG->processed)
						{
							$resimadi=$rand.".".$classIMG->image_src_type;
							return $resimadi;
						}
						else
						{
							return false;
						}
					}
					else
					{
						return false;
					}
				}
				else
				{
					return false;
				}
			}
			else
			{
				return false;
			}
		}
		else if($tur=="ds")
		{

			if(!empty($_FILES[$nesnename]["name"]))
			{

				$dosyanizinadi=$_FILES[$nesnename]["name"];
				$tmp_name=$_FILES[$nesnename]["tmp_name"];
				$uzanti=$this->uzanti($dosyanizinadi);
				if($uzanti=="doc" || $uzanti=="docx" || $uzanti=="pdf" || $uzanti=="xlsx" || $uzanti=="xls" || $uzanti=="ppt" || $uzanti=="xml" || $uzanti=="mp4" || $uzanti=="avi" || $uzanti=="mov")
				{

					$classIMG=new upload($_FILES[$nesnename]);
					if($classIMG->uploaded)
					{
						$rand=uniqid(true);
						$classIMG->file_new_name_body=$rand;
						$classIMG->Process($yuklenecekyer);
						if($classIMG->processed)
						{
							$dokuman=$rand.".".$uzanti;
							return $dokuman;
						}
						else
						{
							return false;
						}
					}
				}
			}
		}
		else
		{
			return false;
		}
	}
	
	// Bütün Kategorileri Getiren Method
    public function kategoriGetir($tablo,$secid="",$uz=-1)
    {
      $uz++;
      $kategori = $this->VeriGetir("kategoriler","WHERE tablo=?",array($tablo),"ORDER BY id ASC");

      if($kategori!=false)
      {
        for($q=0;$q<count($kategori);$q++)
        {
          $kategoriseflink = $kategori[$q]["seflink"];
          $kategori_id = $kategori[$q]["id"];
          if($secid==$kategori_id)
          {
            echo '<option value="'.$kategori_id.'" selected="selected">'.str_repeat("&nbsp;&nbsp;&nbsp;",$uz).stripslashes($kategori[$q]["baslik"]).'</option>';
          }
          else
          {
            echo '<option value="'.$kategori_id.'">'.str_repeat("&nbsp;&nbsp;&nbsp;",$uz).stripslashes($kategori[$q]["baslik"]).'</option>';
          }
          if($kategoriseflink==$tablo)
          {
            break;
          }
          $this->kategoriGetir($kategoriseflink,$secid,$uz);
        }
      }
      else
      {
          return false;
      }

    }
	
	// Tek Kategori Getiren Method
    public function tekKategori($tablo,$secid="",$uz=-1)
    {
      $uz++;
      $kategori = $this->VeriGetir("kategoriler","WHERE seflink=? AND tablo=?",array($tablo,"modul"),"ORDER BY id ASC");

      if($kategori!=false)
      {
        for($q=0;$q<count($kategori);$q++)
        {
          $kategoriseflink = $kategori[$q]["seflink"];
          $kategori_id = $kategori[$q]["id"];
          if($secid==$kategori_id)
          {
            echo '<option value="'.$kategori_id.'" selected="selected">'.str_repeat("&nbsp;&nbsp;&nbsp;",$uz).stripslashes($kategori[$q]["baslik"]).'</option>';
          }
          else
          {
            echo '<option value="'.$kategori_id.'">'.str_repeat("&nbsp;&nbsp;&nbsp;",$uz).stripslashes($kategori[$q]["baslik"]).'</option>';
          }
        }
      }
      else
      {
          return false;
      }

    }

}

?>