<table width="112%" class="table table-bordered{{ formBackground(11, 12, $disposisi) }}">
	<tbody>
		<tr>
			<td class="text-center align-middle">3.</td>
			<td class="align-middle font-weight-bold">Surat Balasan Dari Proyek</td>
			<td class="align-middle text-center">
				@if ($disposisi->progress == 11)
					Belum diunggah
				@elseif (in_array($disposisi->progress, range(12,12)))
					<span class="text-warning">sedang diperiksa</span>
				@elseif ($disposisi->progress > 12)
					@if (isset($role->admin))
						<i class="fa fa-check-circle text-green"></i><span class="ml-3">Ada</span> (<a href="{{ route('main.file', ['filename' => $data->surat_balasan_dari_proyek->content]) }}" class="text-green">Unduh</a>)
					@else
						<i class="fa fa-check-circle text-green"></i><span class="ml-3">Ada</span>
					@endif
				@else
					Belum diunggah
				@endif
			</td>
		</tr>
	</tbody>
</table>