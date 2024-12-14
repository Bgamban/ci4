<?=$this->extend('layout/template'); ?>
<?=$this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-8">
            <h2 class="my-3">Form Ubah Data Anime</h2>
            
            <form action="/anime/update/<?=$anime['id']; ?>" method="post" enctype="multipart/form-data">
                <?=$csrf_field(); ?>
                <input type="hidden" name="slug" value="<?=$anime['slug']?>">
                <input type="hidden" name="sampulLama" value="<?=$anime['sampul']?>">
  <div class="form-group row">
    <label for="judul" class="col-sm-2 col-form-label">Judul</label>
    <div class="col-sm-10">
      <input type="text" class="form-control<?=($validation->hasError['judul'])? 'is-invalid' : '' ; ?>" id="judul" name="judul" autofocus value="<?=(old("judul"))? old('judul') : $anime['judul']?>">
      <div id="validationServer03Feedback" class="invalid-feedback">
        <?=$validation->getError('judul'); ?>
      </div>
    </div>
  </div>
  <div class="form-group row">
    <label for="penulis" class="col-sm-2 col-form-label">Penulis</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="penulis" name="penulis" value="<?=(old("penulis"))? old('penulis') : $anime['penulis']?>">
    </div>
  </div>
  <div class="form-group row">
    <label for="penerbit" class="col-sm-2 col-form-label">Penerbit</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="penerbit" name="penerbit" value="<?=(old("penerbit"))? old('penerbit') : $anime['penerbit']?>">
    </div>
  </div>
  <div class="form-group row">
    <label for="sampul" class="col-sm-2 col-form-label">Sampul</label>
    <div class="col-sm-2">
      <img src="/img/<?=$anime['sampul']; ?>" class="img-thumbnail img-preview">
    </div>
    <div class="col-sm-8">
    <div class="custom-file">
  <input type="file" class="custom-file-input <?=($validation->hasError['sampul'])? 'is-invalid' : '' ; ?>" id="sampul" name="sampul" onchange="previewImg()">
  <div id="validationServer03Feedback" class="invalid-feedback">
        <?=$validation->getError('sampul'); ?>
  </div>
  <label class="custom-file-label" for="sampul"></label>
</div>
    </div>
  </div>
  <div class="form-group row">
    <div class="col-sm-10">
      <button type="submit" class="btn btn-primary">Ubah Data</button>
    </div>
  </div>
</form>
        </div>
    </div>
</div>
<?=$this->endSection(); ?>