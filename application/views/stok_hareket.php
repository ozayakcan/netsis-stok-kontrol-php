
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
<table id="stok-tablo" class="table display responsive nowrap">
  <thead>
    <tr>
      <th scope="col">STOK KODU</th>
      <th scope="col">STOK ADI</th>
      <th scope="col">ALIŞ FİYATLARI</th>
      <th scope="col">SATIŞ FİYATLARI</th>
      <th scope="col">KDV (%)</th>
      <th scope="col">ÖLÇÜ BİRİMLERİ</th>
      <th scope="col">KAYIT TARİHİ</th>
    </tr>
  </thead>
</table>
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
    $.fn.dataTable.ext.errMode = 'none';
    $('#stok-tablo').DataTable({
      "searching": false,
      "ordering": false,
      "order": [[6, 'desc']],
      "processing": true,
      "serverSide": true,
      "ajax": {
          url: '<?=base_url("stok/json");?>',
          type: 'POST',
          data: {
            '<?=$this->Stok_Model->stokKodu;?>': '<?=$kod;?>'
          }
      },
      "responsive": true,
      "autoWidth": false,
      "dom": 't',
      "pageLength": 50
    });
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