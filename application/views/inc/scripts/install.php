<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<?php
if (ENVIRONMENT == "production") {
?>
    <script src="<?= base_url('assets/js/install.min.js'); ?>"></script>
<?php
} else {
?>
    <script src="<?= base_url('assets/js/install_wtgd.js'); ?>"></script>
<?php
}
?>