@extends('main.master')

@section('custom-script')
	<script>
		$("#info-rekap-nilai-kp").dataTable();
	</script>
@endsection

@section('content')
	<div class="container">
		<div class="card">
			<div class="card-body" style="overflow-x: auto;">
				<a href="{{ route('main.kp.admin.info-rekap-nilai-kp', ['opsi' => 'cetak']) }}" target="_blank" class="btn btn-info mb-4"><i class="fa fa-download mr-2"></i>Unduh</a>
				<table class="table table-bordered table-striped" id="info-rekap-nilai-kp">
					<thead>
						<tr class="bg-light">
							<th scope="col" class="align-middle text-center">No</th>
							<th scope="col" class="align-middle text-left">Nama</th>
							<th scope="col" class="align-middle text-center">NIM</th>
							<th scope="col" class="align-middle text-center">Nilai KP</th>
							<th scope="col" class="align-middle text-center">Pembimbing</th>
							<th scope="col" class="align-middle text-center">Pembahas</th>
							<th scope="col" class="align-middle text-center">Berkas</th>
						</tr>
					</thead>
					<tbody>
						@php
							$isEmpty = true;
						@endphp

						@foreach ($semua_mahasiswa as $index => $mahasiswa)
							@php
								$isEmpty = false;

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
								<td class="align-middle text-center">{{ $index+1 }}</td>
								<td class="align-middle text-left">{{ $mahasiswa->user->nama }}</td>
								<td class="align-middle text-center">{{ $mahasiswa->user->nomor_induk }}</td>
								<td class="align-middle text-center">
									{{ $nilai_kp }}
								</td>
								<td class="align-middle text-center">
									{{ $mahasiswa->user->data->where('name', 'pembimbing')->first()->content }}
								</td>
								<td class="align-middle text-center">
									{{ $mahasiswa->user->data->where('name', 'pembahas')->first()->content }}
								</td>
								<td class="align-middle text-center">
									<a class="btn btn-sm btn-light" target="_blank" href="{{ route('main.kp.cetak-rekap-nilai-kp', ['nim' => $mahasiswa->user->nomor_induk]) }}">Unduh</a>
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
								</tr>
							@endif
					</tbody>
				</table>
			</div>
		</div>
	</div>
@endsection