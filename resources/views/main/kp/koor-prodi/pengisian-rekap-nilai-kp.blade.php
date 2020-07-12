@extends('main.master')

@section('custom-script')
	<script>
		$("#pengisian-rekap-nilai-kp").dataTable();
	</script>
@endsection

@section('content')
	<div class="container">
		<div class="card">
			<div class="card-body" style="overflow-x: auto;">
				<table class="table table-bordered table-striped" id="pengisian-rekap-nilai-kp">
					<thead>
						<tr class="bg-green">
							<th scope="col" class="align-middle text-center">No</th>
							<th scope="col" class="align-middle text-left">Nama</th>
							<th scope="col" class="align-middle text-center">NIM</th>
							<th scope="col" class="align-middle text-center">Nilai Pembimbing</th>
							<th scope="col" class="align-middle text-center">Nilai Pembahas</th>
							<th scope="col" class="align-middle text-center">Rekap Nilai KP</th>
							<th scope="col" class="align-middle text-center">Laporan KP</th>
							<th scope="col" class="align-middle text-center">Lembar Pengesahan KP</th>
							<th scope="col" class="align-middle text-center">Opsi</th>
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
								<form action="{{ route('main.kp.koor-prodi.pengisian-rekap-nilai-kp.process', ['nim' => $mahasiswa->user->nomor_induk]) }}" method="post" style="display: inline;">
									<td class="align-middle text-center">{{ $index+1 }}</td>
									<td class="align-middle text-left">{{ $mahasiswa->user->nama }}</td>
									<td class="align-middle text-center">{{ $mahasiswa->user->nomor_induk }}</td>
									<td class="align-middle text-center">
										<a target="_blank" href="{{ route('main.kp.cetak-nilai-kp-pembimbing', ['nim' => $mahasiswa->user->nomor_induk]) }}" class="btn btn-sm btn-outline-success">Lihat</a>
									</td>
									<td class="align-middle text-center">
										<a target="_blank" href="{{ route('main.kp.cetak-nilai-kp-pembahas', ['nim' => $mahasiswa->user->nomor_induk]) }}" class="btn btn-sm btn-outline-success">Lihat</a>
									</td>
									<td class="align-middle text-center">
										Diisi otomatis (<a href="{{ route('main.kp.cetak-rekap-nilai-kp', ['nim' => $mahasiswa->user->nomor_induk]) }}" class="text-green">Lihat</a>)
									</td>
									<td class="align-middle text-center">
										<a target="_blank" href="{{ route('main.file', ['filename' => $buku_laporan_kp->$mhsId->content]) }}" class="btn btn-sm btn-outline-success">Lihat</a>
									</td>
									<td class="align-middle text-center">
										<a target="_blank" href="{{ route('main.file', ['filename' => $lembar_pengesahan_kp->$mhsId->content]) }}" class="btn btn-sm btn-outline-success">Lihat</a>
									</td>
									<td class="align-middle text-center">
										@csrf
										<button type="submit" class="btn btn-sm btn-success text-bold">Tetapkan</button>
									</td>
								</form>
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