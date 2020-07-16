@extends('main.master')

@section('custom-script')
	<script>
		$("#usulan-surat-ke-proyek").dataTable();
	</script>
@endsection

@section('content')
	<div class="container">
		<div class="card">
			<div class="card-body" style="overflow-x: auto;">
				<table class="table table-bordered table-striped" id="usulan-surat-ke-proyek">
					<thead>
						<tr class="bg-green">
							<th scope="col" class="align-middle text-center">No</th>
							<th scope="col" class="align-middle text-left">Nama</th>
							<th scope="col" class="align-middle text-center">NIM</th>
							<th scope="col" class="align-middle text-center">Surat Ke Proyek</th>
							<th scope="col" class="align-middle text-center">Sudah Dto Koor Prodi</th>
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
								<form action="{{ route('main.kp.admin.usulan-surat-ke-proyek.process', ['nim' => $mahasiswa->user->nomor_induk]) }}" method="post" style="display: inline;" enctype="multipart/form-data">
									<td class="align-middle text-center">{{ $index+1 }}</td>
									<td class="align-middle text-left">{{ $mahasiswa->user->nama }}</td>
									<td class="align-middle text-center">{{ $mahasiswa->user->nomor_induk }}</td>
									<td class="align-middle text-center">
										<a target="_blank" class="btn btn-sm btn-outline-secondary" href="{{ route('main.kp.admin.cetak.surat-ke-proyek', ['nim' => $mahasiswa->user->nomor_induk]) }}"><i class="fa fa-download mr-2"></i>Unduh</a>
									</td>
									<td class="align-middle text-center">
										@csrf
										<button type="submit" class="btn btn-sm btn-success">Ya</button>
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
								</tr>
							@endif
					</tbody>
				</table>
			</div>
		</div>
	</div>
@endsection