<?php
date_default_timezone_set('America/Sao_Paulo');
setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
session_start();

$url = $_SERVER['REQUEST_URI'];
$particao = explode('/', $url);
$rotina = end($particao);
$pastaRotinas = "pages/";


if ($rotina == null) {
	require "/login";
} else {
	if (file_exists("pages/" . $rotina . ".php")) {

       require $pastaRotinas . $rotina . ".php";


        // if (isset($_SESSION['user'])) {
        //     require $pastaRotinas . $rotina . ".php";

        // } else {
        //     header("location: login");
           
        // }
        

	} else {
        session_destroy();
		require $pastaRotinas . "404.php";
	}
}

?>