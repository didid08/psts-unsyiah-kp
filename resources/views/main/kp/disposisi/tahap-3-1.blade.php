<table width="100%" class="table table-bordered{{ formBackground(8, 8, $disposisi) }}">
	<tbody>
		<tr>
			<td class="align-middle text-center">1.</td>
			<td class="align-middle">Nama Pembimbing</td>
			<td class="text-center align-middle">
				@if (in_array($disposisi->progress, range(8,8)))
					<span class="text-warning">sedang diproses</span>
				@elseif ($disposisi->progress > 8)
					@if (isset($data->pembimbing))
						@if ($data->pembimbing->verified == true)
							<input type="text" class="form-control bg-light" readonly="readonly" value="{{ $data->pembimbing->content }}">
						@else
							<span class="text-warning">sedang diubah</span>
						@endif
					@else
						<span class="text-warning">sedang diubah</span>
					@endif
				@else
					--
				@endif
			</td>
		</tr>
		<tr>
			<td class="align-middle text-center">2.</td>
			<td class="align-middle">Nama Pembahas</td>
			<td class="text-center align-middle">
				@if (in_array($disposisi->progress, range(8,8)))
					<span class="text-warning">sedang diproses</span>
				@elseif ($disposisi->progress > 8)
					@if (isset($data->pembahas))
						@if ($data->pembahas->verified == true)
							<input type="text" class="form-control bg-light" readonly="readonly" value="{{ $data->pembahas->content }}">
						@else
							<span class="text-warning">sedang diubah</span>
						@endif
					@else
						<span class="text-warning">sedang diubah</span>
					@endif
				@else
					--
				@endif
			</td>
		</tr>
		<tr>
			<td class="align-middle text-center">3.</td>
			<td class="align-middle">Nama Proyek</td>
			<td class="text-center align-middle">
				@if ($disposisi->progress >= 8)
					<textarea class="form-control bg-light" readonly="readonly">{{ $data->nama_proyek->content }}</textarea>
				@else
					--
				@endif
			</td>
		</tr>
	</tbody>
</table>