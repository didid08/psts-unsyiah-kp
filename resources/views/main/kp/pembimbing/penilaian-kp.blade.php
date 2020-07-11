@extends('main.master')

@section('custom-script')
	<script>
		$("#penilaian-kp").dataTable();
	</script>
@endsection

@section('content')
	<div class="container">
		<div class="card">
			<div class="card-body" style="overflow-x: auto;">
				<table class="table table-bordered table-striped" id="penilaian-kp">
					<thead>
						<tr class="bg-green">
							<th scope="col" class="align-middle text-center">No</th>
							<th scope="col" class="align-middle text-left">Nama</th>
							<th scope="col" class="align-middle text-center">NIM</th>
							<th scope="col" class="align-middle text-center">Laporan KP</th>
							<th scope="col" class="align-middle text-center">Nilai KP</th>
							<th scope="col" class="align-middle text-center">Catatan KP</th>
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
								<form action="{{ route('main.kp.pembimbing.penilaian-kp.process', ['nim' => $mahasiswa->user->nomor_induk]) }}" method="post" style="display: inline;">
									<td class="align-middle text-center">{{ $index+1 }}</td>
									<td class="align-middle text-left">{{ $mahasiswa->user->nama }}</td>
									<td class="align-middle text-center">{{ $mahasiswa->user->nomor_induk }}</td>
									<td class="align-middle text-center">
										<a target="_blank" href="{{ route('main.file', ['filename' => $buku_laporan_kp->$mhsId->content]) }}" class="text-green">Lihat</a>
									</td>
									<td class="align-middle text-center">
										@if (isset($nilai_materi_pembimbing->$mhsId))
											Sudah terisi (<a href="{{ route('main.kp.pembimbing.isi-nilai-kp', ['nim' => $mahasiswa->user->nomor_induk]) }}" class="text-green">Edit</a>)
										@else
											<a href="{{ route('main.kp.pembimbing.isi-nilai-kp', ['nim' => $mahasiswa->user->nomor_induk]) }}" class="btn btn-outline-success"><i class="fa fa-edit mr-2"></i>Isi</a>
										@endif
									</td>
									<td class="align-middle text-center">
										<textarea name="catatan-kp" class="form-control" placeholder="Masukkan Catatan KP (opsional)"></textarea>
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
								</tr>
							@endif
					</tbody>
				</table>
			</div>
		</div>
	</div>
@endsection