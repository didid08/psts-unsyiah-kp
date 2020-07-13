@extends('main.master')

@section('breadcumb')
	<li class="breadcrumb-item"><a href="/">{{ ucfirst($category) }}</a></li>
	<li class="breadcrumb-item active">{{ $subtitle }}</li>
@endsection

@section('custom-script')
	<script>
		$("#rekap-dosen").dataTable()
	</script>
@endsection

@section('content')
	<div class="container">
	    <div class="card height-auto">
	    	<div class="card-body" style="overflow-x: auto;">
	    		<style>
	    			#rekap-dosen {
	    				table-layout: auto;
	    				width: 200%;
	    			}
	    			#rekap-dosen th, #rekap-dosen td {
	    				text-align: center;
	    				vertical-align: middle;
	    			}
	    		</style>
	    		<table class="table table-bordered table-striped" id="rekap-dosen">
	    			<thead>
	    				<tr>
	    					<th scope="col">No.</th>
	    					<th scope="col">Dosen</th>
	    					<th scope="col">NIP</th>
	    					<th scope="col">NIM</th>
	    					<th scope="col">Pembimbing</th>
	    					<th scope="col">Pembahas</th>
	    					<th scope="col">Periode</th>
	    				</tr>
	    			</thead>
	    			<tbody>
	    				@foreach ($semua_dosen as $index => $dosen)
							<tr>
								<td>{{ $index+1 }}</td>
								<td style="text-align: left;">{{ $dosen->nama }}</td>
								<td>{{ $dosen->nomor_induk }}</td>
								<td>-</td>
								<td>0</td>
								<td>0</td>
								<td>0</td>
							</tr>
	    				@endforeach
	    			</tbody>
	    		</table>
	    	</div>
	    </div>
	</div>
@endsection