<?= $this->extend('layout/main'); ?>
<?= $this->extend('layout/menu'); ?>

<?= $this->section('isi'); ?>

<div class="row">
  <div class="col-sm-12">
    <div class="page-title-box">
      <h4 class="page-title">Selamat Datang</h4>
    </div>
  </div>
</div>

<div class="col-sm-12">
  <div class="card m-b-30">
    <h4 class="card-header mt-0">Halo</h4>
    <div class="card-body">
      <p class="card-text">
        <div class="alert alert-info">
          Ini Hasil Latihan saya membuat CRUD di CI 4 AJAX
        </div>
      </p>
    </div>
  </div>
</div>

<?= $this->endSection(); ?>