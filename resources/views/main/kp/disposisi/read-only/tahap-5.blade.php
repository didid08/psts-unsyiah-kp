<table width="100%" class="table table-bordered{{ formBackground(17, 17, $disposisi) }}">
	<tbody>
		<tr>
			<td colspan="2" class="align-middle"><b>Laporan KP</b></td>
		</tr>
		<tr>
			<td colspan="2" class="align-middle"><b>Pembahas memberi catatan KP dan nilai KP</b></td>
		</tr>
		<tr>
			<td class="align-middle">Catatan KP</td>
			<td class="align-middle text-center">
				@if (in_array($disposisi->progress, range(17,17)))
					<span class="text-yellow">Sedang diproses</span>
				@elseif ($disposisi->progress > 17)
					<input type="text" class="form-control bg-light" disabled="disabled" value="{{ isset($data->catatan_kp_pembahas) ? $data->catatan_kp_pembahas->content : '' }}" placeholder="Tidak ada catatan">
				@else
					--
				@endif
			</td>
		</tr>
		<tr>
			<td class="align-middle">Nilai KP</td>
			<td class="align-middle text-center">
				@if (in_array($disposisi->progress, range(17,17)))
					<span class="text-yellow">Sedang diproses</span>
				@elseif ($disposisi->progress > 17)
					<a href="{{ route('main.kp.cetak-nilai-kp-pembahas', ['nim' => $mahasiswa->nomor_induk]) }}" class="btn btn-sm btn-success">Lihat</a>
				@else
					--
				@endif
			</td>
		</tr>
	</tbody>
</table>