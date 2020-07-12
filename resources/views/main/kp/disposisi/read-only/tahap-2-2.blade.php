<table width="100%" class="table table-bordered{{ formBackground(5, 6, $disposisi) }}">
	<tbody>
		<tr>
			<td colspan="2" class="align-middle"><b>Pengajuan Surat Ke Proyek</b></td>
		</tr>
		<tr>
			<td class="align-middle">Surat Permohonan Ke Proyek</td>
			<td class="text-center align-middle">
				@if ($disposisi->progress == 5)
					Belum diunggah
				@elseif (in_array($disposisi->progress, range(6,6)))
					<span class="text-warning">sedang diperiksa</span>
				@elseif ($disposisi->progress > 6)
					<i class="fa fa-check-circle text-green"></i><span class="ml-3">Ada</span>
				@else
					Belum diunggah
				@endif
			</td>
		</tr>
	</tbody>
</table>