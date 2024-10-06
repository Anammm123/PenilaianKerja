
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f6f9;
        margin: 0;
        padding: 0;
    }

    h2 {
        text-align: center;
        margin-top: 20px;
        color: #333;
    }

    table {
        width: 70%;
        margin: 20px auto;
        border-collapse: collapse;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        border-radius: 10px;
        overflow: hidden;
    }

    table, th, td {
        border: none;
    }

    th, td {
        padding: 15px;
        text-align: center;
    }

    th {
        background-color: #4CAF50;
        color: white;
        font-size: 16px;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    tr:nth-child(odd) {
        background-color: #fff;
    }

    td {
        font-size: 14px;
        color: #333;
    }

    tr:hover {
        background-color: #f1f1f1;
    }

    td:first-child {
        text-align: left;
        padding-left: 20px;
        font-weight: bold;
    }

    td:last-child {
        padding-right: 20px;
    }

    @media screen and (max-width: 768px) {
        table {
            width: 90%;
        }

        th, td {
            padding: 10px;
            font-size: 14px;
        }
    }
</style>


				
				
				
<div class = "container-fluid">
    <h4 class = "page-title">Staff Hotel</h4>
    <div class="row">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Laporan Kinerja Bulanan Anda</h4>
                </div>
                <div class="card-body">
                    <?php 
                    // Aspek dan nilai untuk kinerja
                    $aspek = [
                        'Kedisiplinan' => $nilai != null ? $nilai[0]['nilai'] : 1,
                        'Kejujuran' => $nilai != null ? $nilai[1]['nilai'] : 1,
                        'Kepemimpinan' => $nilai != null ? $nilai[2]['nilai'] : 1,
                        'Kerjasama' => $nilai != null ? $nilai[3]['nilai'] : 1,
						
                    ];

                    $colors = ['bg-info', 'bg-success', 'bg-danger', 'bg-warning', 'bg-primary'];
                    $index = 0;

                    // Menampilkan progress bar
                    foreach ($aspek as $key => $value) {
                        echo "<p>{$key}</p>";
                        echo "
                        <div class='progress-card'>
                            <div class='d-flex justify-content-between mb-1'>
                                <span class='text-muted'></span>
                                <span class='text-muted fw-bold'> Nilai : {$value}</span>
                            </div>
                            <div class='progress mb-2' style='height: 7px;'>
                                <div class='progress-bar {$colors[$index]}' role='progressbar' style='width: {$value}%' aria-valuenow='{$value}' aria-valuemin='0' aria-valuemax='100'></div>
                            </div>
                        </div>
                        <br>";
                        $index++;
                    }
                    ?>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card">
                <?php $value = $nilai != null ? Fuzzy($nilai[0]['nilai'], $nilai[1]['nilai'], $nilai[2]['nilai'], $nilai[3]['nilai']) : 1; ?>
                <div class="card-header">
                    <h4 class="card-title">Kinerja Anda</h4>
                </div>
                <div class="card-body">
                    <div id="task-complete" class="chart-circle mt-4 mb-3"></div>
                </div>
                <div class="card-footer">
                    <?php kinerja($value); ?>
                </div>
            </div>
        </div>
    </div>

    <h3 style="text-align: center;">Raport Kinerja Bulanan Anda</h3>

    <table>
        <tr>
            <th>Aspek Penilaian</th>
            <th>Nilai</th>
            <th>Kurang Baik</th>
            <th>Baik</th>
            <th>Sangat Baik</th>
        </tr>

        <?php
        // Fungsi untuk menghitung derajat keanggotaan fuzzy
        function fuzzy_membership($nilai) {
            if ($nilai <= 40) {
                return ['Kurang Baik' => 1, 'Baik' => 0, 'Sangat Baik' => 0];
            } elseif ($nilai > 40 && $nilai <= 70) {
                // Derajat keanggotaan fuzzy "Baik"
                $baik = ($nilai - 40) / (70 - 40);
                return ['Kurang Baik' => 1 - $baik, 'Baik' => $baik, 'Sangat Baik' => 0];
            } elseif ($nilai > 70 && $nilai <= 100) {
                // Derajat keanggotaan fuzzy "Sangat Baik"
                $sangat_baik = ($nilai - 70) / (100 - 70);
                return ['Kurang Baik' => 0, 'Baik' => 1 - $sangat_baik, 'Sangat Baik' => $sangat_baik];
            } else {
                return ['Kurang Baik' => 0, 'Baik' => 0, 'Sangat Baik' => 0];
            }
        }

        // Menampilkan data yang sama dengan progress bar ke dalam tabel
        foreach ($aspek as $key => $nilai) {
            $fuzzy = fuzzy_membership($nilai);
            echo "<tr>
                    <td>{$key}</td>
                    <td>{$nilai}</td>
                    <td>" . round($fuzzy['Kurang Baik'], 2) . "</td>
                    <td>" . round($fuzzy['Baik'], 2) . "</td>
                    <td>" . round($fuzzy['Sangat Baik'], 2) . "</td>
                </tr>";
        }
        ?>
    </table>
</div>





						<!-- <div class="col-md-3">
							<div class="card">
								<div class="card-header">
									<h4 class="card-title">Kinerja Pegawai</h4>
								</div>
								<div class="card-body">
									<div id="task-complete" class="chart-circle mt-4 mb-3"></div>
								</div>
								<div class="card-footer">
									<center><legend class="btn-rounded btn-success btn-lg">Sangat Baik</legend></center>
								</div>
							</div>
						</div> -->
					</div>
				</div>
			