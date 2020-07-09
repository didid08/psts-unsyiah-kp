<table width="100%" class="table table-bordered{{ formBackground(8, 9, $disposisi) }}">
	<tbody>
		<tr>
			<td class="text-center align-middle">1.</td>
			<td class="align-middle font-weight-bold">Surat Ke Proyek</td>
			<td class="align-middle text-center">
				@if ($disposisi->progress > 9)
					{{--<a href="{{ route('main.file', ['filename' => $data->surat_ke_proyek->content]) }}" class="btn btn-sm btn-success">Unduh</a>--}}
				@endif
			</td>
		</tr>
		<tr>
			<td class="align-middle"></td>
			<td class="align-middle font-italic">No</td>
			<td class="text-center align-middle">
				@if (in_array($disposisi->progress, range(8,9)))
					<span class="text-warning">sedang diproses</span>
				@elseif ($disposisi->progress > 9)
					{{--<input type="text" class="form-control bg-light" readonly="readonly" value="{{ $data->surat_ke_proyek->no }}">--}}
				@else
					--
				@endif
			</td>
		</tr>
		<tr>
			<td class="align-middle"></td>
			<td class="align-middle font-italic">Tgl</td>
			<td class="text-center align-middle">
				@if (in_array($disposisi->progress, range(8,9)))
					<span class="text-warning">sedang diproses</span>
				@elseif ($disposisi->progress > 9)
					{{--<input type="text" class="form-control bg-light" readonly="readonly" value="{{ date('d-m-Y', strtotime($data->surat_ke_proyek->tgl)) }}">--}}
				@else
					--
				@endif
			</td>
		</tr>
	</tbody>
</table>