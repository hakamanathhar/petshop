<?php
	include ("../config/connect.php");
	if(isset($_POST['submit'])){
		$id = $_POST['id'];
		$first_name = $_POST['first_name'];
		$last_name = $_POST['last_name'];
		$alamat = $_POST['alamat'];
		$email = $_POST['email'];
		$lahir = $_POST['lahir'];
		$password = md5($_POST['password']);
		$password_confirm = md5($_POST['password-confirm']);
		$province = $_POST['provinsi'];
		$city = $_POST['city'];
		$postal_code = $_POST['postal_code'];

		$gbr = $_POST['gbr'];
		$lokasi = $_FILES['gambar']['tmp_name'];
		$nama_gambar = $_FILES['gambar']['name'];
		$direktori = "../../images/$nama_gambar";
		$lokasi_gbr = "../../images/".$gbr;

		if (empty($first_name) || empty($last_name) || empty($email) || empty($password) || empty($password_confirm) || empty($lahir) || empty($alamat) || empty($province) || empty($city) || empty($postal_code) || $password != $password_confirm) {
			echo '<script language = "javascript"> 
			alert("Isi Data Dengan Benar");
			document.location="../register.php"</script>';
		} else if(!empty($lokasi)){
			
			if (file_exists($lokasi_gbr)) {
				unlink($lokasi_gbr);
			}

			$sql = "UPDATE user SET nama_depan = '$first_name', nama_belakang='$last_name', alamat = '$alamat', email ='$email', tanggal_lahir = '$lahir', password = '$password', id_provinsi = '$province', id_kota = '$city',postal_code = '$postal_code',gambar ='$nama_gambar'  WHERE id ='$id'"
			$q= mysqli_query($con,$sql);
			if ($q) {
				move_uploaded_file($lokasi, $direktori);
				echo '<script language = "javascript"> 
				alert("Success!");
				document.location="../penjual_daftarProduk.php"</script>';
			}else{
				echo '<script language = "javascript"> 
				alert("Fail!");
				document.location="../penjual_daftarProduk.php"</script>';
			}
		}else{

		}
	}


?>