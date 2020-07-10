@extends('main.master')

@section('custom-script')
	<script>
		$("#penetapan-sk-pembimbing-pembahas").dataTable();
	</script>
@endsection

@section('content')
	<div class="container">
		<div class="card">
			<div class="card-body" style="overflow-x: auto;">
				<table class="table table-bordered table-striped" id="penetapan-sk-pembimbing-pembahas">
					<thead>
						<tr class="bg-green">
							<th scope="col" class="align-middle text-center">No</th>
							<th scope="col" class="align-middle text-left">Nama</th>
							<th scope="col" class="align-middle text-center">NIM</th>
							<th scope="col" class="align-middle text-center">Pembimbing</th>
							<th scope="col" class="align-middle text-center">Pembahas</th>
							<th scope="col" class="align-middle text-center">SK Penunjukan Pembimbing &amp; Pembahas</th>
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
								<form action="{{ route('main.kp.koor-prodi.penetapan-sk-pembimbing-pembahas.process', ['nim' => $mahasiswa->user->nomor_induk, 'opsi' => 'accept']) }}" method="post" style="display: inline;">
									<td class="align-middle text-center">{{ $index+1 }}</td>
									<td class="align-middle text-left">{{ $mahasiswa->user->nama }}</td>
									<td class="align-middle text-center">{{ $mahasiswa->user->nomor_induk }}</td>
									<td class="align-middle text-center">
										<input type="text" class="form-control bg-light" value="{{ $pembimbing->$mhsId->content }}" readonly="readonly">
									</td>
									<td class="align-middle text-center">
										<input type="text" class="form-control bg-light" value="{{ $pembahas->$mhsId->content }}" readonly="readonly">
									</td>
									<td class="align-middle text-center">
										
										<a target="_blank" href="{{ route('main.file', ['filename' => $sk_pembimbing_pembahas->$mhsId->content]) }}" class="text-green">Periksa</a>
									</td>
									<td class="align-middle text-center">
										@csrf
										<button type="submit" class="btn btn-sm btn-success">Tetapkan</button>
									</td>
								</form>
								<form action="{{ route('main.kp.koor-prodi.penetapan-sk-pembimbing-pembahas.process', ['nim' => $mahasiswa->user->nomor_induk, 'opsi' => 'decline']) }}" method="post" style="display: inline;">
									<td class="align-middle text-center">
										@csrf
										<button type="submit" class="btn btn-sm btn-danger">Tolak</button>
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
								</tr>
							@endif
					</tbody>
				</table>
			</div>
		</div>
	</div>
@endsection