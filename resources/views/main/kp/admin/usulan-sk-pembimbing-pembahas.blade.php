@extends('main.master')

@section('custom-script')
	<script>
		$("#usulan-sk-pembimbing-pembahas").dataTable();
	</script>
@endsection

@section('content')
	<div class="container">
		<div class="card">
			<div class="card-body" style="overflow-x: auto;">
				<table class="table table-bordered table-striped" id="usulan-sk-pembimbing-pembahas">
					<thead>
						<tr class="bg-green">
							<th scope="col" class="align-middle text-center">No</th>
							<th scope="col" class="align-middle text-left">Nama</th>
							<th scope="col" class="align-middle text-center">NIM</th>
							<th scope="col" class="align-middle text-center">Pembimbing</th>
							<th scope="col" class="align-middle text-center">Pembahas</th>
							<th scope="col" class="align-middle text-center">SK Penunjukan Pembimbing &amp; Pembahas</th>
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
								<form action="{{ route('main.kp.admin.usulan-sk-pembimbing-pembahas.process', ['nim' => $mahasiswa->user->nomor_induk]) }}" method="post" style="display: inline;" enctype="multipart/form-data">
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
										<input type="file" name="sk-pembimbing-pembahas" accept="application/pdf">
									</td>
									<td class="align-middle text-center">
										@csrf
										<button type="submit" class="btn btn-sm btn-success">Kirim ke Koor Prodi</button>
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