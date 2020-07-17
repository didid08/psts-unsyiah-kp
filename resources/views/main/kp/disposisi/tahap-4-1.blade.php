<table width="100%" class="table table-bordered{{ formBackground(13, 13, $disposisi) }}">
	<tbody>
		<tr>
			<td colspan="3" class="align-middle"><b>Pemeriksaan Pembimbing & Pembahas terhadap mahasiswa</b></td>
		</tr>
		<tr>
			<td class="align-middle">1.</td>
			<td class="align-middle">Pembimbing dan Pembahas telah menerima SK</td>
			<td class="align-middle text-center">
				@if (isset($data->pemeriksaan_berkas_kp_1))
					@if ($data->pemeriksaan_berkas_kp_1->content == 'ya')
						<i class="fa fa-check-circle text-success"></i>
					@elseif ($data->pemeriksaan_berkas_kp_1->content == 'tidak')
						<i class="fa fa-times-circle text-danger"></i>
					@endif
				@else
					<input type="checkbox" class="form-control bg-light" disabled="disabled">
				@endif
			</td>
		</tr>
		<tr>
			<td class="align-middle">2.</td>
			<td class="align-middle">Mahasiswa mendapatkan persetujuan pembimbing untuk kelapangan</td>
			<td class="align-middle text-center">
				@if (isset($data->pemeriksaan_berkas_kp_2))
					@if ($data->pemeriksaan_berkas_kp_2->content == 'ya')
						<i class="fa fa-check-circle text-success"></i>
					@elseif ($data->pemeriksaan_berkas_kp_2->content == 'tidak')
						<i class="fa fa-times-circle text-danger"></i>
					@endif
				@else
					<input type="checkbox" class="form-control bg-light" disabled="disabled">
				@endif
			</td>
		</tr>
		<tr>
			<td class="align-middle">3.</td>
			<td class="align-middle">Melaporkan kegiatan menggunakan lembar asistensi panduan kp mengacu pada website : <a target="_blank" href="http://sipil.unsyiah.ac.id/download/">http://sipil.unsyiah.ac.id/download/</a></td>
			<td class="align-middle text-center">
				@if (isset($data->pemeriksaan_berkas_kp_3))
					@if ($data->pemeriksaan_berkas_kp_3->content == 'ya')
						<i class="fa fa-check-circle text-success"></i>
					@elseif ($data->pemeriksaan_berkas_kp_3->content == 'tidak')
						<i class="fa fa-times-circle text-danger"></i>
					@endif
				@else
					<input type="checkbox" class="form-control bg-light" disabled="disabled">
				@endif
			</td>
		</tr>
	</tbody>
</table>