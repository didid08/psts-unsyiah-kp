@extends('main.master')

@section('custom-script')
	<script>
		$("#usulan-pengisian-masa-kp").dataTable();
	</script>
@endsection

@section('content')
	<div class="container">
		<div class="card">
			<div class="card-body" style="overflow-x: auto;">
				<table class="table table-bordered table-striped" id="usulan-pengisian-masa-kp">
					<thead>
						<tr class="bg-green">
							<th scope="col" class="align-middle text-center">No</th>
							<th scope="col" class="align-middle text-left">Nama</th>
							<th scope="col" class="align-middle text-center">NIM</th>
							<th scope="col" class="align-middle text-center">Masa Kerja Praktek</th>
							<th scope="col" class="align-middle text-center">Surat Keterangan Telah Selesai KP</th>
							<th scope="col" class="align-middle text-center">Buku Laporan KP</th>
							<th scope="col" class="align-middle text-center">Lembar Pengesahan KP</th>
							<th scope="col" class="align-middle text-center">Opsi 1</th>
							<th scope="col" class="align-middle text-center">Opsi 2</th>
						</tr>
					</thead>
					<tbody>
						@php
							$isEmpty = true;
						@endphp

						@foreach ($semua_mahasiswa as $index => $mahasiswa)
							@php
								$isEmpty = false;
								$mhsId = $mahasiswa->user_id;
							@endphp
							<tr>
								<form action="{{ route('main.kp.admin.usulan-pengisian-masa-kp.process', ['nim' => $mahasiswa->user->nomor_induk, 'opsi' => 'accept']) }}" method="post" style="display: inline;" enctype="multipart/form-data">
									<td class="align-middle text-center">{{ $index+1 }}</td>
									<td class="align-middle text-left">{{ $mahasiswa->user->nama }}</td>
									<td class="align-middle text-center">{{ $mahasiswa->user->nomor_induk }}</td>
									<td class="align-middle text-center">
										Tgl <u>{{ date('d/m/Y', strtotime($masa_kerja_praktek_1->$mhsId->content)) }}</u> s/d <u>{{ date('d/m/Y', strtotime($masa_kerja_praktek_2->$mhsId->content)) }}</u>
									</td>
									<td class="align-middle text-center">
										<a target="_blank" href="{{ route('main.file', ['filename' => $surat_keterangan_telah_selesai_kp->$mhsId->content]) }}" class="text-green">Periksa</a>
									</td>
									<td class="align-middle text-center">
										<a target="_blank" href="{{ route('main.file', ['filename' => $buku_laporan_kp->$mhsId->content]) }}" class="text-green">Periksa</a>
									</td>
									<td class="align-middle text-center">
										<a target="_blank" href="{{ route('main.file', ['filename' => $lembar_pengesahan_kp->$mhsId->content]) }}" class="text-green">Periksa</a>
									</td>
									<td class="align-middle text-center">
										@csrf
										<button type="submit" class="btn btn-sm btn-success">Terima</button>
									</td>
								</form>
								<td class="align-middle text-center">
									<form action="{{ route('main.kp.admin.usulan-pengisian-masa-kp.process', ['nim' => $mahasiswa->user->nomor_induk, 'opsi' => 'decline']) }}" method="post" style="display: inline;" enctype="multipart/form-data">
										@csrf
										<button type="submit" class="btn btn-sm btn-danger">Tolak</button>
									</form>
								</td>
							</tr>
							@endforeach

							@if ($isEmpty)
								<tr>
									<td class="align-middle text-center">--</td>
									<td class="align-middle text-left">--</td>
									<td class="align-middle text-center">--</td>
									<td class="align-middle text-center">--</td>
									<td class="align-middle text-center">--</td>
									<td class="align-middle text-center">--</td>
									<td class="align-middle text-center">--</td>
									<td class="align-middle text-center">--</td>
									<td class="align-middle text-center">--</td>
								</tr>
							@endif
					</tbody>
				</table>
			</div>
		</div>
	</div>
@endsection