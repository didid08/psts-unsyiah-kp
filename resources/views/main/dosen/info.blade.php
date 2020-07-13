@extends('main.master')

@section('breadcumb')
	<li class="breadcrumb-item"><a href="/">{{ ucfirst($category) }}</a></li>
	<li class="breadcrumb-item active">{{ $subtitle }}</li>
@endsection

@section('custom-script')
	<script>
		$("#info-dosen").dataTable()
	</script>
@endsection

@section('content')
	<div class="container">
	    <div class="card height-auto">
	    	<div class="card-body" style="overflow-x: auto;">
	    		<style>
	    			#info-dosen {
	    				table-layout: auto;
	    				width: 200%;
	    			}
	    			#info-dosen th, #info-dosen td {
	    				text-align: center;
	    				vertical-align: middle;
	    			}
	    		</style>
	    		<table class="table table-bordered table-striped" id="info-dosen">
	    			<thead>
	    				<tr>
	    					<th scope="col">NO</th>
	    					<th scope="col">NAMA</th>
	    					<th scope="col">NIP</th>
	    					<th scope="col">BIDANG</th>
	    					<th scope="col">Bimbing</th>
	    					<th scope="col">Selesai Bimb</th>
	    					<th scope="col">Total Pemb.</th>
	    					<th scope="col">Pembahas</th>
	    					<th scope="col">Selesai Pembahas</th>
	    					<th scope="col">Total pembahas</th>
	    					<th scope="col">Dosen Wali</th>
	    				</tr>
	    			</thead>
	    			<tbody>
	    				@foreach ($semua_dosen as $index => $dosen)
							<tr>
								<td>{{ $index+1 }}</td>
								<td  style="text-align: left;">{{ $dosen->nama }}</td>
								<td>{{ $dosen->nomor_induk }}</td>
								<td>
									@if ($dosen->bidang != null)
										{{ $dosen->bidang->nama }}
									@else
										-
									@endif
								</td>
								<td>{{ $data['bimbingan']['total'][$dosen->nama] }}</td>
								<td>{{ $data['bimbingan']['selesai'][$dosen->nama] }}</td>
								<td>{{ $data['bimbingan']['total'][$dosen->nama] - $data['bimbingan']['selesai'][$dosen->nama] }}</td>
								<td>{{ $data['pembahas']['total'][$dosen->nama] }}</td>
								<td>{{ $data['pembahas']['selesai'][$dosen->nama] }}</td>
								<td>{{ $data['pembahas']['total'][$dosen->nama] - $data['pembahas']['selesai'][$dosen->nama] }}</td>
								<td>{{ $data['dosen_wali'][$dosen->nama] }}</td>
							</tr>
	    				@endforeach
	    			</tbody>
	    		</table>
	    	</div>
	    </div>
	</div>
@endsection