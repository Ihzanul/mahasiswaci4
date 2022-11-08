<?= form_open('mahasiswa/simpandatabanyak', ['class' => 'formsimpanbanyak']); ?>
<?= csrf_field(); ?>
<p>
  <button class="btn btn-warning btnkembali">
    Kembali
  </button>
  <button type="submit" class="btn btn-success btnsimpanbanyak">
    Simpan Data
  </button>
</p>
<table class="table table-sm table-bordered">
  <thead>
    <tr>
      <th>No. BP</th>
      <th>Nama Mahasiswa</th>
      <th>Tempat Lahir</th>
      <th>Tanggal Lahir</th>
      <th>Jenis Kelamin</th>
      <th>Aksi</th>
    </tr>
  </thead>

  <tbody class="tabeltambah">
    <tr>
      <td>
        <input type="text" name="nobp[]" class="form-control">
      </td>
      <td>
        <input type="text" name="nama[]" class="form-control">
      </td>
      <td>
        <input type="text" name="tmplahir[]" class="form-control">
      </td>
      <td>
        <input type="date" name="tgllahir[]" class="form-control">
      </td>
      <td>
        <select name="jenkel[]" class="form-control">
          <option value="L">Laki-Laki</option>
          <option value="P">Perempuan</option>
        </select>
      </td>
      <td>
        <button class="btn btn-primary btnaddform">
          <i class="fa fa-plus"></i>
        </button>
      </td>
    </tr>
  </tbody>
</table>
<?= form_close(); ?>

<script>
  $(document).ready(function(e){
    $('.formsimpanbanyak').submit(function(e) {
      e.preventDefault();
      $.ajax({
        type: "post",
        url: $(this).attr('action'),
        data: $(this).serialize(),
        dataType: "json",
        beforeSend: function() {
          $('.btnsimpanbanyak').attr('disable', 'disabled');
          $('.btnsimpanbanyak').html('<i class="fa fa-spin fa spinner"></i>');
        },
        complete: function() {
          $('.btnsimpanbanyak').removeAttr('disable');
          $('.btnsimpanbanyak').html('Simpan');
        },
        success: function(response) {
          if(response.sukses) {
            Swal.fire({
              icon: 'success',
              title: 'Berhasil',
              html: `${response.sukses}`,
            }).then((result) => {
              if (result.isConfirmed) {
                window.location.href = ("<?= site_url('mahasiswa'); ?>")
              }
            })
          }
        },
        error: function(xhr, ajaxOptions, thrownError) {
          alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
      })

      return false;
    });

    $('.btnaddform').click(function(e){
      e.preventDefault();

      $('.tabeltambah').append(`
      <tr>
        <td>
          <input type="text" name="nobp[]" class="form-control">
        </td>
        <td>
          <input type="text" name="nama[]" class="form-control">
        </td>
        <td>
          <input type="text" name="tmplahir[]" class="form-control">
        </td>
        <td>
          <input type="date" name="tgllahir[]" class="form-control">
        </td>
        <td>
          <select name="jenkel[]" class="form-control">
            <option value="L">Laki-Laki</option>
            <option value="P">Perempuan</option>
          </select>
        </td>
        <td>
          <button class="btn btn-danger btndeleteform">
            <i class="fa fa-trash"></i>
          </button>
        </td>
      </tr>
      `);
    });

    $('.btnkembali').click(function(e){
      e.preventDefault();

      datamahasiswa();
    });
  });

  $(document).on('click', '.btndeleteform', function(e) {
    e.preventDefault();

    $(this).parents('tr').remove();
  });
</script>