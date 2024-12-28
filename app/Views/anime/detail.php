<?=$this->extend('layout/template'); ?>
<?=$this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col">
            <h1 class="mt-2">Detail Anime</h1>
        <div class="card mb-3" style="max-width: 540px;">
  <div class="row no-gutters">
    <div class="col-md-4">
      <img src="/img/<?=$anime['sampul']?>" class="card-img" alt="...">
    </div>
    <div class="col-md-8">
      <div class="card-body">
        <h5 class="card-title"><?=$anime['judul']; ?></h5>
        <p class="card-text"><b>Penulis : </b><?=$anime['penulis']; ?>.</p>
        <p class="card-text"><small class="text-muted"><b>Penerbit : </b></small><?=$anime['penerbit']; ?></p>
        <p class="card-text"><small class="text-muted"><b>Keterangan : </b></small><?=$anime['keterangan']; ?></p>
        <a href="/anime/edit/<?=$anime['slug'];?>" class="btn btn-warning">Edit</a>
        <form action="/anime/<?=$anime['id']?>" method="post" class="d-inline">
          <?=csrf_field(); ?>
          <input type="hidden" name="_method" value="DELETE"> <!--method post pada form akan diganti dengan value ini -->
          <button type="submit" class="btn btn-danger" onclick="return confirm('apakah anda yakin')">Delete</button>
        </form>
        <br><br>
        <a href="/anime">Kembali ke Daftar Anime</a>
      </div>
    </div>
  </div>
</div>
        </div>
    </div>
</div>
<?=$this->endSection(); ?>