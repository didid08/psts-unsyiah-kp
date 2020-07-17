<table width="100%" class="table table-bordered{{ formBackground(19, 19, $disposisi) }}">
	<tbody>
		<tr>
			<td colspan="3" class="align-middle"><b>Dosen pembimbing dan pembahas telah menerima dokumen KP mahasiswa</b></td>
		</tr>
		<tr>
			<td class="align-middle text-center">1.</td>
			<td class="align-middle">Hardcopy SK Pembimbing / Pembahas, lembar pengesahan, buku laporan KP</td>
			<td class="align-middle text-center">
				@if (isset($data->pemeriksaan_kelengkapan_dokumen_kp_1))
					@if ($data->pemeriksaan_kelengkapan_dokumen_kp_1->content == 'ya')
						<i class="fa fa-check-circle text-success"></i>
					@elseif ($data->pemeriksaan_kelengkapan_dokumen_kp_1->content == 'tidak')
						<i class="fa fa-times-circle text-danger"></i>
					@endif
				@else
					<input type="checkbox" class="form-control bg-light" disabled="disabled">
				@endif
			</td>
		</tr>
		<tr>
			<td class="align-middle text-center">2.</td>
			<td class="align-middle">SK Pembimbing / Pembahas, lembar pengesahan, buku laporan KP</td>
			<td class="align-middle text-center">
				@if (isset($data->pemeriksaan_kelengkapan_dokumen_kp_2))
					@if ($data->pemeriksaan_kelengkapan_dokumen_kp_2->content == 'ya')
						<i class="fa fa-check-circle text-success"></i>
					@elseif ($data->pemeriksaan_kelengkapan_dokumen_kp_2->content == 'tidak')
						<i class="fa fa-times-circle text-danger"></i>
					@endif
				@else
					<input type="checkbox" class="form-control bg-light" disabled="disabled">
				@endif
			</td>
		</tr>
		<tr>
			<td></td>
			<td colspan="2" class="align-middle">
				Email dosen : [cek di <a target="_blank" href="http://sipil.unsyiah.ac.id/">http://sipil.unsyiah.ac.id/</a>]
			</td>
		</tr>
	</tbody>
</table>