@if ($disposisi->progress == 20)
	<form action="{{ route('main.kp.mahasiswa.upload-disposisi', ['progress' => 20]) }}" method="post" style="display: inline;" enctype="multipart/form-data">
@endif
<table width="100%" class="table table-bordered{{ formBackground(20, 22, $disposisi) }}">
	<tbody>
		<tr>
			<td class="align-middle text-center">1.</td>
			<td class="align-middle">Kelengkapan dokumen administrasi (Dokumen: PSTS 2)</td>
			<td class="align-middle text-center">
				@if ($disposisi->progress == 20)
					@csrf
					<div class="custom-file">
						<input type="file" class="custom-file-input" name="kelengkapan-dokumen-administrasi" id="kelengkapan-dokumen-administrasi" onchange="showSelectedFile('#kelengkapan-dokumen-administrasi-label', event)" accept="application/zip">
						<label class="custom-file-label text-left" for="kelengkapan-dokumen-administrasi" id="kelengkapan-dokumen-administrasi-label">Pilih File</label>
					</div>
					<button type="submit" class="btn btn-sm btn-success mt-2">Kirim</button>
				@elseif (in_array($disposisi->progress, range(21,22)))
					<span class="text-warning">sedang diperiksa</span>
				@elseif ($disposisi->progress > 22)
					<i class="fa fa-check-circle text-green"></i><span class="ml-3">Ada</span>
				@else
					<div class="custom-file">
						<input type="file" class="custom-file-input" name="kelengkapan-dokumen-administrasi" id="kelengkapan-dokumen-administrasi" onchange="showSelectedFile('#kelengkapan-dokumen-administrasi-label', event)" accept="application/zip" disabled="disabled">
						<label class="custom-file-label text-left" for="kelengkapan-dokumen-administrasi" id="kelengkapan-dokumen-administrasi-label">Pilih File</label>
					</div>
					<button class="btn btn-sm btn-secondary mt-2 disabled">Kirim</button>
				@endif
			</td>
		</tr>
		<tr>
			<td class="align-middle text-center">2.</td>
			<td colspan="2" class="align-middle">Softcopy dokumen administrasi dikirim ke</td>
		</tr>
		<tr>
			<td></td>
			<td colspan="2" class="align-middle">
				Nama file : NIM_KP.zip
			</td>
		</tr>
		<tr>
			<td></td>
			<td colspan="2" class="align-middle">
				Email Administrasi : jtspsts{!! '@' !!}gmail.com
			</td>
		</tr>
	</tbody>
</table>
@if ($disposisi->progress == 20)
	</form>
@endif