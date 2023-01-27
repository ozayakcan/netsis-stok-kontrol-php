
<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<html lang="en">
    <head>
<?php
$this->load->view("inc/meta");
$this->load->view("inc/styles/default");
$baslik = $kod . ' Stok Hareketleri';
?>
        <title><?=$baslik;?></title>
    </head>
    <body data-bs-theme="dark">
<?php
$this->load->view("inc/nav", array("baslik" => $baslik, "geri" => true));
?>
<?php
$this->load->view("inc/scripts/default");
?>
    </body>
</html>