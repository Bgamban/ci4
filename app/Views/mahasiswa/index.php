<?=$this->extend('layout/template'); ?>
<?=$this->section('content'); ?>
<div class="container">
  <div class="row">
    <div class="col-6">
      <h1 class="mt-2">Daftar Mahasiswa</h1>
      <form action="" method="post">
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Masukkan Keyword Pencarian" aria-label="Masukkan Keyword Pencarian" aria-describedby="Masukkan Keyword Pencarian" name="keyword">
          <div class="input-group-append">
        <button class="btn btn-outline-secondary" type="submit" id="submit" name="submit">Cari</button>
      </div>
    </div>
    </form>
  </div>
</div>
    <div class="row">
        <div class="col">
        <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Nama</th>
      <th scope="col">Alamat</th>
      <th scope="col">Aksi</th>
    </tr>
  </thead>
  <tbody>
    <?php $i=1 + (6 * ($currentPage - 1)); ?>
    <?php foreach($mahasiswa as $m): ?>
    <tr>
      <th scope="row"><?=$i++; ?></th>
      <td><?=$m['nama']; ?></td>
      <td><?=$m['alamat']?></td>
      <td><a href="" class="btn btn-success"></a>Detail</td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
<?=$pager->links('mahasiswa', 'pagination'); ?>
        </div>
    </div>
</div>
<?=$this->endSection(); ?>