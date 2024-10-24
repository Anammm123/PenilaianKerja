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

    /* Table Container Styles */
    table {
        width: 75%;
        margin: 2rem auto;
        border-collapse: separate;
        border-spacing: 0;
        box-shadow: 0 6px 16px rgba(0, 0, 0, 0.1);
        border-radius: 12px;
        overflow: hidden;
        background: white;
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
    }

    /* Header Styles */
    th {
        background: linear-gradient(135deg, #4CAF50, #45a049);
        color: white;
        padding: 1.2rem 1rem;
        font-size: 0.9rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        border-bottom: 2px solid #45a049;
        position: relative;
    }

    th:first-child {
        padding-left: 1.5rem;
    }

    /* Cell Styles */
    td {
        padding: 1rem;
        font-size: 0.95rem;
        color: #374151;
        border-bottom: 1px solid #e5e7eb;
        transition: all 0.2s ease;
    }

    td:first-child {
        padding-left: 1.5rem;
        font-weight: 500;
        color: #1f2937;
    }

    /* Row Styles */
    tr:last-child td {
        border-bottom: none;
    }

    tr:nth-child(even) {
        background-color: #f8fafc;
    }

    tr:hover td {
        background-color: #f3f4f6;
    }

    /* Percentage Cells */
    td:not(:first-child) {
        font-family: 'Roboto Mono', monospace;
        font-size: 0.9rem;
    }

    /* Responsive Design */
    @media screen and (max-width: 1024px) {
        table {
            width: 85%;
        }
    }

    @media screen and (max-width: 768px) {
        table {
            width: 95%;
            margin: 1rem auto;
        }

        th,
        td {
            padding: 0.8rem;
            font-size: 0.85rem;
        }

        th {
            font-size: 0.8rem;
        }
    }

    /* Optional: Add subtle animations */
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    table {
        animation: fadeIn 0.5s ease-out;
    }

    /* Optional: Add custom scrollbar for overflow */
    .table-container {
        overflow-x: auto;
        margin: 2rem auto;
        width: 95%;
    }

    .table-container::-webkit-scrollbar {
        height: 8px;
    }

    .table-container::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 4px;
    }

    .table-container::-webkit-scrollbar-thumb {
        background: #888;
        border-radius: 4px;
    }

    .table-container::-webkit-scrollbar-thumb:hover {
        background: #666;
    }
</style>

<div class="container-fluid">
    <h4 class="page-title"> Staff Hotel</h4>
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
                                <span class='text-muted fw-bold'> Nilai : {$value}%</span>
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

    <h3 class="font-weight-bold" style="text-align: center;">Raport Kinerja Bulanan Anda</h3>

    <table class="w-100">
        <tr>
            <th>Aspek Penilaian</th>
            <th>Nilai (%)</th>
            <th>
                <?php
                $total_kurang_baik = 0;
                foreach ($aspek as $nilai) {
                    $fuzzy = fuzzy_membership($nilai);
                    $total_kurang_baik += $fuzzy['Kurang Baik'];
                }
                echo "Kurang Baik (" . round($total_kurang_baik / count($aspek), 2) . "%)";
                ?>
            </th>
            <th>
                <?php
                $total_baik = 0;
                foreach ($aspek as $nilai) {
                    $fuzzy = fuzzy_membership($nilai);
                    $total_baik += $fuzzy['Baik'];
                }
                echo "Baik (" . round($total_baik / count($aspek), 2) . "%)";
                ?>
            </th>
            <th>
                <?php
                $total_sangat_baik = 0;
                foreach ($aspek as $nilai) {
                    $fuzzy = fuzzy_membership($nilai);
                    $total_sangat_baik += $fuzzy['Sangat Baik'];
                }
                echo "Sangat Baik (" . round($total_sangat_baik / count($aspek), 2) . "%)";
                ?>
            </th>
        </tr>

        <?php
        function fuzzy_membership($nilai)
        {
            if ($nilai <= 40) {
                return ['Kurang Baik' => 100, 'Baik' => 0, 'Sangat Baik' => 0]; // 100% Kurang Baik
            } elseif ($nilai > 40 && $nilai <= 70) {
                // Derajat keanggotaan fuzzy "Baik"
                $baik = ($nilai - 40) / (70 - 40) * 100; // Menghitung dalam persen
                return ['Kurang Baik' => 100 - $baik, 'Baik' => $baik, 'Sangat Baik' => 0]; // Persentase
            } elseif ($nilai > 70 && $nilai <= 100) {
                // Derajat keanggotaan fuzzy "Sangat Baik"
                $sangat_baik = ($nilai - 70) / (100 - 70) * 100; // Menghitung dalam persen
                return ['Kurang Baik' => 0, 'Baik' => 100 - $sangat_baik, 'Sangat Baik' => $sangat_baik]; // Persentase
            } else {
                return ['Kurang Baik' => 0, 'Baik' => 0, 'Sangat Baik' => 0];
            }
        }

        // Menampilkan data yang sama dengan progress bar ke dalam tabel
        foreach ($aspek as $key => $nilai) {
            $fuzzy = fuzzy_membership($nilai);
            echo "<tr>
                    <td>{$key}</td>
                    <td>{$nilai}%</td>
                    <td>" . round($fuzzy['Kurang Baik'], 2) . "%</td>
                    <td>" . round($fuzzy['Baik'], 2) . "%</td>
                    <td>" . round($fuzzy['Sangat Baik'], 2) . "%</td>
                </tr>";
        }
        ?>
    </table>
</div>