<?php  
include "../config.php";
include "../class/Kue.php";

if (isset($_POST['proses'])) {
	
	if (isset($_POST['proses'])) {
		$curl = curl_init();
		curl_setopt_array($curl, Array(
			CURLOPT_URL            => 'http://detik.feedsportal.com/c/33613/f/656082/index.rss',
			CURLOPT_USERAGENT      => 'spider',
			CURLOPT_TIMEOUT        => 120,
			CURLOPT_CONNECTTIMEOUT => 30,
			CURLOPT_RETURNTRANSFER => TRUE,
			CURLOPT_ENCODING       => 'UTF-8'
		));

		$data = curl_exec($curl);

		curl_close($curl);
	
	$xml = simplexml_load_string($data, 'SimpleXMLElement', LIBXML_NOCDATA);

		foreach ($xml->channel->item as $item) {
			$tit = addslashes($item->title);
			$link = $item->link;
			$tgl = date('Y/m/d');

			$ckdbjdl = mysql_query("SELECT * FROM judul WHERE judul = '$tit' AND tanggal_judul = '$tgl'")or die("gagal cek judul");
			$ttl = mysql_num_rows($ckdbjdl);
			if ($ttl == 1) {
				//return TRUE;
			}
			else
			{
				mysql_query("INSERT INTO judul VALUES('','$tit','$link','$tgl')")or die("gagal simpan judul");

				$judul = explode(" ", $tit);
				$jumData = count($judul);

				for ($i=0;$i<$jumData;$i++) {
				
					$now = date('Y/m/d');
					$cek = mysql_query("SELECT * FROM kata
										WHERE kata = '$judul[$i]' AND tanggal_kata = '$now'");
					$cou = mysql_num_rows($cek);
					if ($cou == 1 ) {
						while ($z = mysql_fetch_assoc($cek)) {
							$new = $z['jumlah']+1;
							mysql_query("UPDATE kata 
								SET jumlah = '$new'
								WHERE kata = '$judul[$i]' 
								AND tanggal_kata = '$now'")or die('gagal update');
						//return $x;
						}
						
					}
					else {
						$maxque = mysql_query("SELECT id_judul FROM judul ORDER by id_judul DESC LIMIT 1");
						while ($max=mysql_fetch_assoc($maxque)) {
							mysql_query("INSERT INTO kata 
								VALUES('','$max[id_judul]','1','$judul[$i]','1','$now')")or die('gagal simpan');
						}
						
						//return $y;
					}

					//print $judul[$i]."<br>";
					
				}
			}
			
		}

		header("location:../index.php");
	}
	else if (!isset($_POST['proses'])) {
		
	}
	else {

	}
}
else {

}
?>