<table width="100%" class="table table-bordered{{ formBackground(18, 18, $disposisi) }}">
	<tbody>
		<tr>
			<td colspan="3" class="align-middle"><b>Rekap Nilai KP</b></td>
		</tr>
		<tr>
			<td class="align-middle text-center">1.</td>
			<td class="align-middle">Nilai Pembimbing</td>
			<td class="align-middle text-center">
				@if ($disposisi->progress >= 18)
					<i class="fa fa-check-circle text-green"></i><span class="ml-3">Ada</span>
				@else
					--
				@endif
			</td>
		</tr>
		<tr>
			<td class="align-middle text-center">2.</td>
			<td class="align-middle">Nilai Pembahas</td>
			<td class="align-middle text-center">
				@if ($disposisi->progress >= 18)
					<i class="fa fa-check-circle text-green"></i><span class="ml-3">Ada</span>
				@else
					--
				@endif
			</td>
		</tr>
		<tr>
			<td class="align-middle text-center">3.</td>
			<td class="align-middle">Rekap Nilai KP</td>
			<td class="align-middle text-center">
				@if ($disposisi->progress > 18)
					<i class="fa fa-check-circle text-green"></i><span class="ml-3">Ada</span> (<a href="{{ route('main.kp.cetak-rekap-nilai-kp', ['nim' => $mahasiswa->nomor_induk]) }}" class="text-success">Lihat</a>)
				@elseif ($disposisi->progress == 18)
					<span class="text-yellow">Sedang diproses</span>
				@else
					--
				@endif
			</td>
		</tr>
		<tr>
			<td class="align-middle text-center">4.</td>
			<td class="align-middle">Buku Laporan KP dan Lembar Pengesahan KP</td>
			<td class="align-middle text-center">
				@if ($disposisi->progress >= 18)
					<i class="fa fa-check-circle text-green"></i><span class="ml-3">Ada</span>
				@else
					--
				@endif
			</td>
		</tr>
	</tbody>
</table>