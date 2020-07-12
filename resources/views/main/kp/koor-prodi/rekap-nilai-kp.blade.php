<style>
	html, body {
		text-align: center;
		padding:0 5em;
		font-size: 0.9em;
	}
	#nilai-kerja-praktek {
		border-collapse: collapse;
	}
	#nilai-kerja-praktek tr td {
		text-align: center;
		vertical-align: middle;
		border: 1px solid black;
		padding: 0.5em;
	}
	#nilai-kerja-praktek tr td input {
		width: 10em;
	}
</style>
<h5>REKAPITULASI<br><br>NILAI KERJA PRAKTEK</h5>
<div style="text-align: left;">
	<h5>Data Kerja Praktek</h5>
	<table>
		<tr>
			<td>1.</td>
			<td style="width: 7em;">Nama</td>
			<td>:</td>
			<td>{{ $mahasiswa->nama }}</td>
		</tr>
		<tr>
			<td>2.</td>
			<td>NIM</td>
			<td>:</td>
			<td>{{ $mahasiswa->nomor_induk }}</td>
		</tr>
		<tr>
			<td>3.</td>
			<td>Bidang</td>
			<td>:</td>
			<td>
				{{ str_replace('Bidang ', '', $mahasiswa->data->firstWhere('name', 'bidang')->content) }}
			</td>
		</tr>
		<tr>
			<td>5.</td>
			<td>Waktu KP</td>
			<td>:</td>
			<td>
				{{ \Carbon\Carbon::parse($mahasiswa->data->firstWhere('name', 'masa-kerja-praktek-1')->content)->translatedFormat('d F Y') }} s.d. {{ \Carbon\Carbon::parse($mahasiswa->data->firstWhere('name', 'masa-kerja-praktek-2')->content)->translatedFormat('d F Y') }}
			</td>
		</tr>
		<tr>
			<td>6.</td>
			<td>Nomor KP</td>
			<td>:</td>
			<td>
				{{ $mahasiswa->disposisi->no_disposisi }}
			</td>
		</tr>
		<tr>
			<td colspan="2">Judul KP</td>
			<td>:</td>
			<td>
				{{ $mahasiswa->data->firstWhere('name', 'judul-kp')->content }}
			</td>
		</tr>
	</table>
</div>
<div style="text-align: left;">
	<h5>Nilai Kerja Praktek</h5>
	<table width="100%" id="nilai-kerja-praktek">
		<tr>
			<td>Penilai</td>
			<td>Materi</td>
			<td>Penulisan</td>
			<td>Penguasaan</td>
			<td>Sikap</td>
		</tr>
		<tr>
			<td style="text-align: left;">
				Pembimbing : <br>
				{{ $mahasiswa->data->firstWhere('name', 'pembimbing')->content }} <br>
				NIP. {{ \App\User::firstWhere('nama', $mahasiswa->data->firstWhere('name', 'pembimbing')->content)->nomor_induk }}
			</td>
			<td>
				{{ $mahasiswa->data->firstWhere('name', 'nilai-materi-pembimbing')->content }}
			</td>
			<td>
				{{ $mahasiswa->data->firstWhere('name', 'nilai-penulisan-pembimbing')->content }}
			</td>
			<td>
				{{ $mahasiswa->data->firstWhere('name', 'nilai-penguasaan-pembimbing')->content }}
			</td>
			<td>
				{{ $mahasiswa->data->firstWhere('name', 'nilai-sikap-pembimbing')->content }}
			</td>
		</tr>
		<tr>
			<td style="text-align: left;">
				Pembahas : <br>
				{{ $mahasiswa->data->firstWhere('name', 'pembahas')->content }} <br>
				NIP. {{ \App\User::firstWhere('nama', $mahasiswa->data->firstWhere('name', 'pembahas')->content)->nomor_induk }}
			</td>
			<td>
				{{ $mahasiswa->data->firstWhere('name', 'nilai-materi-pembahas')->content }}
			</td>
			<td>
				{{ $mahasiswa->data->firstWhere('name', 'nilai-penulisan-pembahas')->content }}
			</td>
			<td>
				{{ $mahasiswa->data->firstWhere('name', 'nilai-penguasaan-pembahas')->content }}
			</td>
			<td>
				{{ $mahasiswa->data->firstWhere('name', 'nilai-sikap-pembahas')->content }}
			</td>
		</tr>
		@php
			$nilaiMateri = $mahasiswa->data->firstWhere('name', 'nilai-materi-pembimbing')->content + $mahasiswa->data->firstWhere('name', 'nilai-materi-pembahas')->content;
			$nilaiPenulisan = $mahasiswa->data->firstWhere('name', 'nilai-penulisan-pembimbing')->content + $mahasiswa->data->firstWhere('name', 'nilai-penulisan-pembahas')->content;
			$nilaiPenguasaan = $mahasiswa->data->firstWhere('name', 'nilai-penguasaan-pembimbing')->content + $mahasiswa->data->firstWhere('name', 'nilai-penguasaan-pembahas')->content;
			$nilaiSikap = $mahasiswa->data->firstWhere('name', 'nilai-sikap-pembimbing')->content + $mahasiswa->data->firstWhere('name', 'nilai-sikap-pembahas')->content;
		@endphp
		<tr>
			<td style="text-align: left;">Jumlah</td>
			<td>
				{{ $nilaiMateri }}
			</td>
			<td>
				{{ $nilaiPenulisan }}
			</td>
			<td>
				{{ $nilaiPenguasaan }}
			</td>
			<td>
				{{ $nilaiSikap }}
			</td>
		</tr>
		<tr>
			@php
				$nilaiAkhir = round((0.15*($nilaiMateri/2))+(0.30*($nilaiPenulisan/2))+(0.45*($nilaiPenguasaan/2))+(0.10*($nilaiSikap/2)));
				$kategori = '...';

				if ($nilaiAkhir >= 87 && $nilaiAkhir <= 100) {
					$kategori = 'A';
				} elseif ($nilaiAkhir >= 78 && $nilaiAkhir <= 86) {
					$kategori = 'AB';
				} elseif ($nilaiAkhir >= 69 && $nilaiAkhir <= 77) {
					$kategori = 'B';
				} elseif ($nilaiAkhir >= 60 && $nilaiAkhir <= 68) {
					$kategori = 'BC';
				} elseif ($nilaiAkhir >= 51 && $nilaiAkhir <= 59) {
					$kategori = 'C';
				} elseif ($nilaiAkhir >= 41 && $nilaiAkhir <= 50) {
					$kategori = 'D';
				}
			@endphp
			<td style="text-align: left;">Nilai Akhir KP: ({{ $kategori }})</td>
			<td>
				{{ str_replace('.', ',', $nilaiMateri/2) }}
			</td>
			<td>
				{{ str_replace('.', ',', $nilaiPenulisan/2) }}
			</td>
			<td>
				{{ str_replace('.', ',', $nilaiPenguasaan/2) }}
			</td>
			<td>
				{{ str_replace('.', ',', $nilaiSikap/2) }}
			</td>
		</tr>
	</table>
</div>
<style>
	#rekapitulasi {
		table-layout: auto;
		text-align: left;
		border-collapse: collapse;
	}
	#rekapitulasi tr td {
		padding: 0.1em 0.5em 0.1em 0;
	}
</style>
<div style="text-align: left; margin-top: 2em;">
	<table id="rekapitulasi">
		<tr>
			<td>Rekapitulasi Nilai</td>
			<td colspan="5">:</td>
		</tr>
		<tr>
			<td>Rekapitulasi Nilai</td>
			<td colspan="5">:</td>
		</tr>
		<tr>
			<td>Materi</td>
			<td>:</td>
			<td>0,15 x {{ str_replace('.', ',', $nilaiMateri/2) }}</td>
			<td>=</td>
			<td>{{ str_replace('.', ',', 0.15*($nilaiMateri/2)) }}</td>
			<td></td>
		</tr>
		<tr>
			<td>Penulisan</td>
			<td>:</td>
			<td>0,30 x {{ str_replace('.', ',', $nilaiPenulisan/2) }}</td>
			<td>=</td>
			<td>{{ str_replace('.', ',', 0.30*($nilaiPenulisan/2)) }}</td>
			<td></td>
		</tr>
		<tr>
			<td>Penguasaan</td>
			<td>:</td>
			<td>0,45 x {{ str_replace('.', ',', $nilaiPenguasaan/2) }}</td>
			<td>=</td>
			<td>{{ str_replace('.', ',', 0.45*($nilaiPenguasaan/2)) }}</td>
			<td></td>
		</tr>
		<tr>
			<td>Sikap</td>
			<td>:</td>
			<td style="border-bottom: 1px solid black;">0,10 x {{ str_replace('.', ',', $nilaiSikap/2) }}</td>
			<td style="border-bottom: 1px solid black;">=</td>
			<td style="border-bottom: 1px solid black;">{{ str_replace('.', ',', 0.10*($nilaiSikap/2)) }}</td>
			<td style="border-bottom: 1px solid black;">+</td>
		</tr>
	</table>
</div>
<div style="text-align: left; margin-top: 1em;">
	<table width="100%">
		<tr>
			<td style="width: 70%;">
				<table style="table-layout: auto; text-align: left; border-collapse: collapse;">
					<tr>
						<td colspan="3">Kategori Nilai:</td>
					</tr>
					<tr>
						<td>A</td>
						<td>=</td>
						<td>87 - 100</td>
					</tr>
					<tr>
						<td>AB</td>
						<td>=</td>
						<td>78 - 86</td>
					</tr>
					<tr>
						<td>B</td>
						<td>=</td>
						<td>69 - 77</td>
					</tr>
					<tr>
						<td>BC</td>
						<td>=</td>
						<td>60 - 68</td>
					</tr>
					<tr>
						<td>C</td>
						<td>=</td>
						<td>51 - 59</td>
					</tr>
					<tr>
						<td>D</td>
						<td>=</td>
						<td>41 - 50</td>
					</tr>
				</table>
			</td>
			<td>
				Darussalam, {{ \Carbon\Carbon::parse(date('d-m-Y'))->translatedFormat('F Y') }} <br>
				Koordinator Program Studi <br><br><span style="margin-left: 3em;">dto</span><br><br>
				<b><u>Fachrurrazi, S.T., M.T.</u></b><br>
				<b>NIP. 197005062000121001</b>
			</td>
		</tr>
	</table>
</div>

<div style="text-align: left; margin-top: 5em;">
	*) Nilai yang diberikan berupa huruf: A = 87 - 100, AB = 78 - 86, B = 69 - 77, BC = 60 - 68, C = 51 - 59, D = 41 - 50
</div>