
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
<table id="stok-hareket-tablo" class="table display responsive nowrap">
  <thead>
    <tr>
      <th scope="col">TARİH</th>
      <th scope="col">FİŞ NO</th>
      <th scope="col">NET FİYAT</th>
      <th scope="col">GİRİŞ MİKTARI</th>
      <th scope="col">ÇIKIŞ MİKTARI</th>
      <th scope="col">BAKİYE</th>
      <th scope="col">AÇIKLAMA</th>
    </tr>
  </thead>
</table>
<?php
$this->load->view("inc/scripts/default");
?>
<script>
$(document).ready(function(){
    $('#stok-hareket-tablo').DataTable({
      "searching": true,
      "ordering": false,
      "order": [[6, 'desc']],
      "processing": true,
      "serverSide": true,
      "ajax": {
          url: '<?=base_url("stok/hareket_json/".$kod);?>',
          type: 'POST'
      },
      "responsive": true,
      "autoWidth": false,
      "dom": 'ftipr',
      "pageLength": 50
    });
});
</script>
    </body>
</html>