<table width="100%" class="table table-bordered{{ formBackground(5, 7, $disposisi) }}">
	<tbody>
		<tr>
			<td colspan="2" class="align-middle"><b>Pengajuan Surat Ke Proyek</b></td>
		</tr>
		<tr>
			<td class="align-middle">Surat Permohonan Ke Proyek</td>
			<td class="text-center align-middle">
				@if ($disposisi->progress == 5)
					<div class="custom-file">
						<input type="file" class="custom-file-input" name="surat-permohonan-ke-proyek" id="surat-permohonan-ke-proyek" onchange="showSelectedFile('#surat-permohonan-ke-proyek-label', event)" accept="application/pdf">
						<label class="custom-file-label text-left" for="surat-permohonan-ke-proyek" id="surat-permohonan-ke-proyek-label">Pilih File</label>
					</div>
				@elseif (in_array($disposisi->progress, range(6,7)))
					<span class="text-warning">sedang diperiksa</span>
				@elseif ($disposisi->progress > 7)
					<i class="fa fa-check-circle text-green"></i><span class="ml-3">Ada</span>
				@else
					<div class="custom-file">
						<input type="file" class="custom-file-input" name="surat-permohonan-ke-proyek" id="surat-permohonan-ke-proyek" onchange="showSelectedFile('#surat-permohonan-ke-proyek-label', event)" accept="application/pdf" disabled="disabled">
						<label class="custom-file-label text-left" for="surat-permohonan-ke-proyek" id="surat-permohonan-ke-proyek-label">Pilih File</label>
					</div>
				@endif
			</td>
		</tr>
	</tbody>
</table>