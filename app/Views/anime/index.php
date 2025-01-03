<?=$this->extend('layout/template'); ?>
<?=$this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col">
          <a href="/anime/create" class="btn btn-primary mt-3">Tambah Data Anime</a>
            <h1 class="mt-2">Daftar Anime</h1>
            <?php if(session()->getFlashdata('pesan')): ?>
              <div class="alert alert-success" role="alert"><?= session()->getFlashdata('pesan'); ?></div>
            <?php endif; ?>
        <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Sampul</th>
      <th scope="col">Judul</th>
      <th scope="col">Aksi</th>
    </tr>
  </thead>
  <tbody>
    <?php $i=1; ?>
    <?php foreach($anime as $a): ?>
    <tr>
      <th scope="row"><?=$i++; ?></th>
      <td><img src="/img/<?=$a['sampul']?>" alt="" class="sampul"></td>
      <td><?=$a['judul']?></td>
      <td><a href="/anime/<?=$a['slug']?>" class="btn btn-success">Detail</a></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
        </div>
    </div>
</div>
<?=$this->endSection(); ?>