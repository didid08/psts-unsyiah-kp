@extends('main.master')

@section('custom-script')
	<script>
		$("#info-mahasiswa").dataTable();
	</script>
@endsection

@section('content')
	<div class="container">
		<div class="card">
			<div class="card-body" style="overflow-x: auto;">
				<table class="table table-bordered table-striped" id="info-mahasiswa">
					<thead>
						<tr class="bg-light">
							<th scope="col" class="align-middle text-center">No</th>
							<th scope="col" class="align-middle text-left">Nama</th>
							<th scope="col" class="align-middle text-center">NIM</th>
							<th scope="col" class="align-middle text-center">Pembimbing</th>
							<th scope="col" class="align-middle text-center">Pembahas</th>
						</tr>
					</thead>
					<tbody>
						@php
							$isEmpty = true;
						@endphp

						@foreach ($semua_mahasiswa as $index => $mahasiswa)
							@php
								$isEmpty = false;
							@endphp
							<tr>
								<td class="align-middle text-center">{{ $index+1 }}</td>
								<td class="align-middle text-left">{{ $mahasiswa->nama }}</td>
								<td class="align-middle text-center">{{ $mahasiswa->nomor_induk }}</td>
								<td class="align-middle text-center">
									{{ $mahasiswa->data->where('name', 'pembimbing')->where('verified', true)->count() > 0 ? $mahasiswa->data->where('name', 'pembimbing')->first()->content : '--' }}
								</td>
								<td class="align-middle text-center">
									{{ $mahasiswa->data->where('name', 'pembahas')->where('verified', true)->count() > 0 ? $mahasiswa->data->where('name', 'pembahas')->first()->content : '--' }}
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
								</tr>
							@endif
					</tbody>
				</table>
			</div>
		</div>
	</div>
@endsection