
<div class="container-fluid">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-lg-6 grid-margin stretch-card">
            <?php 
                if(session()->getFlashdata('sukses')){
                echo '<div class="alert alert-success alert-dismissible">
                <h6><i class="icon fas fa-check"></i> Berhasil</h6>';
                // echo $info;
                echo session()->getFlashdata('sukses');
                echo '</div>';
                }
                ?>
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title"><?= $table?></h4>
                  <p class="card-description">
                    <button type="button" class="btn btn-outline-success btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="mdi mdi-plus-circle"></i>Add Alternatif</button>
                  </p>
                  <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Alternatif</th>
                          <th>Kode</th>
                          <th>Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php $no = 1;
                      $kode = 1;
                      foreach($alt as $key => $value){?>
                        <tr>
                          <td><?= $no++?></td>
                          <td><?= $value['nama_alternatif']?></td>
                          <td>A<?= $kode++?></td>
                          <td>
                            <!-- Tomobol Modal Edit Alternatif -->
                            <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editAlter<?= $value['id']?>"><i class="ti ti-edit"></i></button>
                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#hapusAlter<?= $value['id']?>"><i class="ti ti-trash"></i></button>
                          </td>
                        </tr>
                        <?php } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>


            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Data Kriteria Penilaian Keputusan</h4>
                  <div class="card-description">
                    <div class="d-flex justify-content-end mb-3" role="group" aria-label="Tombol Aksi">
                        <button type="button" class="btn btn-outline-success btn-sm" data-bs-toggle="modal" data-bs-target="#tambahkriteriamodal" style="margin-right: 5px;">
                            Add Kriteria
                        </button>
                        <!-- Tombol Hitung -->
                        <a href="<?= base_url('Saw/Hitung') ?>" class="btn btn-outline-primary btn-sm" style="margin-left: 5px;">
                          Hitung 
                        </a>
                    </div>
                </div>
                <div class="table-responsive">
                <?php 
                if(session()->getFlashdata('pesan')){
                echo '<div class="alert alert-success alert-dismissible">
                <h6><i class="icon fas fa-check"></i> Berhasil</h6>';
                // echo $info;
                echo session()->getFlashdata('pesan');
                echo '</div>';
                }
                ?>
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th width="20px">No</th>
                          <th>Kriteria</th>
                          <th>Deskripsi</th>
                          <th>Bobot</th>
                          <th>Atribut</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $no = 1;
                        $kode = 1;
                        foreach($krt as $key => $value){?>
                        <tr>
                          <td><?= $no++?></td>
                          <td><?= $value['nama_kriteria']?></td>
                          <td class="text-small"><?= $value['penjelasan_kriteria']?></td>
                          <td><?= $value['bobot_kriteria']?></td>
                          <td>
                          <?php if ($value['kategori_bobot'] === 'Benefit') : ?>
                            <span class="badge rounded-pill bg-success"><?= $value['kategori_bobot'] ?></span>
                            <?php elseif ($value['kategori_bobot'] === 'Cost') : ?>
                                <span class="badge rounded-pill bg-danger"><?= $value['kategori_bobot'] ?></span>
                            <?php else : ?>
                                <span class="badge badge-secondary"><?= $value['kategori_bobot'] ?></span>
                          <?php endif; ?>
                          </td>
                          <td>
                            <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editkriteriamodal<?= $value['id']?>"><i class="ti ti-edit"></i></button>
                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#hapuskriteria<?= $value['id']?>"><i class="ti ti-trash"></i></button>
                          </td>
                        </tr>
                        <?php } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
</div>
</div>



<!-- Add Alternatif -->
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="form-group">
        <?php echo form_open(base_url('Saw/TambahAlternatif/'));?>
          <label for="" class="mb-2"> Nama Alternatif</label>
          <input type="text" class="form-control" name="alternatif" placeholder="Masukkan brand Make up">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
<?php echo form_close();?>

<!-- Add Kriteria -->
<div class="modal fade" id="tambahkriteriamodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Kriteria</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="<?= base_url() ?>Saw/TambahKriteria">
                  <div class="container">
                      <div class="form-group">
                        <label class="mb-2">Nama Kriteria</label>
                        <input type="text" required name="nama_kriteria" class="form-control" placeholder="Masukan Kriteria"><br>
                        <textarea class="form-control" name="penjelasan_kriteria" rows="4" placeholder="Masukan Penjelasan Mengenai Kriteria Kriteria"></textarea>
                        <small id="deskripsi" class="form-text text-muted">Masukan kriteria untuk menentukan pembobotan.</small>
                      </div>
                    <div class="form-group mt-4">
                        <label for="exampleInputEmail1">Bobot Kriteria</label>
                        <select class="form-control" name="bobot_kriteria" id="exampleFormControlSelect1" required>
                            <option selected disabled value="">Pilih Bobot Kriteria</option>
                            <option value="0.1">Rendah</option>
                            <option value="0.15">Cukup</option>
                            <option value="0.2">Tinggi</option>
                            <option value="0.25">Sangat Tinggi</option>
                        </select>
                        <span id="deskripsi" class="form-text text-muted mt-4">Kategori Bobot Kriteria Penjelasan:
                            <ol>
                                <li>0.1 = Rendah</li>
                                <li>0.15 = Cukup</li>
                                <li>0.2 = Tinggi</li>
                                <li>0.25 = Sangat Tinggi</li>
                            </ol>
                        </span>
                    </div>
                    <div class="form-group">
                        <label>Kategori Bobot(Cost/Benefit)</label>
                        <select class="form-control" name="kategori_kriteria" id="exampleFormControlSelect1" required>
                            <option selected disabled value="">Pilih Kategori Bobot</option>
                            <option>Cost</option>
                            <option>Benefit</option>
                        </select>
                        <small id="deskripsi" class="form-text text-muted mt-5">Jika cost maka semakin kecil nilai semakin bagus, jika benefit maka semakin besar nilai semakin bagus.</small>
                    </div>
                  </div>  
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Tambah Kriteria</button>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Edit Alternatif -->
<?php foreach($alt as $key => $value){?>
  <div class="modal fade" id="editAlter<?= $value['id']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Alternatif</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?php echo form_open(base_url('Saw/editAlternatif/' . $value['id']));?>
                  <div class="container form-group">
                     <label for="">Nama Alternatif</label>
                     <input type="text" class="form-control" name="test" value="<?= $value['nama_alternatif']?>" placeholder="Edit Alternatif" required>
                  </div>  
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Edit Alternatif</button>
                <?php echo form_close();?>
            </div>
        </div>
    </div>
</div>
<?php } ?>


<!-- Hapuss Alternatif -->
<?php foreach($alt as $key => $value){?>
  <div class="modal fade" id="hapusAlter<?= $value['id']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Hapus Alternatif</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?php echo form_open(base_url('Saw/hapusAlternatif/' . $value['id']));?>
                  <div class="form-group text-center">
                    <input type="hidden" value="<?= $value['id']?>">
                    Anda yakin ingin menghapus alternatif <b><?= $value['nama_alternatif']?></b> ?
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Hapus Alternatif</button>
                <?php echo form_close();?>
            </div>
        </div>
    </div>
</div>
<?php } ?>

<!-- Hapuss Kriteria -->
<?php foreach($krt as $key => $value){?>
  <div class="modal fade" id="hapuskriteria<?= $value['id']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Hapus Kriteria</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?php echo form_open(base_url('Saw/hapusKriteria/' . $value['id']));?>
                  <div class="form-group text-center">
                    <input type="hidden" value="<?= $value['id']?>">
                    Anda yakin ingin menghapus kriteria <b><?= $value['nama_kriteria']?> </b> dengan kategori pembobotan <b><?= $value['kategori_bobot']?></b> ?
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Hapus Kriteria</button>
                <?php echo form_close();?>
            </div>
        </div>
    </div>
</div>
<?php } ?>


<!-- Edit Kriteria -->
<?php foreach($krt as $key => $value){?>
<div class="modal fade" id="editkriteriamodal<?= $value['id']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Kriteria</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <?php echo form_open(base_url('Saw/EditKriteria/' . $value['id']));?>
                  <div class="container">
                      <div class="form-group">
                        <label class="mb-2">Nama Kriteria</label>
                        <input type="text" required name="nama_kriteria" class="form-control" placeholder="Masukan Kriteria" value="<?= $value['nama_kriteria']?>"><br>
                        <textarea class="form-control" name="penjelasan_kriteria" rows="4" placeholder="Masukan Penjelasan Mengenai Kriteria Kriteria"><?= $value['penjelasan_kriteria']?></textarea>
                        <small id="deskripsi" class="form-text text-muted">Masukan kriteria untuk menentukan pembobotan.</small>
                      </div>
                    <div class="form-group mt-4">
                        <label for="exampleInputEmail1">Bobot Kriteria</label>
                        <select class="form-control" name="bobot_kriteria" id="exampleFormControlSelect1"  required>
                            <option><?= $value['bobot_kriteria']?></option>
                            <option value="0.1">Rendah</option>
                            <option value="0.15">Cukup</option>
                            <option value="0.2">Tinggi</option>
                            <option value="0.25">Sangat Tinggi</option>
                        </select>
                        <span id="deskripsi" class="form-text text-muted mt-4">Kategori Bobot Kriteria Penjelasan:
                            <ol>
                                <li>0.1 = Rendah</li>
                                <li>0.15 = Cukup</li>
                                <li>0.2 = Tinggi</li>
                                <li>0.25 = Sangat Tinggi</li>
                            </ol>
                        </span>
                    </div>
                    <div class="form-group">
                        <label>Kategori Bobot(Cost/Benefit)</label>
                        <select class="form-control" name="kategori_kriteria" id="exampleFormControlSelect1" required>
                            <option><?= $value['kategori_bobot']?></option>
                            <option>Cost</option>
                            <option>Benefit</option>
                        </select>
                        <small id="deskripsi" class="form-text text-muted mt-5">Jika cost maka semakin kecil nilai semakin bagus, jika benefit maka semakin besar nilai semakin bagus.</small>
                    </div>
                  </div>  
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Tambah Kriteria</button>
                <?php echo form_close();?>
            </div>
        </div>
    </div>
</div>
<?php } ?>