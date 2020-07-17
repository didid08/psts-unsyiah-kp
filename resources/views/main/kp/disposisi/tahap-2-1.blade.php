@if ($disposisi->progress == 4)
	<form action="{{ route('main.kp.mahasiswa.upload-disposisi', ['progress' => 4]) }}" method="post" style="display: inline;" enctype="multipart/form-data">
@endif
<table width="100%" class="table table-bordered{{ formBackground(4, 5, $disposisi) }}">
	<tbody>
		@if (isset($role->mhs))
			@if ($disposisi->progress < 5)
				<tr>
					<td colspan="2" class="align-middle"><b>Pengisian Data Surat Permohonan Ke Proyek</b></td>
				</tr>
				<tr>
					<td class="align-middle">Nama Direktur Perusahaan</td>
					<td class="text-center align-middle">
						@if ($disposisi->progress == 4)
							<input type="text" name="nama-direktur-perusahaan" class="form-control" placeholder="Misal: PT. Sejahtera">
						@elseif ($disposisi->progress > 5)
							<i class="fa fa-check-circle text-green"></i><span class="ml-3">Ada</span>
						@else
							--
						@endif
					</td>
				</tr>
				<tr>
					<td class="align-middle">Nama Bapak/Ibu Pada Tujuan Surat</td>
					<td class="text-center align-middle">
						@if ($disposisi->progress == 4)
							<input type="text" name="nama-bapak-ibu-pada-tujuan-surat" class="form-control" placeholder="Misal: Bapak Abdullah">
						@elseif ($disposisi->progress > 5)
							<i class="fa fa-check-circle text-green"></i><span class="ml-3">Ada</span>
						@else
							--
						@endif
					</td>
				</tr>
				<tr>
					<td class="align-middle">Alamat Proyek</td>
					<td class="text-center align-middle">
						@if ($disposisi->progress == 4)
							<input type="text" name="alamat-proyek" class="form-control" placeholder="Masukkan alamat proyek">
						@elseif ($disposisi->progress > 5)
							<i class="fa fa-check-circle text-green"></i><span class="ml-3">Ada</span>
						@else
							--
						@endif
					</td>
				</tr>
				<tr>
					<td class="align-middle">Nama Proyek</td>
					<td class="text-center align-middle">
						@if ($disposisi->progress == 4)
							<input type="text" name="nama-proyek" class="form-control" placeholder="Masukkan nama proyek">
						@elseif ($disposisi->progress > 5)
							<i class="fa fa-check-circle text-green"></i><span class="ml-3">Ada</span>
						@else
							--
						@endif
					</td>
				</tr>
				<tr>
					<td class="align-middle">KP Selama</td>
					<td class="text-center align-middle">
						@if ($disposisi->progress == 4)
							<input type="text" name="kp-selama" class="form-control" placeholder="Misal: dua (2) bulan">
						@elseif ($disposisi->progress > 5)
							<i class="fa fa-check-circle text-green"></i><span class="ml-3">Ada</span>
						@else
							--
						@endif
					</td>
				</tr>
				@if ($disposisi->progress == 4)
					<tr>
						<td colspan="2" class="text-center align-middle">
							@csrf
							<button type="submit" class="btn btn-block btn-success">Kirim</button>
						</td>
					</tr>
				@elseif ($disposisi->progress < 4)
					<tr>
						<td colspan="2" class="text-center align-middle">
							<button class="btn btn-block btn-secondary disabled">Kirim</button>
						</td>
					</tr>
				@endif
			@elseif ($disposisi->progress == 5)
				<tr>
					<td colspan="2" class="align-middle"><b>Pengisian Data Surat Permohonan Ke Proyek</b></td>
				</tr>
				<td colspan="2" class="align-middle">
					<ul>
						<li>Surat Permohonan Ke Proyek telah Diproses dan Dikirim ke Admin</li>
						<li>Jika sudah di dto maka anda dapat mengambil suratnya di jurusan</li>
						<li>Jika sudah diterima oleh proyek maka anda dapat mengunggah surat balasan dari proyek untuk dikirim ke admin</li>
						<li>Jika tidak maka anda harus mengisi ulang data surat permohonan ke proyek untuk diproses kembali</li>
					</ul>
				</td>
			@else
				<tr>
					<td colspan="2" class="align-middle font-weight-bold">Surat Permohonan Ke Proyek</td>
				</tr>
				<tr>
					<td class="align-middle text-center">No</td>
					<td class="align-middle text-left">
						{{ $data->no_surat_permohonan_ke_proyek->content }}
					</td>
				</tr>
			@endif
		@else
			<tr>
				<td colspan="2" class="align-middle font-weight-bold">Surat Permohonan Ke Proyek</td>
			</tr>
			@if ($disposisi->progress > 5)
				<tr>
					<td class="align-middle text-center">No</td>
					<td class="align-middle text-left">
						{{ $data->no_surat_permohonan_ke_proyek->content }}
					</td>
				</tr>
			@elseif (in_array($disposisi->progress, [4,5]))
				<tr>
					<td colspan="2" class="align-middle">Sedang diproses</td>
				</tr>
			@else
				<tr>
					<td colspan="2" class="align-middle">--</td>
				</tr>
			@endif
		@endif
	</tbody>
</table>
@if ($disposisi->progress == 4)
	</form>
@endif