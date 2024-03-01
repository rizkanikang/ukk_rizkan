<style>
  #datatable-buttons {
    width: 76%;
    margin: auto;
    border-collapse: collapse;
    border: 1px solid black;
  }

  #datatable-buttons th,
  #datatable-buttons td {
    padding: 8px;
    border: 1px solid black;
  }

  #datatable-buttons th {
    background-color: white;
    color: black;
    text-align: center;
  }

  #datatable-buttons tbody tr:nth-child(odd) {
    background-color: #f2f2f2;
  }

  #datatable-buttons tbody tr:hover {
    background-color: #ddd;
  }
</style>


<table id="datatable-buttons" border="1" width="76%" class="table table-striped table-bordered">

  <thead>
    <tr>
      <th>No</th>

      <th>Nama Peminjam</th>
      <th>Nama Buku</th>
      <th>Tanggal Pinjam</th>
      <th>Tanggal Kembali</th>
      <th>Jumlah</th>
      <th>Status</th>

    </tr>
  </thead>


  <tbody>
    <?php
    $no = 1;

    foreach ($vstaf as $k) {
      ?>
      <tr>
        <td>
          <?php echo $no++ ?>
        </td>

        <td>
          <?php echo $k->nama ?>
        </td>
        <td>
          <?php echo $k->nama_b ?>
        </td>
        <td>
          <?php echo $k->tgl_pinjam ?>
        </td>
        <td>
          <?php echo $k->tgl_kembali ?>
        </td>
        <td>
          <?php echo $k->jumlah ?>
        </td>
        <td>
          <?php echo $k->status ?>
        </td>

      </tr>
      <?php
    } ?>


  </tbody>
</table>
</div>

<script>
  window.print();
</script>