<table width="100%" class="table table-bordered{{ formBackground(14, 15, $disposisi) }}">
	<tbody>
		<tr>
			<td class="align-middle">1.</td>
			<td class="align-middle">Masa Kerja Praktek</td>
			<td class="align-middle">
				@if ($disposisi->progress == 14)
					Belum diunggah
				@elseif (in_array($disposisi->progress, range(15,15)))
					<span class="text-yellow">Sedang diperiksa</span>
				@elseif ($disposisi->progress > 15)
					Tgl <u>{{ date('d/m/Y', strtotime($data->masa_kerja_praktek_1->content)) }}</u> s/d <u>{{ date('d/m/Y', strtotime($data->masa_kerja_praktek_2->content)) }}</u>
				@else
					Belum diunggah
				@endif
			</td>
		</tr>
		<tr>
			<td class="align-middle">2.</td>
			<td class="align-middle">Surat keterangan telah selesai KP dari penanggung jawab KP</td>
			<td class="align-middle">
				@if ($disposisi->progress == 14)
					Belum diunggah
				@elseif (in_array($disposisi->progress, range(15,15)))
					<span class="text-yellow">Sedang diperiksa</span>
				@elseif ($disposisi->progress > 15)
					<i class="fa fa-check-circle text-green"></i><span class="ml-3">Ada</span>
				@else
					Belum diunggah
				@endif
			</td>
		</tr>
		<tr>
			<td class="align-middle text-center">3.</td>
			<td class="align-middle">Buku Laporan KP</td>
			<td class="align-middle">
				@if ($disposisi->progress == 14)
					Belum diunggah
				@elseif (in_array($disposisi->progress, range(15,15)))
					<span class="text-yellow">Sedang diperiksa</span>
				@elseif ($disposisi->progress > 15)
					<i class="fa fa-check-circle text-green"></i><span class="ml-3">Ada</span>
				@else
					Belum diunggah
				@endif
			</td>
		</tr>
		<tr>
			<td class="align-middle text-center">4.</td>
			<td class="align-middle">Lembar Pengesahan KP</td>
			<td class="align-middle">
				@if ($disposisi->progress == 14)
					Belum diunggah
				@elseif (in_array($disposisi->progress, range(15,15)))
					<span class="text-yellow">Sedang diperiksa</span>
				@elseif ($disposisi->progress > 15)
					<i class="fa fa-check-circle text-green"></i><span class="ml-3">Ada</span>
				@else
					Belum diunggah
				@endif
			</td>
		</tr>
	</tbody>
</table>