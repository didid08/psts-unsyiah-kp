@if (!isset($cetak))
<!DOCTYPE html>
<html>
<head>
	<title>Isi Nilai KP {{ $mahasiswa->nama }} ({{ $mahasiswa->nomor_induk }})</title>
	<meta charset="utf-8">
</head>
<body>
@endif
	<style>
		html, body {
			text-align: center;
			@if (isset($cetak))
			padding:0 5em;
			@else
			padding:0 7em;
			@endif
			font-size: 0.95em;
		}
		#nilai-kerja-praktek {
			border-collapse: collapse;
		}
		#nilai-kerja-praktek tr td {
			text-align: center;
			vertical-align: middle;
			border: 1px solid black;
			padding: 1em;
		}
		#nilai-kerja-praktek tr td input {
			width: 10em;
		}
	</style>
	@if (isset($cetak))
		<table style="margin-left: -5em; margin-right: -5em; margin-bottom: 1em; border-collapse: collapse; border-bottom: 4px solid black;" width="100%">
			<tr>
				<td style="vertical-align: middle; width: 5%; padding-bottom: 1.5em;">
					<img src="{{ public_path('dist/img/logo-unsyiah-3.png') }}" alt="Logo Unsyiah" width="130em">		
				</td>
				<td style="vertical-align: middle; text-align: center; line-height: 1.3em;">
					<div style="font-size: 1.2em;">
						KEMENTERIAN RISET, TEKNOLOGI DAN PENDIDIKAN TINGGI <br>
						UNIVERSITAS SYIAH KUALA <br>
						FAKULTAS TEKNIK <br>
						<span style="font-weight: bold;">JURUSAN TEKNIK SIPIL</span>
					</div>
					<div style="font-size: 0.95em; padding-bottom: 0.3em;">
						Jalan Tengku Syech Abdur Rauf No.7, Darussalam, Banda Aceh 23111 <br>
						Telepon (0651) 755444 <br>
						Website/domain: sipil.unsyiah.ac.id; e-mail: tekniksipil{!! '@' !!}unsyiah.ac.id
					</div>
				</td>
			</tr>
		</table>
	@endif
	<h5>NILAI KERJA PRAKTEK<br><br>DARI PEMBIMBING</h5>
	<div style="text-align: left; margin-bottom: 2em;">
		<h5>Data Kerja Praktek</h5>
		<table width="100%">
			<tr>
				<td style="width: 2%;">1.</td>
				<td>Nama</td>
				<td style="width: 1%;">:</td>
				<td>{{ $mahasiswa->nama }}</td>
			</tr>
			<tr>
				<td style="width: 2%;">2.</td>
				<td>NIM</td>
				<td style="width: 1%;">:</td>
				<td>{{ $mahasiswa->nomor_induk }}</td>
			</tr>
			<tr>
				<td style="width: 2%;">3.</td>
				<td>Bidang</td>
				<td style="width: 1%;">:</td>
				<td>
					{{ str_replace('Bidang ', '', $mahasiswa->data->firstWhere('name', 'bidang')->content) }}
				</td>
			</tr>
			<tr>
				<td style="width: 2%;">4.</td>
				<td>Pembimbing</td>
				<td style="width: 1%;">:</td>
				<td>
					{{ $mahasiswa->data->firstWhere('name', 'pembimbing')->content }}
				</td>
			</tr>
			<tr>
				<td style="width: 2%;">5.</td>
				<td>Waktu KP</td>
				<td style="width: 1%;">:</td>
				<td>
					{{ \Carbon\Carbon::parse($mahasiswa->data->firstWhere('name', 'masa-kerja-praktek-1')->content)->translatedFormat('d F Y') }} s.d. {{ \Carbon\Carbon::parse($mahasiswa->data->firstWhere('name', 'masa-kerja-praktek-2')->content)->translatedFormat('d F Y') }}
				</td>
			</tr>
			<tr>
				<td style="width: 2%;">6.</td>
				<td>Nomor KP</td>
				<td style="width: 1%;">:</td>
				<td>
					{{ $mahasiswa->disposisi->no_disposisi }}
				</td>
			</tr>
			<tr>
				<td style="width: 2%;"></td>
				<td>Judul KP</td>
				<td style="width: 1%;">:</td>
				<td>
					{{ $mahasiswa->data->firstWhere('name', 'judul-kp')->content }}
				</td>
			</tr>
		</table>
	</div>
	<form action="{{ route('main.kp.pembimbing.isi-nilai-kp.simpan', ['nim' => $mahasiswa->nomor_induk]) }}" method="post">
		@csrf
	<div style="text-align: left;">
		<h5>Nilai Kerja Praktek</h5>
		<table width="100%" id="nilai-kerja-praktek">
			<tr>
				<td></td>
				<td>Materi</td>
				<td>Penulisan</td>
				<td>Penguasaan</td>
				<td>Sikap</td>
			</tr>
			<tr>
				<td>Nilai*)</td>
				@if (isset($cetak))
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
				@else
				<td>
					<input type="number" name="materi" placeholder="Masukkan nilai" value="{{ $mahasiswa->data->where('name', 'nilai-materi-pembimbing')->count() > 0 ? $mahasiswa->data->firstWhere('name', 'nilai-materi-pembimbing')->content : '' }}">
				</td>
				<td>
					<input type="number" name="penulisan" placeholder="Masukkan nilai" value="{{ $mahasiswa->data->where('name', 'nilai-penulisan-pembimbing')->count() > 0 ? $mahasiswa->data->firstWhere('name', 'nilai-penulisan-pembimbing')->content : '' }}">
				</td>
				<td>
					<input type="number" name="penguasaan" placeholder="Masukkan nilai" value="{{ $mahasiswa->data->where('name', 'nilai-penguasaan-pembimbing')->count() > 0 ? $mahasiswa->data->firstWhere('name', 'nilai-penguasaan-pembimbing')->content : '' }}">
				</td>
				<td>
					<input type="number" name="sikap" placeholder="Masukkan nilai" value="{{ $mahasiswa->data->where('name', 'nilai-sikap-pembimbing')->count() > 0 ? $mahasiswa->data->firstWhere('name', 'nilai-sikap-pembimbing')->content : '' }}">
				</td>
				@endif
			</tr>
		</table>
	</div>
	<div style="float: right; margin-top: 5em; text-align: left;">
		Darussalam, {{ \Carbon\Carbon::parse(date('d-m-Y'))->translatedFormat('d F Y') }} <br>
		Pembimbing <br><br><span style="margin-left: 5em;">dto</span><br><br>
		<b><u>{{ $mahasiswa->data->firstWhere('name', 'pembimbing')->content }}</u></b><br>
		<b>NIP. {{ \App\User::firstWhere('nama', $mahasiswa->data->firstWhere('name', 'pembimbing')->content)->nomor_induk }}</b>
	</div>

	<div style="text-align: left; margin-bottom: 2em; margin-top: 13em;">
		*) Nilai yang diberikan berupa huruf: <br>
		A = 87 - 100, AB = 78 - 86, B = 69 - 77, BC = 60 - 68, C = 51 - 59, D = 41 - 50
	</div>
	@if (!isset($cetak))
	<hr>
	<button type="submit" style="display: block; padding: 0.5em; width: 100%; font-size: 1.1em;">SIMPAN</button>
</body>
</html>
@endif