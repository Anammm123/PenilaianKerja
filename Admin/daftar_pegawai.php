				<div class = "container-fluid">
					<h4 class = "page-title">Pegawai</h4>
					<div class="row">
						<div class="col-md-12">
							<div class="card card-tasks">
									<div class="card-header ">
										<form action='' method='POST'>
										<div class='row'>
											<div class='col-md-7'>
												<h4 class="card-title">Daftar Pegawai</h4>
											</div>
											
											<div class='col-md-4' >
												<input class="form-control" type="text" name="cari" placeholder="Nama Pegawai"></input>
											</div>
											<div class='col-md-1' style="padding:0%; padding-right:1%;">
												<input type='submit' class="btn-info form-control" value="Cari"></input>
											</div>
											
										</div>
										</form>
									</div>
									<div class="card-body ">
										<div class="table-full-width">
											<table class="table">
												<thead>
													<tr>
														<th>
															<!-- <div class="form-check">
																<label class="form-check-label">
																	<input class="form-check-input  select-all-checkbox" type="checkbox" data-select="checkbox" data-target=".task-select">
																	<span class="form-check-sign"></span>
																</label>
															</div> -->
															<center>No</center>
														</th>
														<th>Nama Pegawai</th>
														<th>Aksi</th>
													</tr>
												</thead>
												<tbody>
													<?php
													
													$halaman = 10;
													$page = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
													$mulai = ($page>1) ? ($page * $halaman) - $halaman : 0;
													$cari = $koneksi->real_escape_string(isset($_POST['cari']) ? @$_POST['cari'] : @$_GET['cari']);
													$query = (!empty($cari)) ? "SELECT * FROM pegawai WHERE nm_pegawai LIKE '%{$cari}%'" : "SELECT * FROM pegawai";
													$total = mysqli_num_rows($koneksi->query($query));
													$pages = ceil($total/$halaman);
													
													$query = (!empty($cari)) ? "SELECT * FROM pegawai WHERE nm_pegawai LIKE '%{$cari}%' LIMIT $mulai, $halaman" : "SELECT * FROM pegawai LIMIT $mulai, $halaman";
													$result = $koneksi->query($query);
													$no = $mulai+1;
													while($data = $result->fetch_array()) {
													?>
													<tr>
														<td>
															<!-- <div class="form-check">
																<label class="form-check-label">
																	<input class="form-check-input task-select" type="checkbox">
																	<span class="form-check-sign"></span>
																</label>
															</div> -->
															<center><?php echo $no++; ?></center>
														</td>
														<td><?php echo $data['nm_pegawai']; ?></td>
														<td class="td-actions text-right">
															<div class="form-button-action">
																<a type="button" data-toggle="tooltip" title="Edit" class="btn btn-link <btn-simple-primary" href="?page=EditPosisiPegawai&id=<?php echo $data['id_pegawai'];?>">
																	<i class="la la-edit"></i>
																</a>
																<a type="button" data-toggle="tooltip" title="Hapus" class="btn btn-link btn-simple-danger" href="hapus.php?id=<?php echo $data['id_pegawai'];?>">
																	<i class="la la-times"></i>
																</a>
															</div>
														</td>
													</tr>
													<?php 
													}
													?>
												</tbody>
											</table>
										</div>
									</div>
									<div class="card-footer">
									<p class="demo">
											<ul class="pagination pg-primary">
												<?php
												for($i= 1; $i <= $pages; $i++) {
												?>
												<li class="page-item"><a class="page-link" href="?page=Pegawai&halaman=<?php echo $i; ?>&cari=<?php echo $cari; ?>"><?php echo $i;?></a></li>
												<?php } ?>
											</ul>
									</p>
									</div>
								</div>
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