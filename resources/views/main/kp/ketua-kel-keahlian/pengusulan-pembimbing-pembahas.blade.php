@extends('main.master')

@section('custom-script')
	<script>
		$("#usul-pembimbing").dataTable();
		$("#tetapkan-pembimbing").dataTable();
	</script>
@endsection

@section('content')
	<div class="container">
		<div class="card">
			<div class="card-body" style="overflow-x: auto;">
				<h5>Usul Pembimbing dan Pembahas</h5>
				<table class="table table-bordered table-striped" id="usul-pembimbing">
					<thead>
						<tr class="bg-green">
							<th class="align-middle text-center">No</th>
							<th class="align-middle text-left">Nama</th>
							<th class="align-middle text-center">NIM</th>
							<th class="align-middle text-center">Pembimbing</th>
							<th class="align-middle text-center">Pembahas</th>
							<th class="align-middle text-center">Judul KP</th>
							<th class="align-middle text-center">Opsi</th>
						</tr>
					</thead>
					<tbody>
						@php
							$isEmpty = true;
						@endphp
						@foreach ($semua_mahasiswa as $index => $mahasiswa)
							@php
								$mhsId = $mahasiswa->user_id;
							@endphp
							@if (!isset($daftar_pembimbing->$mhsId) | !isset($daftar_pembahas->$mhsId))
								@php
									$isEmpty = false;
								@endphp
								<tr>
									<form action="{{ route('usul.pembimbing-pembahas', ['nim' => $mahasiswa->user->nomor_induk]) }}" method="post">
										<td class="align-middle text-center">{{ $index+1 }}</td>
										<td class="align-middle text-left">{{ $mahasiswa->user->nama }}</td>
										<td class="align-middle text-center">{{ $mahasiswa->user->nomor_induk }}</td>
										<td class="align-middle text-center">
											@csrf
											<select name="pembimbing" id="" class="form-control">
												<option selected disabled>Pilih Pembimbing</option>
												@foreach ($semua_dosen as $dosen)
													<option value="{{ $dosen->nomor_induk }}">{{ $dosen->nama }}</option>
												@endforeach
											</select>
										</td>
										<td class="align-middle text-center">
											<select name="pembahas" id="" class="form-control">
												<option selected disabled>Pilih Pembahas</option>
												@foreach ($semua_dosen as $dosen)
													<option value="{{ $dosen->nomor_induk }}">{{ $dosen->nama }}</option>
												@endforeach
											</select>
										</td>
										<td class="align-middle text-center">
											<textarea class="form-control bg-light" readonly="readonly">{{ $judul_kp->$mhsId->content }}</textarea>
										</td>
										<td class="align-middle text-center">
											<button type="submit" class="btn btn-sm btn-success text-bold">Kirim ke email dosen</button>
											{{--<a href="#" class="btn btn-sm btn-danger mt-2">Tolak judul</a>--}}
										</td>
									</form>
								</tr>
							@endif
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
				<h5 class="mt-4">Yang baru disetujui Pembimbing dan Pembahas</h5>
				<table class="table table-bordered table-striped" id="tetapkan-pembimbing">
					<thead>
						<tr class="bg-green">
							<th class="align-middle text-center">No</th>
							<th class="align-middle text-left">Nama</th>
							<th class="align-middle text-center">NIM</th>
							<th class="align-middle text-center">Pembimbing</th>
							<th class="align-middle text-center">Pembahas</th>
							<th class="align-middle text-center">Judul KP</th>
							<th class="align-middle text-center">Opsi</th>
						</tr>
					</thead>
					<tbody>
						@php
							$isEmpty2 = true;
						@endphp
						@foreach ($semua_mahasiswa as $index => $mahasiswa)
							@php
								$mhsId2 = $mahasiswa->user_id;
							@endphp
							@if (isset($daftar_pembimbing->$mhsId) && isset($daftar_pembahas->$mhsId))
								@if ($daftar_pembimbing->$mhsId->verified == true && $daftar_pembahas->$mhsId->verified == true)
									@php
										$isEmpty2= false;
									@endphp
									<tr>
										<td class="align-middle text-center">{{ $index+1 }}</td>
										<td class="align-middle text-left">{{ $mahasiswa->user->nama }}</td>
										<td class="align-middle text-center">{{ $mahasiswa->user->nomor_induk }}</td>
										<td class="align-middle text-center">
											<input type="text" class="form-control bg-light" value="{{ $daftar_pembimbing->$mhsId2->content }}" readonly="readonly">
										</td>
										<td class="align-middle text-center">
											<input type="text" class="form-control bg-light" value="{{ $daftar_pembahas->$mhsId2->content }}" readonly="readonly">
										</td>
										<td class="align-middle text-center">
											<textarea class="form-control bg-light" readonly="readonly">{{ $judul_kp->$mhsId2->content }}</textarea>
										</td>
										<td class="align-middle text-center">
											<form action="{{ route('main.kp.ketua-kel-keahlian.pengusulan-pembimbing-pembahas.process', ['nim' => $mahasiswa->user->nomor_induk]) }}" method="post" style="display: inline;">
												@csrf
												<button type="submit" class="btn btn-sm btn-success">Kirim ke admin</button>
											</form>
										</td>
									</tr>
								@endif
							@endif
						@endforeach

						@if ($isEmpty2)
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