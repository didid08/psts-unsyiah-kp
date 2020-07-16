@if ($disposisi->progress == 6)
	<form action="{{ route('main.kp.mahasiswa.upload-disposisi', ['progress' => 6]) }}" method="post" style="display: inline;" enctype="multipart/form-data">
@endif
<table width="62%" class="table table-bordered{{ formBackground(6, 7, $disposisi) }}">
	<tbody>
		<tr>
			<td class="align-middle font-weight-bold">Surat Balasan Dari Proyek</td>
			<td class="align-middle text-center">
				@if ($disposisi->progress == 6)
					<div class="custom-file">
						<input type="file" class="custom-file-input" name="surat-balasan-dari-proyek" id="surat-balasan-dari-proyek" onchange="showSelectedFile('#surat-balasan-dari-proyek-label', event)" accept="application/pdf">
						<label class="custom-file-label text-left" for="surat-balasan-dari-proyek" id="surat-balasan-dari-proyek-label">Pilih File</label>
					</div>
				@elseif (in_array($disposisi->progress, range(7,7)))
					<span class="text-warning">sedang diperiksa</span>
				@elseif ($disposisi->progress > 7)
					<i class="fa fa-check-circle text-green"></i><span class="ml-3">Ada</span>
				@else
					<div class="custom-file">
						<input type="file" class="custom-file-input" name="surat-balasan-dari-proyek" id="surat-balasan-dari-proyek" onchange="showSelectedFile('#surat-balasan-dari-proyek-label', event)" accept="application/pdf" disabled="disabled">
						<label class="custom-file-label text-left" for="surat-balasan-dari-proyek" id="surat-balasan-dari-proyek-label">Pilih File</label>
					</div>
				@endif
			</td>
		</tr>
		@if ($disposisi->progress == 6)
			<tr>
				<td colspan="2" class="text-right align-middle">
					@csrf
					<button type="submit" class="btn btn-sm btn-success">Kirim</button>
				</td>
			</tr>
		@elseif ($disposisi->progress < 6)
			<tr>
				<td colspan="2" class="text-right align-middle">
					<button class="btn btn-sm btn-secondary disabled">Kirim</button>
				</td>
			</tr>
		@endif
	</tbody>
</table>
@if ($disposisi->progress == 6)
	</form>
@endif