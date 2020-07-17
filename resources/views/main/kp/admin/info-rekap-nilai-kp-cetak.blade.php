<h4>Daftar Nilai Rekap KP Mahasiswa</h4>
<style>
	table {
		border-collapse: collapse;
		font-size: 0.85em;
	}
	table tr td, table tr th {
		border: 1px solid black;
		padding: 0.4em;
		vertical-align: middle;
		text-align: center;
	}
</style>
<table width="100%">
	<tr>
		<th>No</th>
		<th>Nama</th>
		<th>NIM</th>
		<th>Nilai KP</th>
		<th>Pembimbing</th>
		<th>Pembahas</th>
	</tr>
	@foreach ($semua_mahasiswa as $index => $mahasiswa)
		@php
			$nilaiMateri = $mahasiswa->user->data->firstWhere('name', 'nilai-materi-pembimbing')->content + $mahasiswa->user->data->firstWhere('name', 'nilai-materi-pembahas')->content;
			$nilaiPenulisan = $mahasiswa->user->data->firstWhere('name', 'nilai-penulisan-pembimbing')->content + $mahasiswa->user->data->firstWhere('name', 'nilai-penulisan-pembahas')->content;
			$nilaiPenguasaan = $mahasiswa->user->data->firstWhere('name', 'nilai-penguasaan-pembimbing')->content + $mahasiswa->user->data->firstWhere('name', 'nilai-penguasaan-pembahas')->content;
			$nilaiSikap = $mahasiswa->user->data->firstWhere('name', 'nilai-sikap-pembimbing')->content + $mahasiswa->user->data->firstWhere('name', 'nilai-sikap-pembahas')->content;

			$nilaiAkhir = round((0.15*($nilaiMateri/2))+(0.30*($nilaiPenulisan/2))+(0.45*($nilaiPenguasaan/2))+(0.10*($nilaiSikap/2)));
			$nilai_kp = '...';

			if ($nilaiAkhir >= 87 && $nilaiAkhir <= 100) {
				$nilai_kp = 'A';
			} elseif ($nilaiAkhir >= 78 && $nilaiAkhir <= 86) {
				$nilai_kp = 'AB';
			} elseif ($nilaiAkhir >= 69 && $nilaiAkhir <= 77) {
				$nilai_kp = 'B';
			} elseif ($nilaiAkhir >= 60 && $nilaiAkhir <= 68) {
				$nilai_kp = 'BC';
			} elseif ($nilaiAkhir >= 51 && $nilaiAkhir <= 59) {
				$nilai_kp = 'C';
			} elseif ($nilaiAkhir >= 41 && $nilaiAkhir <= 50) {
				$nilai_kp = 'D';
			}
		@endphp
		<tr>
			<td>{{ $index+1 }}</td>
			<td style="text-align: left;">{{ $mahasiswa->user->nama }}</td>
			<td>{{ $mahasiswa->user->nomor_induk }}</td>
			<td>{{ $nilai_kp ?? '' }}</td>
			<td>
				{{ $mahasiswa->user->data->where('name', 'pembimbing')->first()->content }}
			</td>
			<td class="align-middle text-center">
				{{ $mahasiswa->user->data->where('name', 'pembahas')->first()->content }}
			</td>
		</tr>
	@endforeach
</table>