<div class="container-fluid">
  <div class="container-fluid">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title fw-semibold mb-4">Tabel Kriteria</h5>
        <div class="table-responsive">
          <table class="table table-striped">
            <thead class="table-dark text-center">
              <tr>
                <th style="width: 20%;">Nama Kriteria</th>
                <th style="width: 50%;">Penjelasan Kriteria</th>
                <th style="width: 10%;">Bobot Kriteria</th>
                <th style="width: 15%;">Cost/Benefit</th>
              </tr>
            </thead>
            <tbody>
              <script>
                var bobot = [];
                var kategori_bobot = [];
                var nama_alternatif = [];
              </script>
              <?php
              $no = 1;
              foreach ($krt as $k) {
              ?>
                <script>
                  bobot.push(<?= $k['bobot_kriteria'] ?>);
                  kategori_bobot.push('<?= $k['kategori_bobot'] ?>');
                </script>
                <tr class="text-center">
                  <td><?= $k['nama_kriteria'] ?> - C<?= $no ?></td>
                  <td><?= $k['penjelasan_kriteria'] ?></td>
                  <td><?= $k['bobot_kriteria'] ?></td>
                  <td><?= $k['kategori_bobot'] ?></td>
                </tr>
              <?php
                $no++;
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <div class="card mt-4">
      <div class="card-body">
        <h5 class="card-title fw-semibold mb-4">Tabel Pengisian Data</h5>
        <?php
        if (!empty($krt) && $alt > 1) {
        ?>
          <div class="table-responsive">
            <table class="table table-bordered text-center">
              <thead class="table-dark">
                <tr>
                  <th scope="col">No</th>
                  <th style="width: 15%;">Nama Brand</th>
                  <?php for ($i = 1; $i <= count($krt); $i++) { ?>
                    <th>C<?= $i ?></th>
                  <?php } ?>
                </tr>
              </thead>
              <tbody>
                <?php
                $no = 1;
                foreach ($alt as $alter) {
                ?>
                  <tr>
                    <td><?= $no ?></td>
                    <script>
                      nama_alternatif.push('<?= $alter['nama_alternatif'] ?>');
                    </script>
                    <td class="mb-1"><?= $alter['nama_alternatif'] ?></td>
                    <?php for ($i = 1; $i <= count($krt); $i++) { ?>
                      <td>
                        <div class="form-group">
                          <input class="form-control" type="number" min="0" required id="P<?= $no ?>C<?= $i ?>">
                        </div>
                      </td>
                    <?php } ?>
                  </tr>
                <?php
                  $no++;
                }
                ?>
              </tbody>
            </table>
          </div>
          <button type="button" class="btn btn-info" onclick="return hitungData();">Hitung Data</button>
        <?php } ?>
      </div>
    </div>

    <div class="row mt-4">
      <div class="col-lg-12" id="tabel_normalisasi">

      </div>
    </div>

    <div class="row mt-4">
      <div class="col-lg-12" id="tabel_faktor_ternormalisasi">

      </div>
    </div>

    <div class="row mt-4">
      <div class="col-lg-12" id="finishing_div">

      </div>
    </div>
  </div>
</div>

<!--Lib Jquery  -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
 
<script>
    var base_url = '<?= base_url() ?>';
</script>

<script>
    function hitungData() {
        var element = document.getElementById("hitung_data");
        if (element) {
            element.parentNode.removeChild(element);
        }

        let jumlahAlternatif = <?= count($alt) ?>;
        let jumlahKriteria = <?= count($krt) ?>;

        //set bobot
        var noBobot = 1;
        for (let i = 0; i < bobot.length; i++) {
            window['B' + noBobot] = bobot[i];
            noBobot++;
        }
        //  bobot
        for (let i = 1; i <= bobot.length; i++) {
            console.log(window['B' + i]);
        }

        // inputan user nilainya
        var noUrut = 1;
        for (let i = 1; i <= jumlahAlternatif; i++) {
            for (let j = 1; j <= jumlahKriteria; j++) {
                window['P' + noUrut + 'C' + j] = parseFloat(document.getElementById('P' + noUrut + 'C' + j).value);
            }
            noUrut++;
        }

        noUrut -= noUrut;

        console.log(kategori_bobot);
        var noUntukKategori = 0;
        window['minmaxcategory'] = [];
        // Mana atribut Benefit dan mana yang cost
        for (let i = 1; i <= jumlahKriteria; i++) {
            window['category' + i] = [];
            for (let j = 1; j <= jumlahAlternatif; j++) {
                window['category' + i].push(window['P' + j + 'C' + i]);
            }
            if (kategori_bobot[noUntukKategori] == "Benefit") {
                console.log(window['category' + i])
                window['minmaxcategory'].push(Math.max.apply(Math, window['category' + i]));
            } else if (kategori_bobot[noUntukKategori] == "Cost") {
                console.log(window['category' + i])
                window['minmaxcategory'].push(Math.min.apply(Math, window['category' + i]));
            }
            noUntukKategori++;
        }

        noUntukKategori -= noUntukKategori;

        console.log(minmaxcategory);

        // normalisasi
        var urutanMinMax = 0;
        for (let j = 1; j <= jumlahKriteria; j++) {
            for (let i = 1; i <= jumlahAlternatif; i++) {
                if (kategori_bobot[j - 1] == "Benefit") {
                    window['NP' + i + 'NC' + j] = window['P' + i + 'C' + j] / minmaxcategory[urutanMinMax];
                } else if (kategori_bobot[j - 1] == "Cost") {
                    window['NP' + i + 'NC' + j] = minmaxcategory[urutanMinMax] / window['P' + i + 'C' + j];
                }
            }
            urutanMinMax++;
        }

        // Add hasil normalisasi to array
        for (let i = 1; i <= jumlahAlternatif; i++) {
            window['dataNormalisasiPerBrand' + i] = [];
            for (let j = 1; j <= jumlahKriteria; j++) {
                window['dataNormalisasiPerBrand' + i].push(window['NP' + i + 'NC' + j]);
            }
        }

        // Tambahkan nama kriteria ke dalam array
        var nama_kriteria = [];
        <?php foreach ($krt as $k) { ?>
            nama_kriteria.push('<?= $k['nama_kriteria'] ?>');
        <?php } ?>

        var html = `<br><h3>Tabel Normalisasi</h3><table class="table table-bordered">`;
        for (let i = 1; i <= jumlahAlternatif; i++) {
            html += `<tr>`;
            html += `<td>C${i}</td>`;
            for (let j = 1; j <= window['dataNormalisasiPerBrand' + i].length; j++) {
                html += `<td>`;
                html += window['dataNormalisasiPerBrand' + i][j - 1];
                html += `</td>`;
            }
            html += `</tr>`;
        }
        html += `</table>`;
        document.getElementById("tabel_normalisasi").innerHTML = html;

        var html = ``;

        // final penghitungan tabel ternormalisasi
        var backToZero = 0;
        var hasilKali = [];
        var finalData = [];
        var hitungTabelFaktor;
        for (let i = 1; i <= jumlahAlternatif; i++) {
            for (let j = 1; j <= jumlahKriteria; j++) {
                hitungTabelFaktor = window['dataNormalisasiPerBrand' + i][backToZero] * window['B' + j];
                hasilKali.push(hitungTabelFaktor);
                hitungTabelFaktor = 0;
                backToZero++;
            }
            var sum = hasilKali.reduce(function(a, b) {
                return a + b;
            }, 0);
            finalData.push(sum);
            hasilKali = [];
            backToZero -= backToZero;
        }

        var terpilih = Math.max.apply(Math, finalData);
        var brandTerpilih;
        var html = `<br><h3>Tabel Faktor Ternormalisasi & Hasil Brand Terpilih</h3><table class="table table-bordered">`;
        for (let i = 0; i < finalData.length; i++) {
            html += `<tr>
            <td>${nama_alternatif[i]}</td>
            `;
            if (finalData[i] == terpilih) {
                data = finalData[i] + ' <span style="color:red">(Brand Terpilih)</span>';
                brandTerpilih = nama_alternatif[i];
            } else {
                data = finalData[i];
            }
            html += `<td>${data}</td>
            </tr>`
        }

        console.log(brandTerpilih);
        $.ajax({
            url: "<?= base_url('Saw/simpan_hasil') ?>",
            type: "POST",
            data: {
                brand_terpilih: brandTerpilih
            },
            cache: false,
            success: function(dataResult) {
                console.log("Sukses Kirim");
            }
        });
        html += `</table>`;
        isifinishing = `
        <a href="${base_url}saw" class="btn btn-primary">Back to SAW Dashboard</a>
        `;
        document.getElementById("tabel_faktor_ternormalisasi").innerHTML = html;
        document.getElementById("finishing_div").innerHTML = isifinishing;
    }
</script>


            
     
