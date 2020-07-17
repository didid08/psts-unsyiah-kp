@if ($disposisi->progress == 9)
	<form action="{{ route('main.kp.mahasiswa.upload-disposisi', ['progress' => 9]) }}" method="post" style="display: inline;" enctype="multipart/form-data">
@endif
<table width="100%" class="table table-bordered{{ formBackground(9, 10, $disposisi) }}">
	<tbody>
		@if (isset($role->mhs))
			@if ($disposisi->progress < 10)
				<tr>
					<td colspan="2" class="align-middle"><b>Pengisian Data Surat Ke Proyek</b></td>
				</tr>
				<tr>
					<td class="align-middle">Pembimbing Lapangan KP</td>
					<td class="text-center align-middle">
						@if ($disposisi->progress == 9)
							<input type="text" name="pembimbing-lapangan-kp" class="form-control" placeholder="Masukkan Nama Pembimbing Lapangan KP">
						@elseif ($disposisi->progress > 10)
							<i class="fa fa-check-circle text-green"></i><span class="ml-3">Ada</span>
						@else
							--
						@endif
					</td>
				</tr>
				@if ($disposisi->progress == 9)
					<tr>
						<td colspan="2" class="text-center align-middle">
							@csrf
							<button type="submit" class="btn btn-block btn-success">Kirim</button>
						</td>
					</tr>
				@elseif ($disposisi->progress < 9)
					<tr>
						<td colspan="2" class="text-center align-middle">
							<button class="btn btn-block btn-secondary disabled">Kirim</button>
						</td>
					</tr>
				@endif
			@elseif ($disposisi->progress == 10)
				<tr>
					<td colspan="2" class="align-middle"><b>Pengisian Data Surat Ke Proyek</b></td>
				</tr>
				<td colspan="2" class="align-middle">
					<ul>
						<li>Surat Ke Proyek telah Diproses dan Dikirim ke Admin</li>
						<li>Jika sudah di dto maka anda dapat mengambil suratnya di jurusan untuk dikirim ke proyek</li>
						<li>Setelah itu admin akan memproses SK Penunjukan Pembimbing dan Pembahas</li>
					</ul>
				</td>
			@else
				<tr>
					<td colspan="2" class="align-middle font-weight-bold">Surat Ke Proyek</td>
				</tr>
				<tr>
					<td class="align-middle text-center">No</td>
					<td class="align-middle text-left">
						{{ $data->no_surat_ke_proyek->content }}
					</td>
				</tr>
			@endif
		@else
			<tr>
				<td colspan="2" class="align-middle font-weight-bold">Surat Ke Proyek</td>
			</tr>
			@if ($disposisi->progress > 10)
				<tr>
					<td class="align-middle text-center">No</td>
					<td class="align-middle text-left">
						{{ $data->no_surat_ke_proyek->content }}
					</td>
				</tr>
			@elseif (in_array($disposisi->progress, [9,10]))
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
@if ($disposisi->progress == 9)
	</form>
@endif