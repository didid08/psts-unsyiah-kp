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
					<td>{{ $mahasiswa->data->where('name', 'no-surat-permohonan-ke-proyek')->first()->content }}</td>
				</tr>
				<tr>
					<td>Hal</td>
					<td>:</td>
					<td>Surat Permohonan Kerja Praktek (KP)</td>
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
	Dengan hormat, melalui surat ini kami beritahukan bahwa untuk menyelesaikan studi pada
	Jurusan Teknik Sipil Fakultas Teknik Universitas Syiah Kuala, setiap Mahasiswa diwajibkan
	untuk melakukan Kerja Praktek Lapangan (KP) pada Proyek yang berhubungan dengan Teknik Sipil.
	Sehubungan dengan hal tersebut maka kami mengharapkan bantuan Saudara agar kiranya
	menerima mahasiswa kami pada Perusahaan/Instansi saudara :
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
	Kerja Praktek ini akan dilakukan selama {{ $mahasiswa->data->where('name', 'kp-selama')->first()->content }}
	terhitung dari adanya persetujuan dari saudara. Persetujuan tersebut dibuktikan dengan balasan surat ini terhitung Sejak 1 (satu) minggu
	setelah tanggal surat ini dikeluarkan.
</div>
<div style="text-align: justify; margin: 1em 0 0 0.3em;">
	Demikian kami mengharapkan surat balasan dari perusahaan atas perhatian serta bantuan saudara kami ucapkan terima kasih.
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