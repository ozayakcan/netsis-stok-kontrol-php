<?php
$geri_butonu = false;
if (isset($geri)) {
    $geri_butonu = $geri;
}
?>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <span class="navbar-brand">
<?php
if ($geri_butonu) {
?>
        <a class="navbar-brand" href="javascript:;" onclick="history.back();">
          <i class="fa fa-arrow-left" aria-hidden="true"></i>
        </a>
<?php
}
?>
      <?=$baslik;?>
    </span>
  </div>
</nav>