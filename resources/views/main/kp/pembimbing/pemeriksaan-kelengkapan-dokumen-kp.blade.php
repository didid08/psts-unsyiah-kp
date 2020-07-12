@extends('main.master')

@section('custom-script')
	<script>
		$("#pemeriksaan-kelengkapan-dokumen-kp").dataTable();
	</script>
@endsection

@section('content')
	<div class="container">
		<div class="card">
			<div class="card-body" style="overflow-x: auto;">
				<table class="table table-bordered table-striped" id="pemeriksaan-kelengkapan-dokumen-kp">
					<thead>
						<tr class="bg-green">
							<th scope="col" class="align-middle text-center">No</th>
							<th scope="col" class="align-middle text-left">Nama</th>
							<th scope="col" class="align-middle text-center">NIM</th>
							<th scope="col" class="align-middle text-center">Pembimbing dan Pembahas telah menerima Hardcopy SK Pembimbing / Pembahas, lembar pengesahan, buku laporan KP</th>
							<th scope="col" class="align-middle text-center">Pembimbing dan Pembahas telah menerima SK Pembimbing / Pembahas, lembar pengesahan, buku laporan KP</th>
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
								<form action="{{ route('main.kp.pembimbing.pemeriksaan-kelengkapan-dokumen-kp.process', ['nim' => $mahasiswa->user->nomor_induk]) }}" method="post" style="display: inline;">
									<td class="align-middle text-center">{{ $index+1 }}</td>
									<td class="align-middle text-left">{{ $mahasiswa->user->nama }}</td>
									<td class="align-middle text-center">{{ $mahasiswa->user->nomor_induk }}</td>
									<td class="align-middle text-center">
										<input type="radio" name="opsi1" id="ya1" value="ya"{{ isset($pemeriksaan_kelengkapan_dokumen_kp_1->$mhsId) ? ($pemeriksaan_kelengkapan_dokumen_kp_1->$mhsId->content == 'ya' ? ' checked' : '') : '' }}> <label for="ya1" class="mr-2"><i class="fa fa-check text-green"></i></label>
										<input type="radio" name="opsi1" id="tidak1" value="tidak"{{ isset($pemeriksaan_kelengkapan_dokumen_kp_1->$mhsId) ? ($pemeriksaan_kelengkapan_dokumen_kp_1->$mhsId->content == 'tidak' ? ' checked' : '') : '' }}> <label for="tidak1" class="mr-2"><i class="fa fa-times text-red"></i></label>
									</td>
									<td class="align-middle text-center">
										<input type="radio" name="opsi2" id="ya2" value="ya"{{ isset($pemeriksaan_kelengkapan_dokumen_kp_2->$mhsId) ? ($pemeriksaan_kelengkapan_dokumen_kp_2->$mhsId->content == 'ya' ? ' checked' : '') : '' }}> <label for="ya2" class="mr-2"><i class="fa fa-check text-green"></i></label>
										<input type="radio" name="opsi2" id="tidak2" value="tidak"{{ isset($pemeriksaan_kelengkapan_dokumen_kp_2->$mhsId) ? ($pemeriksaan_kelengkapan_dokumen_kp_2->$mhsId->content == 'tidak' ? ' checked' : '') : '' }}> <label for="tidak2" class="mr-2"><i class="fa fa-times text-red"></i></label>
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