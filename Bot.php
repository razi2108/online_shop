<?php
	date_default_timezone_set('Asia/Jakarta');
	error_reporting(0);
	$token = "1579128966:AAF6m9zJyDvybdB7xpJ5iFpe9yO5_m2MpkA";
	define('BOT_TOKEN', $token);

	define('API_URL', 'https://api.telegram.org/bot'.BOT_TOKEN.'/');

	define('myVERSI', '0.0.1');
	define('lastUpdate', 'date("Y-m-d", time())');

	$debug = false;

	function exec_curl_request($handle){
		$response = curl_exec($handle);

		if($response == false){
			$errno = curl_errno($handle);
			$error = curl_error($handle);
			error_log("return curl error guys $errno: $error \n");
			curl_close($handle);

			return false;
		}

		$http_code = intval(curl_getinfo($handle, CURLINFO_HTTP_CODE));
		curl_close($handle);

		if($http_code >= 500){
			sleep(10);

			return false;
		} elseif ($http_code != 200) {
        $response = json_decode($response, true);
        error_log("Request has failed with error {$response['error_code']}: {$response['description']}\n");
        if ($http_code == 401) {
            throw new Exception('Invalid access token provided');
        }

        return false;
    } else {
        $response = json_decode($response, true);
        if (isset($response['description'])) {
            error_log("Request was successfull: {$response['description']}\n");
        }
        $response = $response['result'];
    }

    return $response;
	}

	function apiRequest($method, $parameters = null)
	{
		# code...
		if (!is_string($method)) {
        error_log("Method name must be a string\n");

	        return false;
	    }

	    if (!$parameters) {
	        $parameters = [];
	    } elseif (!is_array($parameters)) {
	        error_log("Parameters must be an array\n");

	        return false;
	    }

	    foreach ($parameters as $key => &$val) {
	        // encoding to JSON array parameters, for example reply_markup
	    if (!is_numeric($val) && !is_string($val)) {
	        $val = json_encode($val);
	    }
	    }
	    $url = API_URL.$method.'?'.http_build_query($parameters);

	    $handle = curl_init($url);
	    curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
	    curl_setopt($handle, CURLOPT_CONNECTTIMEOUT, 5);
	    curl_setopt($handle, CURLOPT_TIMEOUT, 60);
	    curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false);

	    return exec_curl_request($handle);
	}

	function apiRequestJson($method, $parameters){
	    if (!is_string($method)) {
	        error_log("Wajib String bos ku\n");

	        return false;
	    }

	    if (!$parameters) {
	        $parameters = [];
	    } elseif (!is_array($parameters)) {
	        error_log("Parameternya wajib array bos ku\n");

	        return false;
	    }

	    $parameters['method'] = $method;

	    $handle = curl_init(API_URL);
	    curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
	    curl_setopt($handle, CURLOPT_CONNECTTIMEOUT, 5);
	    curl_setopt($handle, CURLOPT_TIMEOUT, 60);
	    curl_setopt($handle, CURLOPT_POSTFIELDS, json_encode($parameters));
	    curl_setopt($handle, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);

	    return exec_curl_request($handle);
	}
	//ini trap gan 
	if (strlen(BOT_TOKEN) < 20) {
    die(PHP_EOL."-> -> Token BOT API nya mohon diisi dengan benar!\n");
	}
	function getUpdates($last_id = null)
	{
	    $params = [];
	    if (!empty($last_id)) {
	        $params = ['offset' => $last_id + 1, 'limit' => 1];
	    }
	  //echo print_r($params, true);
	  return apiRequest('getUpdates', $params);
	}

	// ----------- pantengin mulai ini
	function sendMessage($idpesan, $idchat, $pesan)
	{
	    $data = [
	    'chat_id'             => $idchat,
	    'text'                => $pesan,
	    'parse_mode'          => 'Markdown',
	    'reply_to_message_id' => $idpesan,
	  ];

	    return apiRequest('sendMessage', $data);
	}
	
	function processMessage($message)
	{   
	// koneksi ke DB
	include "conf/conn.php";
	

    if (isset($message['message'])) {
        $sumber = $message['message'];
        $idpesan = $sumber['message_id'];
        $idchat = $sumber['chat']['id'];

        $namamu = $sumber['from']['first_name'];
        // $namabkg = $sumber['from']['last_name'];
        $iduser = $sumber['from']['id'];

        if (isset($sumber['text'])) {
            $pesan = $sumber['text'];

            if (preg_match("/^\/view_(\d+)$/i", $pesan, $cocok)) {
                $pesan = "/view $cocok[1]";
            }

            if (preg_match("/^\/hapus_(\d+)$/i", $pesan, $cocok)) {
                $pesan = "/hapus $cocok[1]";
            }

	            $pecah = explode(' ', $pesan);
	            $katapertama = strtolower($pecah[0]);
			if (isset($katapertama)) {
				# code...
				mysqli_query($con, "INSERT INTO `tbl_spam` (`id`, `user_id`, `cmd`, `datetime`) VALUES (NULL, '$iduser', '$katapertama', current_timestamp())");
				$jml_log = mysqli_query($con, "SELECT * FROM tbl_spam WHERE user_id = '$iduser'");
				$total = mysqli_num_rows($jml_log);
				if ($total > 50) {
					# code...
					$text = "Anda terlalu sering mengirimkan perintah, silahkan kembali lagi setelah jam 12 siang atau jam 12 malam";
				}else{
					switch ($katapertama) {
						case '/help':
							# code...
								$text = "Sistem Bot Toko Online Gold & Straight\n------------------------------------- By.Fakhrurrazi -------------------------------------\n\nDaftar menu yang bisa di gunakan\n-----------------------------------------------------------------------------------------------------\n• Ketik /login<spasi>username<spasi>password 'untuk melanjutkan'\n• Ketik /help 'untuk info bantuan ini'\n• Ketik /produk<spasi>Jumlah Produk 'untuk melihat info produk toko online gold & straight'\n• Ketik /kodeproduk<spasi>kode produk 'untuk melihat detail produk toko online gold & straight'\n• Ketik /berhenti<spasi>username 'untuk berhenti mendapatkan notifikasi'\n• Ketik /profil 'untuk melihat info data diri'\n\n-----------------------------------------------------------------------------------------------------\n";
							break;
				        case '/start':
				          $text = "Hai '$namamu' Selamat datang di Bot Toko Online Gold & Straight untuk bantuan silahkan ketik:/help\n";
				          $text .= 'Sistem Bot Toko Online Gold & Straight.`'.myVERSI."`\n";
				          $text .= "By Fakhrurrazi\n\n";
				          break;
				        case '/produk':
				        	if (isset($pecah[1])) {
				        		if (is_numeric($pecah[1])){
				        			# code...
				        			if ($pecah[1] > 10){
				        				# code...
				        				$text = "Maksimal adalah 5 produk";
				        			}else{
				        				$produk = mysqli_query($con, "select * from produk order by id DESC limit $pecah[1]");
							        	$text = $pecah[1]." Produk Terbaru\n";
							          	foreach ($produk as $pr){

							          		$text  .= "==========================\nNama Produk : ".$pr ['nama_produk']."\nKategori Produk : ".$pr['kategori']."\nUkuran Produk : ".$pr['ukuran_produk']."\nStock Produk : ".$pr['stock_produk']." pcs\nBerat Produk : ".$pr['berat_produk']."Kg\nKet Produk : ".$pr['ket_produk']."\nHarga Produk : Rp.".$pr['harga_produk']."\nKode Produk : ".$pr['kode_produk']."\n/kodeproduk<spasi>kode produk 'untuk melihat detail produk' ".$pr['kode_produk']."\n";
							          	}
				        			}
				        		}else{
				        			$text = "Jumlah Produk harus berupa angka, maksimalnya 5 produk";
				        		}
				      		}else{
				      			$produk = mysqli_query($con, "select * from produk order by id DESC limit 5");
						        $text ="5 Produk Terbaru\n";
						        foreach ($produk as $pr) {
						          	$text  .= "==========================\nNama Produk : ".$pr['nama_produk']."\nKategori Produk : ".$pr['kategori']."\nUkuran Produk : ".$pr['ukuran_produk']."\nStock Produk : ".$pr['stock_produk']." pcs\nBerat Produk : ".$pr ['berat_produk']."Kg\nKet Produk : ".$pr['ket_produk']."\nHarga Produk : Rp.".$pr['harga_produk']."\nKode Produk : ".$pr['kode_produk']."\n/kodeproduk<spasi>kode produk 'untuk melihat detail produk' ".$pr['kode_produk']."\n";
				      			}
				      		}	        		
				          break;
				        
				        case '/profil':
				        	$profil = mysqli_query($con, "select * from user where id_tele='$iduser'");
				          	foreach ($profil as $p) {
				          		# code...
				          		$text = "Nama Lengkap : ".$p['nama_user']."\n";
				          		$text .= "Alamat : ".$p['alamat']."\n";
				          		$text .= "Nomor HP : ".$p['no_hp'];
				          	}
				          break;

				        case '/kodeproduk':
				        	if (isset($pecah[1])) {
				        		# code...
				        		$kode_produk = mysqli_query($con, "select * from produk where kode_produk='$pecah[1]'");
					          	$count = mysqli_num_rows($kode_produk);
					          	if($count > 0){
					          		foreach ($kode_produk as $p) {
						          		# code...
						          		$text = "Kode Produk : ".$p['kode_produk']."\n";
						          		$text .= "Nama Produk : ".$p['nama_produk']."\n";
						          		$text .= "Harga Produk : Rp. ".number_format($p['harga_produk'],2,',','.')."\n";
						          		$text .= "Stok Produk : ".$p['stock_produk']." pcs";
						          	}
						          }else{
						          	$text = "Maaf kode yang anda masukan tidak tersedia silahkan periksa kembali kode produk";
						          }
				        	}else{
				        		$text = "Perintah salah, /kodeproduk<spasi>kode_produk";
				        	}
				          break;

				        case '/login':
				          if (isset($pecah[1])) {
				            if(isset($pecah[2])) {
				              error_reporting(0);
				              $user_check = mysqli_num_rows(mysqli_query($con, "select * from user where id_tele='$iduser' and username='$pecah[1]'"));
				              $username = strtoupper($pecah[1]);
					          $email = $pecah[2];
				              if($user_check > 0){
				                $text = 'Anda Sudah login';
				              }else{	
								  $q = "UPDATE user set id_tele = '$iduser' where username='$pecah[1]'";
					                if($con->query($q) == TRUE){
				                  	$text = '😘 Login Berhasil!';
				                  }else{
				                  	$text = '⛔️ *ERROR:* /login<spasi>username<spasi>email';
						            $text .= "\n\nContoh: `/login<spasi>username<spasi>email`";
				                  }
				            }
				          }
				      	}
				          break;

				        case '/berhenti':
				        		// 542393353
				              if (isset($pecah[1])) {
				              	# code...
				              	$username_cek = mysqli_num_rows(mysqli_query($con, "select * from user where username='$pecah[1]'"));
				              	if ($username_cek > 0) {
				              		# code...
				              		$text = "Anda telah berhenti untuk mendapatkan notifikasi, untuk dapat mendapatkan notifikasi kembali silahkan melakukan aktivasi ketik /login<spasi>username<spasi>email";
				              		mysqli_query($con, "UPDATE `user` set id_tele='' WHERE username = '$pecah[1]'");
				              	}else{
				              		$text = "username anda tidak di ketahui";
				              	}
				              }else{
				              	$text = "Maaf Format yang anda masukan salah.\nContoh : /berhenti<spasi>username";
				              }
				          break;

				        default:
				          $text = '😥 _aku tidak mengerti apa maksudmu, namun tetap akan kudengarkan sepenuh hatiku.._';
				          break;
				}
			}
	      }
	        } else {
	            $text = 'Sepertinya ada kesalahan, silahkan cek kembali 😘';
	        }

	        $hasil = sendMessage($idpesan, $idchat, $text);
	        if ($GLOBALS['debug']) {
	            // hanya nampak saat metode poll dan debug = true;
	      echo 'Pesan yang dikirim: '.$text.PHP_EOL;
	            print_r($hasil);
	        }
	    }
	}

// pencetakan versi dan info waktu server, berfungsi jika test hook
	echo 'Ver. '.myVERSI.' OK Start!'.PHP_EOL.date('Y-m-d H:i:s').PHP_EOL;

	function printUpdates($result)
	{
	    foreach ($result as $obj) {
	        // echo $obj['message']['text'].PHP_EOL;
	    processMessage($obj);
	        $last_id = $obj['update_id'];
	    }

	    return $last_id;
	}

	$last_id = null;
	while (true) {
		$waktu_siang = date_create('12:00');
		$waktu_malam = date_create('24:00');
		if ((date("H:i") == date_format($waktu_siang, "H:i")) || (date("H:i") == date_format($waktu_malam, "H:i"))) {
			# code...
			mysqli_query($con, "TRUNCATE `tbl_spam`");
		}
	    $result = getUpdates($last_id);
	    if (!empty($result)) {
	        echo '+';
	        $last_id = printUpdates($result);
	    } else {
	        echo '-';
	    }

	    sleep(1);
	}

?>