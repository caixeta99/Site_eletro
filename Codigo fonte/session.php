<?php 

session_start();
  
if ((empty($_SESSION['ID_Eletro_JBLF_Mococa_Site_Usuario'])) || (empty($_SESSION['Nome_Eletro_JBLF_Mococa_Site_Usuario']))){

	die(header('location:admin_login.php'));
		
}
