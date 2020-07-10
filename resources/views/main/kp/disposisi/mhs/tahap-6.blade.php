<table width="100%" class="table table-bordered{{ formBackground(16, 16, $disposisi) }}">
	<tbody>
		<tr>
			<td colspan="2" class="align-middle"><b>Laporan KP</b></td>
		</tr>
		<tr>
			<td colspan="2" class="align-middle"><b>Pembimbing memberi catatan KP dan nilai KP</b></td>
		</tr>
		<tr>
			<td class="align-middle">Catatan KP</td>
			<td class="align-middle text-center">
				@if (in_array($disposisi->progress, range(16,16)))
					<span class="text-yellow">Sedang diproses</span>
				@elseif ($disposisi->progress > 16)
					<input type="text" class="form-control bg-light" disabled="disabled" value="..">
				@else
					--
				@endif
			</td>
		</tr>
		<tr>
			<td class="align-middle">Nilai KP</td>
			<td class="align-middle text-center">
				@if (in_array($disposisi->progress, range(16,16)))
					<span class="text-yellow">Sedang diproses</span>
				@elseif ($disposisi->progress > 16)
					<input type="text" class="form-control bg-light" disabled="disabled" value="..">
				@else
					--
				@endif
			</td>
		</tr>
	</tbody>
</table>