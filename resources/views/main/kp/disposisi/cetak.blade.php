<style>
	* {
		font-size: 0.94em;
	}
	.header {
		text-align: center;
		margin-bottom: 0.3em;
		font-weight: bold;
	}
	#table {
		border: 1px solid black;
		vertical-align: middle;
		border-collapse: collapse;
	}
	#table tr td:nth-child(3) {
		text-align: left;
		vertical-align: top;
	}
	#table td {
		text-align: center;
		border: 1px solid black;
		padding: 4px;
	}
	.table-header {
		text-align: center;
		padding: 4px;
		background-color: rgba(0,0,0,0.2);
		font-weight: bold;
	}
</style>

<div class="header">
	LEMBAR DISPOSISI KERJA PRAKTEK - JURUSAN TEKNIK SIPIL
</div>
<div class="header">
	FAKULTAS TEKNIK UNIVERSITAS SYIAH KUALA
</div>
<div class="header">
	No. {{ isset($disposisi->no_disposisi) ? $disposisi->no_disposisi : '--' }}
</div>
<div class="header" style="text-align: right;">
	No. Dokumen : PSTS - KP - 01
</div>
<table width="100%">
	<tr>
		<td>Nama Mahasiswa</td>
		<td style="width: 3%;">:</td>
		<td>{{ $profil->nama }}</td>
		<td style="width: 7%;">Bidang</td>
		<td style="width: 3%;">:</td>
		<td>{{ isset($data->bidang) ? str_replace('Bidang ', '', $data->bidang->content) : '--' }}</td>
	</tr>
	<tr>
		<td>NIM</td>
		<td style="width: 3%;">:</td>
		<td>{{ $profil->nomor_induk }}</td>
		<td>No. HP</td>
		<td style="width: 3%;">:</td>
		<td>{{ isset($data->no_hp) ? $data->no_hp->content : '--' }}</td>
	</tr>
</table>

<table width="100%" id="table">
	<tr class="table-header">
		<td>Tahap</td>
		<td>Disposisi</td>
		<td style="vertical-align: middle; text-align: center;">Uraian</td>
		<td>Pejabat<br>Dto/Tanggal</td>
	</tr>
	<tr>
		<td>1</td>
		<td>Prodi S1</td>
		<td>
			<div>
				1. SPP (Asli) <span style="float: right;"><input type="checkbox" {{ $disposisi->progress > 2 ? 'checked' : '' }}>&nbsp;&nbsp;Ada</span>
			</div>
			<div>
				2. KRS (Semester Terakhir) <span style="float: right;"><input type="checkbox" {{ $disposisi->progress > 2 ? 'checked' : '' }}>&nbsp;&nbsp;Ada</span>
			</div>
			<div>
				3. Transkrip Sementara <span style="float: right;"><input type="checkbox" {{ $disposisi->progress > 2 ? 'checked' : '' }}>&nbsp;&nbsp;Ada</span>
			</div>
		</td>
		<td>
			<div>Diperiksa oleh</div>
			<div style="padding: 0.5em;">
				@if ($disposisi->progress > 3)
					dto&nbsp;&nbsp;{{ date('d/m/Y', strtotime($data->spp->updated_at)) }}
				@else
					&nbsp;
				@endif
			</div>
			<div style="font-weight: bold;">
				Koordinator Program Studi
			</div>
		</td>
	</tr>
	<tr>
		<td>2</td>
		<td>Kelompok<br>Keahlian</td>
		<td>
			<div>1. Nama Pembimbing</div>
			<div style="padding: 0.1em 0.8em;">
				@if ($disposisi->progress > 8)
					<i>{{ $data->pembimbing->content }}</i>
				@else
					&nbsp;
				@endif
			</div>
			<div>2. Nama Pembahas</div>
			<div style="padding: 0.1em 0.8em;">
				@if ($disposisi->progress > 8)
					<i>{{ $data->pembahas->content }}</i>
				@else
					&nbsp;
				@endif
			</div>
			<div>Nama Proyek</div>
			<div style="padding: 0.1em 0.8em;">
				@if ($disposisi->progress > 8)
					<i>{{ $data->judul_kp->content }}</i>
				@else
					&nbsp;
				@endif
			</div>
		</td>
		<td>
			<div>Diusulkan oleh</div>
			<div style="padding: 0.5em;">
				@if ($disposisi->progress > 8)
					dto
				@else
					&nbsp;
				@endif
			</div>
			<div style="font-weight: bold;">
				Ketua Kelompok Keahlian
			</div>
		</td>
	</tr>
	<tr>
		<td>3</td>
		<td>Prodi S1</td>
		<td>
			<div>1. Surat Ke Proyek <span style="float: right;"><input type="checkbox" {{ $disposisi->progress > 10 ? 'checked' : '' }}></span></div>
			<div style="padding: 0.1em 0.8em;">
				@if ($disposisi->progress > 10)
					No. {{ $data->surat_ke_proyek->no }}
					<span style="float: right;">Tgl.</span>
				@else
					No.
					<span style="float: right;">Tgl.</span>
				@endif
			</div>
			<div>2. SK Pembimbing dan Pembahas KP <span style="float: right;"><input type="checkbox" {{ $disposisi->progress > 12 ? 'checked' : '' }}></span></div>
			<div style="padding: 0.1em 0.8em;">
				@if ($disposisi->progress > 12)
					No. {{ $data->sk_pembimbing_pembahas->no }}
					<span style="float: right;">Tgl. {{ date('d/m/Y', strtotime($data->sk_pembimbing_pembahas->tgl)) }} </span>
				@else
					No.
					<span style="float: right;">Tgl.</span>
				@endif
			</div>
		</td>
		<td>
			<div>Ditetapkan oleh</div>
			<div style="padding: 0.5em;">
				@if ($disposisi->progress > 12)
					dto
				@else
					&nbsp;
				@endif
			</div>
			<div style="font-weight: bold;">
				Koordinator Program Studi
			</div>
		</td>
	</tr>
	<tr>
		<td>4</td>
		<td>Pembimbing KP</td>
		<td>
			<div>
				1. Pembimbing dan Pembahas telah menerima SK <span style="float: right;"><input type="checkbox" {{ isset($data->pemeriksaan_berkas_kp_1) ? ($data->pemeriksaan_berkas_kp_1->content == 'ya' ? 'checked' : '') : '' }}></span>
			</div>
			<div>
				2. Mahasiswa mendapatkan persetujuan pembimbing untuk kelapangan <span style="float: right;"><input type="checkbox" {{ isset($data->pemeriksaan_berkas_kp_2) ? ($data->pemeriksaan_berkas_kp_2->content == 'ya' ? 'checked' : '') : '' }}></span>
			</div>
			<div>
				3. Melaporkan kegiatan menggunakan lembar asistensi panduan kp mengacu pada website : http://sipil.unsyiah.ac.id/download/ <span style="float: right;"><input type="checkbox" {{ isset($data->pemeriksaan_berkas_kp_3) ? ($data->pemeriksaan_berkas_kp_3->content == 'ya' ? 'checked' : '') : '' }}></span>
			</div>
		</td>
		<td>
			<div>Disetujui oleh</div>
			<div style="padding: 0.5em;">
				@if ($disposisi->progress > 13)
					dto
				@else
					&nbsp;
				@endif
			</div>
			<div style="font-weight: bold;">
				Pembimbing KP
			</div>
		</td>
	</tr>
	<tr>
		<td>5</td>
		<td>Mahasiswa</td>
		<td>
			<div>
				Masa Kerja Praktek telah diselesaikan sejak
			</div>
			<div>
				@if ($disposisi->progress > 15)
					Tgl {{ date('d/m/Y', strtotime($data->masa_kerja_praktek_1->content)) }} s/d {{ date('d/m/Y', strtotime($data->masa_kerja_praktek_2->content)) }}
				@else
					Tgl ......... s/d .........
				@endif
			</div>
			<div>
				(Surat keterangan telah selesai KP dari penanggung jawab KP) <span style="float: right;"><input type="checkbox" {{ $disposisi->progress > 15 ? 'checked' : '' }}></span>
			</div>
		</td>
		<td>
			<div style="text-align: left;">Penanggung Jawab<br>dilapangan</div>
			<div style="padding: 0.5em;">
				@if ($disposisi->progress > 15)
					dto
				@else
					&nbsp;
				@endif
			</div>
			<div style="font-weight: bold; text-align: left;">
				Nama: 
			</div>
		</td>
	</tr>
	<tr>
		<td>6</td>
		<td>Pembimbing KP</td>
		<td>
			<div>
				Laporan KP
			</div>
			<div>
				Catatan Pembimbing (Jika diperlukan)
			</div>
			<div style="padding-left: 0.5em; font-style: italic;">
				@if (isset($data->catatan_kp_pembimbing))
					{{ $data->catatan_kp_pembimbing->content }}
				@else
					............................................................................................................
				@endif
			</div>
		</td>
		<td>
			<div>Diperiksa dan dinilai oleh</div>
			<div style="padding: 0.5em;">
				@if ($disposisi->progress > 16)
					dto
				@else
					&nbsp;
				@endif
			</div>
			<div style="font-weight: bold;">
				Pembimbing KP
			</div>
		</td>
	</tr>
	<tr>
		<td>7</td>
		<td>Pembahas KP</td>
		<td>
			<div>
				Laporan KP
			</div>
			<div>
				Catatan Pembahas (Jika diperlukan)
			</div>
			<div style="padding-left: 0.5em; font-style: italic;">
				@if (isset($data->catatan_kp_pembahas))
					{{ $data->catatan_kp_pembahas->content }}
				@else
					............................................................................................................
				@endif
			</div>
		</td>
		<td>
			<div>Diperiksa dan dinilai oleh</div>
			<div style="padding: 0.5em;">
				@if ($disposisi->progress > 17)
					dto
				@else
					&nbsp;
				@endif
			</div>
			<div style="font-weight: bold;">
				Pembahas KP
			</div>
		</td>
	</tr>
	<tr>
		<td>8</td>
		<td>Prodi S1</td>
		<td>
			<div>
				1. Nilai Pembimbing <span style="float: right;"><input type="checkbox" {{ $disposisi->progress > 17 ? 'checked' : '' }}></span>
			</div>
			<div>
				2. Nilai Pembahas <span style="float: right;"><input type="checkbox" {{ $disposisi->progress > 17 ? 'checked' : '' }}></span>
			</div>
			<div>
				3. Rekap Nilai KP <span style="float: right;"><input type="checkbox" {{ $disposisi->progress > 18 ? 'checked' : '' }}></span>
			</div>
			<div>
				4. Buku Laporan KP dan Lembar Pengesahan KP <span style="float: right;"><input type="checkbox" {{ $disposisi->progress > 17 ? 'checked' : '' }}></span>
			</div>
		</td>
		<td>
			<div>Direkap dan divalidasi oleh</div>
			<div style="padding: 0.5em;">
				@if ($disposisi->progress > 18)
					dto
				@else
					&nbsp;
				@endif
			</div>
			<div style="font-weight: bold;">
				Koordinator Program Studi
			</div>
		</td>
	</tr>

	<tr>
		<td>9</td>
		<td>Pembimbing KP</td>
		<td>
			<div>
				Dosen pembimbing dan pembahas telah menerima dokumen KP mahasiswa
			</div>
			<div>
				1. Hardcopy SK Pembimbing / Pembahas, lembar pengesahan, buku laporan KP <span style="float: right;"><input type="checkbox" {{ isset($data->pemeriksaan_kelengkapan_dokumen_kp_1) ? ($data->pemeriksaan_kelengkapan_dokumen_kp_1->content == 'ya' ? 'checked' : '') : '' }}></span>
			</div>
			<div>
				2. SK Pembimbing / Pembahas, lembar pengesahan, buku laporan KP <span style="float: right;"><input type="checkbox" {{ isset($data->pemeriksaan_kelengkapan_dokumen_kp_2) ? ($data->pemeriksaan_kelengkapan_dokumen_kp_2->content == 'ya' ? 'checked' : '') : '' }}></span>
			</div>
			<div>
				Email dosen : [cek di http://sipil.unsyiah.ac.id/]
			</div>
		</td>
		<td>
			<div>Diterima oleh</div>
			<div style="padding: 0.5em;">
				@if ($disposisi->progress > 18)
					dto
				@else
					&nbsp;
				@endif
			</div>
			<div style="font-weight: bold;">
				Pembimbing KP
			</div>
		</td>
	</tr>
	<tr>
		<td>10</td>
		<td>Administrasi</td>
		<td>
			<div>
				1. Kelengkapan dokumen administrasi (Dokumen: PSTS-2) <span style="float: right;"><input type="checkbox" {{ $disposisi->progress > 18 ? 'checked' : '' }}></span>
			</div>
			<div>
				2. Softcopy dokumen administrasi <span style="float: right;"><input type="checkbox" {{ $disposisi->progress > 18 ? 'checked' : '' }}></span>
			</div>
			<div style="margin-left: 1em;">
				nama file: Nim_KP.zip <span style="float: right;"><input type="checkbox" {{ $disposisi->progress > 18 ? 'checked' : '' }}></span>
			</div>
			<div style="margin-left: 1em;">
				email administrasi:  jtspsts{!! '@' !!}gmail.com
			</div>
		</td>
		<td>
			<div>Diperiksa oleh</div>
			<div style="padding: 0.5em;">
				@if ($disposisi->progress > 18)
					dto
				@else
					&nbsp;
				@endif
			</div>
			<div style="font-weight: bold;">
				Administrasi Prodi
			</div>
		</td>
	</tr>
</table>
<span style="font-size: 0.8em;">* Lembar disposisi dilampirkan setiap proses administrasi</span>
<div>
	<div style="float:right; text-align: left; font-size: 0.8em;">
		Koordinator Program Studi
		@if ($disposisi->progress > 18)
			<div style="margin: 0.5em; margin-left: 3em; font-weight: bold;">dto</div>
		@else
			<br><br><br>
		@endif
		Fachrurrazi, S.T., M.T.
		<br>
		Nip. 197005062000121001
	</div>
</div>