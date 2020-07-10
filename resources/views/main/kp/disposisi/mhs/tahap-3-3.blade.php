@if ($disposisi->progress == 11)
	<form action="{{ route('main.kp.mahasiswa.upload-disposisi', ['progress' => 11]) }}" method="post" style="display: inline;" enctype="multipart/form-data">
@endif
<table width="112%" class="table table-bordered{{ formBackground(11, 12, $disposisi) }}">
	<tbody>
		<tr>
			<td class="text-center align-middle">3.</td>
			<td class="align-middle font-weight-bold">Surat Balasan Dari Proyek</td>
			<td class="align-middle text-center">
				@if ($disposisi->progress == 11)
					<div class="custom-file">
						<input type="file" class="custom-file-input" name="surat-balasan-dari-proyek" id="surat-balasan-dari-proyek" onchange="showSelectedFile('#surat-balasan-dari-proyek-label', event)" accept="application/pdf">
						<label class="custom-file-label text-left" for="surat-balasan-dari-proyek" id="surat-balasan-dari-proyek-label">Pilih File</label>
					</div>
				@elseif (in_array($disposisi->progress, range(12,12)))
					<span class="text-warning">sedang diperiksa</span>
				@elseif ($disposisi->progress > 12)
					<i class="fa fa-check-circle text-green"></i><span class="ml-3">Ada</span>
				@else
					<div class="custom-file">
						<input type="file" class="custom-file-input" name="surat-balasan-dari-proyek" id="surat-balasan-dari-proyek" onchange="showSelectedFile('#surat-balasan-dari-proyek-label', event)" accept="application/pdf" disabled="disabled">
						<label class="custom-file-label text-left" for="surat-balasan-dari-proyek" id="surat-balasan-dari-proyek-label">Pilih File</label>
					</div>
				@endif
			</td>
		</tr>
		@if ($disposisi->progress == 11)
			<tr>
				<td colspan="3" class="text-right align-middle">
					@csrf
					<button type="submit" class="btn btn-sm btn-success">Kirim</button>
				</td>
			</tr>
		@elseif ($disposisi->progress < 11)
			<tr>
				<td colspan="3" class="text-right align-middle">
					<button class="btn btn-sm btn-secondary disabled">Kirim</button>
				</td>
			</tr>
		@endif
	</tbody>
</table>
@if ($disposisi->progress == 11)
	</form>
@endif