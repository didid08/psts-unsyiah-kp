<style>
	html, body {
		font-size: 0.95em;
	}
</style>
<table style="margin-bottom: 1em; border-collapse: collapse; border-bottom: 4px solid black;" width="100%">
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
<table width="100%">
	<tr>
		<td>
			<table style="line-height: 1em;">
				<tr>
					<td>Nomor</td>
					<td>:</td>
					<td>{{ $mahasiswa->data->where('name', 'no-surat-ke-proyek')->first()->content }}</td>
				</tr>
				<tr>
					<td>Hal</td>
					<td>:</td>
					<td>Pengantar Surat Kerja Praktek (KP)</td>
				</tr>
			</table>
		</td>
		<td style="text-align: right;">
			Darussalam, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}
		</td>
	</tr>
	<tr>
		<td>
			<table style="line-height: 1em;">
				<tr>
					<td>Yth : Direktur {{ $mahasiswa->data->where('name', 'nama-direktur-perusahaan')->first()->content }}</td>
				</tr>
				<tr>
					<td>U.P . {{ $mahasiswa->data->where('name', 'nama-bapak-ibu-pada-tujuan-surat')->first()->content }}</td>
				</tr>
				<tr>
					<td>{{ $mahasiswa->data->where('name', 'alamat-proyek')->first()->content }}</td>
				</tr>
			</table>
		</td>
		<td></td>
	</tr>
</table>
<div style="text-align: justify; margin: 1em 0 0 0.3em;">
	Berkaitan dengan pelaksanaan Kerja Praktek (KP) mahasiswa Program Studi Teknik Sipil
	Fakultas Teknik Universitas Syiah Kuala, untuk itu kami mohon bantuan Bapak/Ibu/Sdr,
	berkenan membimbing dan mengarahkan Kerja Praktek mahasiswa di bawah ini, guna
	mengumpulkan data, pengamatan lapangan sampai dengan penyusunan laporan.
</div>
<div style="text-align: justify; margin: 1em 0 0 0.3em;">
	Nama mahasiswa tersebut adalah:
</div>
<style>
	#table-info {
		border-collapse: collapse;
		margin: 2em 0 0 0.3em;
	}
	#table-info tr td {
		border: 1px solid black;
		padding: 0.4em;
	}
</style>
<table width="100%" id="table-info">
	<tr>
		<td style="vertical-align: middle; text-align: center; width: 1%;">No</td>
		<td style="vertical-align: middle; text-align: center;">Nama/NIM</td>
		<td style="vertical-align: middle; text-align: center;">Bidang</td>
		<td style="vertical-align: middle; text-align: center;">Nama Proyek</td>
	</tr>
	<tr>
		<td style="vertical-align: middle; text-align: center;">1.</td>
		<td style="vertical-align: top;">{{ $mahasiswa->nama }}<br>{{ $mahasiswa->nomor_induk }}</td>
		<td style="vertical-align: top;">{{ str_replace('Bidang ', '', $mahasiswa->data->where('name', 'bidang')->first()->content) }}</td>
		<td style="vertical-align: top;">{{ $mahasiswa->data->where('name', 'nama-proyek')->first()->content }}</td>
	</tr>
</table>
<div style="text-align: justify; margin: 2em 0 0 0.3em;">
	Kerja Praktek ini akan dilakukan selama {{ $mahasiswa->data->where('name', 'kp-selama')->first()->content }}.
	Pelaksanaan proses Kerja Praktek dalam bimbingan pembimbing {{ $mahasiswa->data->where('name', 'pembimbing')->first()->content }} NIP. {{ \App\User::where('nama', $mahasiswa->data->where('name', 'pembimbing')->first()->content)->first()->nomor_induk }},
	pembahas {{ $mahasiswa->data->where('name', 'pembahas')->first()->content }} NIP. {{ \App\User::where('nama', $mahasiswa->data->where('name', 'pembahas')->first()->content)->first()->nomor_induk }},
	serta pembimbing lapangan di proyek {{ $mahasiswa->data->where('name', 'pembimbing-lapangan-kp')->first()->content }}.
</div>
<div style="text-align: justify; margin: 1em 0 0 0.3em;">
	Demikian permohonan kami, terima kasih atas perhatian dan kerjasamanya.
</div>
<table width="100%" style="margin: 2em 0 0 0.3em;">
	<tr>
		<td style="width: 68%;"></td>
		<td style="text-align: left;">
			Koordinator Prodi Teknik Sipil, <br><br><br><br>
			Fachrurrazi, S.T., M.T. <br>
			NIP. 197005062000121001
		</td>
	</tr>
</table>
<div style="margin: 1em 0 0 0.3em;">
	Tembusan : <br>
	1. Pembimbing Kerja Praktek <br>
	2. Mahasiswa Yang Bersangkutan
</div>