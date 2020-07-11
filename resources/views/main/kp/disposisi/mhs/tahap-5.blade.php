@if ($disposisi->progress == 14)
	<form action="{{ route('main.kp.mahasiswa.upload-disposisi', ['progress' => 14]) }}" method="post" style="display: inline;" enctype="multipart/form-data">
@endif
<table width="100%" class="table table-bordered{{ formBackground(14, 15, $disposisi) }}">
	<tbody>
		<tr>
			<td class="align-middle">1.</td>
			<td class="align-middle">Masa Kerja Praktek</td>
			<td class="align-middle">
				@if ($disposisi->progress == 14)
					Tgl<input type="date" class="form-control ml-2" name="masa-kerja-praktek-1" style="display: inline-block; width: 10em;"><br>
					s/d<input type="date" class="form-control ml-2" name="masa-kerja-praktek-2" style="display: inline-block; width: 10em;">
				@elseif (in_array($disposisi->progress, range(15,15)))
					<span class="text-yellow">Sedang diperiksa</span>
				@elseif ($disposisi->progress > 15)
					Tgl <u>{{ date('d/m/Y', strtotime($data->masa_kerja_praktek_1->content)) }}</u> s/d <u>{{ date('d/m/Y', strtotime($data->masa_kerja_praktek_2->content)) }}</u>
				@else
					Tgl<input type="date" disabled="disabled" class="form-control ml-2" name="masa-kerja-praktek-1" style="display: inline-block; width: 10em;"><br>
					s/d<input type="date" disabled="disabled" class="form-control ml-2" name="masa-kerja-praktek-2" style="display: inline-block; width: 10em;">
				@endif
			</td>
		</tr>
		<tr>
			<td class="align-middle">2.</td>
			<td class="align-middle">Surat keterangan telah selesai KP dari penanggung jawab KP</td>
			<td class="align-middle">
				@if ($disposisi->progress == 14)
					<div class="custom-file">
						<input type="file" class="custom-file-input" name="surat-keterangan-telah-selesai-kp" id="surat-keterangan-telah-selesai-kp" onchange="showSelectedFile('#surat-keterangan-telah-selesai-kp-label', event)" accept="application/pdf">
						<label class="custom-file-label text-left" for="surat-keterangan-telah-selesai-kp" id="surat-keterangan-telah-selesai-kp-label">Pilih File</label>
					</div>
				@elseif (in_array($disposisi->progress, range(15,15)))
					<span class="text-yellow">Sedang diperiksa</span>
				@elseif ($disposisi->progress > 15)
					<i class="fa fa-check-circle text-green"></i><span class="ml-3">Ada</span>
				@else
					<div class="custom-file">
						<input type="file" class="custom-file-input" name="surat-keterangan-telah-selesai-kp" id="surat-keterangan-telah-selesai-kp" onchange="showSelectedFile('#surat-keterangan-telah-selesai-kp-label', event)" accept="application/pdf" disabled="disabled">
						<label class="custom-file-label text-left" for="surat-keterangan-telah-selesai-kp" id="surat-keterangan-telah-selesai-kp-label">Pilih File</label>
					</div>
				@endif
			</td>
		</tr>
		<tr>
			<td class="align-middle text-center">3.</td>
			<td class="align-middle">Buku Laporan KP</td>
			<td class="align-middle">
				@if ($disposisi->progress == 14)
					<div class="custom-file">
						<input type="file" class="custom-file-input" name="buku-laporan-kp" id="buku-laporan-kp" onchange="showSelectedFile('#buku-laporan-kp-label', event)" accept="application/pdf">
						<label class="custom-file-label text-left" for="buku-laporan-kp" id="buku-laporan-kp-label">Pilih File</label>
					</div>
				@elseif (in_array($disposisi->progress, range(15,15)))
					<span class="text-yellow">Sedang diperiksa</span>
				@elseif ($disposisi->progress > 15)
					<i class="fa fa-check-circle text-green"></i><span class="ml-3">Ada</span>
				@else
					<div class="custom-file">
						<input type="file" class="custom-file-input" name="buku-laporan-kp" id="buku-laporan-kp" onchange="showSelectedFile('#buku-laporan-kp-label', event)" accept="application/pdf" disabled="disabled">
						<label class="custom-file-label text-left" for="buku-laporan-kp" id="buku-laporan-kp-label">Pilih File</label>
					</div>
				@endif
			</td>
		</tr>
		<tr>
			<td class="align-middle text-center">4.</td>
			<td class="align-middle">Lembar Pengesahan KP</td>
			<td class="align-middle">
				@if ($disposisi->progress == 14)
					<div class="custom-file">
						<input type="file" class="custom-file-input" name="lembar-pengesahan-kp" id="lembar-pengesahan-kp" onchange="showSelectedFile('#lembar-pengesahan-kp-label', event)" accept="application/pdf">
						<label class="custom-file-label text-left" for="lembar-pengesahan-kp" id="lembar-pengesahan-kp-label">Pilih File</label>
					</div>
				@elseif (in_array($disposisi->progress, range(15,15)))
					<span class="text-yellow">Sedang diperiksa</span>
				@elseif ($disposisi->progress > 15)
					<i class="fa fa-check-circle text-green"></i><span class="ml-3">Ada</span>
				@else
					<div class="custom-file">
						<input type="file" class="custom-file-input" name="lembar-pengesahan-kp" id="lembar-pengesahan-kp" onchange="showSelectedFile('#lembar-pengesahan-kp-label', event)" accept="application/pdf" disabled="disabled">
						<label class="custom-file-label text-left" for="lembar-pengesahan-kp" id="lembar-pengesahan-kp-label">Pilih File</label>
					</div>
				@endif
			</td>
		</tr>
		@if ($disposisi->progress == 14)
			<tr>
				<td colspan="3" class="align-middle text-right">
					@csrf
					<button type="submit" class="btn btn-sm btn-success">Kirim</button>
				</td>
			</tr>
		@elseif ($disposisi->progress < 14)
			<tr>
				<td colspan="3" class="align-middle text-right">
					<button class="btn btn-sm btn-secondary disabled">Kirim</button>
				</td>
			</tr>
		@endif
	</tbody>
</table>
@if ($disposisi->progress == 14)
	</form>
@endif