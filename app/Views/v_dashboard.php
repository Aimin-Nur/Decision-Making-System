<?php
use App\Models\ModelKriteria;
$ModelKriteria = new ModelKriteria();
?>



<div class="container-fluid">
  <div class="container-fluid">
    <div class="col-md-4">
      <h5 class="card-title fw-semibold mb-4">Selamat Datang</h5>
        <div class="card">
          <div class="card-header">
            Featured
          </div>
          <div class="card-body">
            <h5 class="card-title">SAW METHOD</h5>
            <p class="card-text">SAW (Simple Additive Weighting) adalah salah satu metode yang digunakan dalam analisis pemilihan keputusan. </p>
            <a href="<?= base_url('Saw')?>" class="btn btn-primary">Metode SAW</a>
          </div>
        </div>
      </div>
  </div>
</div>

<style>
  .card-text {
        font-size: 1rem;
        margin-bottom: 20px; /* Atur jarak bawah paragraf */
    }
</style>


<div class="container-fluid">
        <!--  Row 1 -->
        <div class="row">
          <div class="col-lg-8 d-flex align-items-strech">
            <div class="card w-100">
              <div class="card-body">
                <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                  <div class="mb-3 mb-sm-0">
                    <h5 class="card-title fw-semibold">Bobot Kriteria</h5>
                  </div>
                  <div>
                  </div>
                </div>
                <div id="chartContainer">
                  <canvas id="chart">
                  </canvas>
                </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-4 d-flex align-items-stretch">
              <div class="card w-100">
                <div class="card-body p-4">
                  <div class="mb-4">
                    <h5 class="card-title fw-semibold">History Keputusan Brand Terpilih</h5>
                  </div>
                  <?php foreach($hst as $key => $value){?>
                  <ul class="timeline-widget mb-0 position-relative mb-n5">
                    <li class="timeline-item d-flex position-relative overflow-hidden">
                      <div class="timeline-time text-dark flex-shrink-0 text-end"><?= $value['tanggal_penghitungan']?></div>
                      <div class="timeline-badge-wrap d-flex flex-column align-items-center">
                        <span class="timeline-badge border-2 border border-danger flex-shrink-0 my-8"></span>
                        <span class="timeline-badge-border d-block flex-shrink-0"></span>
                      </div>
                      <div class="timeline-desc fs-3 text-dark mt-n1 fw-semibold"><?= $value['alternatif_terpilih']?> 
                      </div>
                    </li>
                    <li class="timeline-item d-flex position-relative overflow-hidden">
                    
                      
                    </li>
                  </ul>
                  <?php } ?>
                </div>
              </div>
            </div>
            <div class="col-lg-8 d-flex align-items-stretch">
              <div class="card w-100">
                <div class="card-body p-4">
                  <h5 class="card-title fw-semibold mb-4">Data Kriteria</h5>
                  <div class="table-responsive">
                    <table class="table text-nowrap mb-0 align-middle">
                      <thead class="text-dark fs-4">
                        <tr>
                          <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">No</h6>
                          </th>
                          <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">Kriteria</h6>
                          </th>
                          <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">Kode</h6>
                          </th>
                          <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">Kategori</h6>
                          </th>
                          <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">Bobot</h6>
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $no=1;
                        $c=1;
                         foreach($krt as $key => $value){ ?>
                        <tr>
                          <td class="border-bottom-0"><h6 class="fw-semibold mb-0"><?= $no++ ?></h6></td>
                          <td class="border-bottom-0">
                              <h6 class="fw-semibold mb-1"><?= $value['nama_kriteria']?></h6>                         
                          </td>
                          <td class="border-bottom-0">
                            <p class="mb-0 fw-normal">A<?=$c++?></p>
                          </td>
                          <td class="border-bottom-0">
                            <div class="d-flex align-items-center gap-2">
                            <?php if ($value['kategori_bobot'] === 'Benefit') : ?>
                            <span class="badge rounded-pill bg-primary"><?= $value['kategori_bobot'] ?></span>
                            <?php elseif ($value['kategori_bobot'] === 'Cost') : ?>
                                <span class="badge rounded-pill bg-danger"><?= $value['kategori_bobot'] ?></span>
                            <?php else : ?>
                                <span class="badge badge-secondary"><?= $value['kategori_bobot'] ?></span>
                          <?php endif; ?>
                            </div>
                          </td>
                          <td class="border-bottom-0">
                            <h6 class="fw-semibold mb-0 fs-4"><?= $value['bobot_kriteria']?></h6>
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

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  
  const dataFromDatabase = <?= json_encode($ModelKriteria->AllData()) ?>;

  // data untuk chart
  const labels = dataFromDatabase.map(item => item.nama_kriteria);
  const values = dataFromDatabase.map(item => item.bobot_kriteria);

  
  function createChart(data) {
    const ctx = document.getElementById('chart').getContext('2d');
    const myChart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: data.labels,
        datasets: [{
          label: 'Bobot',
          data: data.values,
          backgroundColor: 'rgba(99, 158, 224, 0.3)',
          borderColor: 'rgba(99, 158, 224, 0.3)',
          borderWidth: 1,
        }],
      },
      options: {
        scales: {
          y: {
            beginAtZero: true,
          },
        },
      },
    });
  }

  // Inisialisasi chart pertama kali
  createChart({ labels, values });
</script>