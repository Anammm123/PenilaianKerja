<div class="container-fluid">
    <h4 class="page-title">Kinerja Pegawai</h4>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <form method="POST" action="">
                    <div class="card-header">
                        <h4 class="card-title">Penilaian Kinerja</h4>
                    </div>
                    <div class="card-body row">

                    <div class="col-md-6">
                    <p>Nama</p>
                        <input name="nama" type="text" class="form-control" id="disableinput" value="<?= $data['nm_pegawai']; ?>" disabled>
                        <br>

                        <p>Tempat Tanggal Lahir</p>
                        <input type="text" class="form-control" id="disableinput" value="<?= $data['ttl']; ?>" disabled>
                        <br>

                        <p>Alamat</p>
                        <input name="alamat" type="text" class="form-control" id="disableinput" value="<?= $data['alamat']; ?>" disabled>
                        <br>
                    </div>

                    <div class="col-md-6">
                    <p>Email</p>
                        <input name="email" type="text" class="form-control" id="disableinput" value="<?= $data['email']; ?>" disabled>
                        <br>

                        <p>Jenis Kelamin</p>
                        <input type="text" class="form-control" id="disableinput" value="<?= ($data['jeniskelamin'] == 'L') ? "Laki-laki" : "Perempuan"; ?>" disabled>
                        <br>

                        <p>Posisi</p>
                        <input name="posisi" type="text" class="form-control" id="disableinput" value="<?= $data['nama']; ?>" disabled>
                        <br>
                    </div>
                    </div>
                    <div class="card-body">
                        <?php 
                        $kriteria = ['Kedisiplinan', 'Kejujuran', 'Kepemimpinan', 'Kerjasama'];
                        foreach ($kriteria as $index => $kriteria_item) { ?>
                            <p><b><?= $kriteria_item ?></b></p>
                            <div class="progress-card">
                                <div class="d-flex justify-content-between mb-1">
                                    <span class="text-muted">1</span>
                                    <span class="text-muted fw-bold">100</span>
                                </div>
                                <input name="<?= strtolower($kriteria_item) ?>" type="range" class="form-control-range" min="1" max="100" value="<?= $nilai != null ? $nilai[$index]['nilai'] : 1; ?>" id="<?= strtolower($kriteria_item) ?>">
                                <p>Nilai: <span id="<?= strtolower($kriteria_item) ?>_out"></span></p>
                            </div>
                            <br>
                        <?php } ?>

                        <div class="card-footer" style="display:flex; justify-content:flex-start; width:100%;">
                        <input type="submit" name="submit" class="btn w-25 btn-success" value="Nilai" />
                    </div>  
                    </div>
                    
                </form>
                <?php
                if (isset($_POST['submit'])) {
                    // Sanitize and validate input
                    $kedisiplinan = intval($_POST['kedisiplinan']);
                    $kejujuran = intval($_POST['kejujuran']);
                    $kepemimpinan = intval($_POST['kepemimpinan']);
                    $kerjasama = intval($_POST['kerjasama']);
                    
                    $timestamp = date('Y-m-d H:i:s');

                    $query = "
                    INSERT INTO nilai(id_pegawai, id_kriteria, nilai, waktu) VALUES
                    ($id_pegawai, 1, '$kedisiplinan', '$timestamp'),
                    ($id_pegawai, 2, '$kejujuran', '$timestamp'),
                    ($id_pegawai, 3, '$kepemimpinan', '$timestamp'),
                    ($id_pegawai, 4, '$kerjasama', '$timestamp')";
                    
                    
                    $result = $koneksi->query($query);
                    if ($result) {
                        echo "<script>alert('Berhasil menilai pegawai');</script>";
                        echo "<script>window.location.href = '?page=LihatPegawai&id=$id_pegawai';</script>";
                    } else {
                        echo "<script>alert('Gagal menilai pegawai');</script>";
                    }
                }
                ?>
            </div>
        </div>
    </div>
</div>

<script>
    function updateOutput(sliderId, outputId) {
        var slider = document.getElementById(sliderId);
        var output = document.getElementById(outputId);
        output.innerHTML = slider.value;

        slider.oninput = function() {
            output.innerHTML = this.value;
        }
    }

    updateOutput("kedisiplinan", "kedisiplinan_out");
    updateOutput("kejujuran", "kejujuran_out");
    updateOutput("kepemimpinan", "kepemimpinan_out");
    updateOutput("kerjasama", "kerjasama_out");
    
</script>
