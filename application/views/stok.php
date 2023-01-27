
<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<html lang="en">
    <head>
<?php
$this->load->view("inc/meta");
$this->load->view("inc/styles/default");
$baslik = 'Stok Kontrolü';
?>
        <title><?=$baslik;?></title>
    </head>
    <body data-bs-theme="light">
<?php
$this->load->view("inc/nav", array("baslik" => $baslik));
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
      <th scope="col">HAREKETLER</th>
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
      "searching": true,
      "ordering": false,
      "order": [[6, 'desc']],
      "processing": true,
      "serverSide": true,
      "ajax": {
          url: '<?=base_url("stok/json");?>',
          type: 'POST'
      },
      "responsive": true,
      "autoWidth": false,
      "dom": 'ftipr',
      "pageLength": 50,
      "language": {
          url: "<?=base_url("assets/json/datatables-stok-tr.json");?>"
      }
    });
});
</script>
    </body>
</html>