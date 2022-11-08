<?= $this->extend('layout/main'); ?>
<?= $this->extend('layout/menu'); ?>

<?= $this->section('isi'); ?>
<!-- DataTables -->
<link href="<?= base_url() ?>/assets/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="<?= base_url() ?>/assets/plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<!-- Required datatable js -->
<script src="<?= base_url() ?>/assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>/assets/plugins/datatables/dataTables.bootstrap4.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>

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
      <div class="card-title">
        <button type="button" class="btn btn-primary btn0-sm tomboltambah">
          <i class="fa fa-plus-circle"></i> Tambah Data
        </button>
        <button type="button" class="btn btn-info btn0-sm tomboltambahbanyak">
          <i class="fa fa-plus-circle"></i> Tambah Banyak Data
        </button>
      </div>
      <p class="card-text viewdata">
      
      </p>
    </div>
  </div>
</div>
<div class="viewmodal" style="display: none;"></div>
<script>
  function datamahasiswa() {
    $.ajax({
      url: "<?= site_url('mahasiswa/ambildata') ?>",
      dataType: "json",
      success: function(response) {
        $('.viewdata').html(response.data)
      },
      error: function(xhr, ajaxOptions, thrownError) {
        alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
      }
    })
  }

  $(document).ready(function() {
    datamahasiswa();

    $(".tomboltambah").click(function(e) {
      e.preventDefault();
      $.ajax({
        url: "<?= site_url('mahasiswa/formtambah') ?>",
        dataType: "json",
        success: function(response) {
          $('.viewmodal').html(response.data).show();
          $('#modaltambah').modal('show');
        },
        error: function(xhr, ajaxOptions, thrownError) {
          alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
      });
    });

    $('.tomboltambahbanyak').click(function(e) {
      e.preventDefault();
      $.ajax({
        url: "<?= site_url('mahasiswa/formtambahbanyak') ?>",
        dataType: "json",
        beforeSend: function() {
          $('viewdata').html('<i class="fa fa-spin fa-spinner"></i>')
        },
        success: function(response) {
          $('.viewdata').html(response.data).show();
        },
        error: function(xhr, ajaxOptions, thrownError) {
          alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
      });
    });
  });
</script>

<?= $this->endSection(); ?>