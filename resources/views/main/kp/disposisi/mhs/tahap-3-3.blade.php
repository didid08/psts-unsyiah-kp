<table width="110%" class="table table-bordered{{ formBackground(11, 12, $disposisi) }}">
	<tbody>
		<tr>
			<td class="text-center align-middle">5.</td>
			<td class="align-middle font-weight-bold">SK Penunjukan Pembimbing & Pembahas KP</td>
			<td class="align-middle text-center">
				@if ($disposisi->progress > 12)
					<a href="{{ route('main.file', ['filename' => $data->sk_pembimbing_pembahas->content]) }}" class="btn btn-sm btn-success">Unduh</a>
				@endif
			</td>
		</tr>
		<tr>
			<td class="align-middle"></td>
			<td class="align-middle font-italic">No</td>
			<td class="text-center align-middle">
				@if (in_array($disposisi->progress, range(11,12)))
					<span class="text-warning">sedang diproses</span>
				@elseif ($disposisi->progress > 12)
					<input type="text" class="form-control bg-light" readonly="readonly" value="{{ $data->sk_pembimbing_pembahas->no }}">
				@else
					--
				@endif
			</td>
		</tr>
		<tr>
			<td class="align-middle"></td>
			<td class="align-middle font-italic">Tgl</td>
			<td class="text-center align-middle">
				@if (in_array($disposisi->progress, range(11,12)))
					<span class="text-warning">sedang diproses</span>
				@elseif ($disposisi->progress > 12)
					<input type="text" class="form-control bg-light" readonly="readonly" value="{{ date('d-m-Y', strtotime($data->sk_pembimbing_pembahas->tgl)) }}">
				@else
					--
				@endif
			</td>
		</tr>
	</tbody>
</table>