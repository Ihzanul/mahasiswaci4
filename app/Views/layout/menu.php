<?= $this->extend('layout/main'); ?>

<?= $this->section('menu'); ?>

<li class="has-submenu">
  <a href="<?= site_url('layout'); ?>"><i class="mdi mdi-airplay"></i>Beranda</a>
</li>
<li class="has-submenu">
  <a href="<?= site_url('mahasiswa'); ?>"></i>Mahasiswa</a>
</li>

<?= $this->endSection(); ?>