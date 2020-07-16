@extends('main.master')

@section('custom-script')
	<script>
		$("#usulan-surat-permohonan-ke-proyek").dataTable();
	</script>
@endsection

@section('content')
	<div class="container">
		<div class="card">
			<div class="card-body" style="overflow-x: auto;">
				<table class="table table-bordered table-striped" id="usulan-surat-permohonan-ke-proyek">
					<thead>
						<tr class="bg-green">
							<th scope="col" class="align-middle text-center">No</th>
							<th scope="col" class="align-middle text-left">Nama</th>
							<th scope="col" class="align-middle text-center">NIM</th>
							<th scope="col" class="align-middle text-center">Surat Permohonan Ke Proyek</th>
							<th scope="col" class="align-middle text-center">Status Penerimaan Di Proyek</th>
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
								<form action="{{ route('main.kp.admin.usulan-surat-permohonan-ke-proyek.process', ['nim' => $mahasiswa->user->nomor_induk]) }}" method="post" style="display: inline;" enctype="multipart/form-data">
									<td class="align-middle text-center">{{ $index+1 }}</td>
									<td class="align-middle text-left">{{ $mahasiswa->user->nama }}</td>
									<td class="align-middle text-center">{{ $mahasiswa->user->nomor_induk }}</td>
									<td class="align-middle text-center">
										<a target="_blank" class="btn btn-sm btn-outline-secondary" href="{{ route('main.kp.admin.cetak.surat-permohonan-ke-proyek', ['nim' => $mahasiswa->user->nomor_induk]) }}"><i class="fa fa-download mr-2"></i>Unduh</a>
									</td>
									<td class="align-middle text-center">
										<input type="radio" name="status" id="status-1" value="diterima"><label for="status-1" class="text-success ml-2 mr-3">Diterima</label>
										<input type="radio" name="status" id="status-2" value="ditolak"><label for="status-2" class="text-danger ml-2 mr-3">Ditolak</label>
									</td>
									<td class="align-middle text-center">
										@csrf
										<button type="submit" class="btn btn-sm btn-success">Simpan</button>
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
								</tr>
							@endif
					</tbody>
				</table>
			</div>
		</div>
	</div>
@endsection