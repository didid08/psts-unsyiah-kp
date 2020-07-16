@if ($disposisi->progress == 4)
	<form action="{{ route('main.kp.mahasiswa.upload-disposisi', ['progress' => 4]) }}" method="post" style="display: inline;" enctype="multipart/form-data">
@endif
<table width="100%" class="table table-bordered{{ formBackground(4, 5, $disposisi) }}">
	<tbody>
		<tr>
			<td colspan="2" class="align-middle"><b>Penentuan Proyek KP / Tempat KP</b></td>
		</tr>
		<tr>
			<td class="align-middle">Nama Direktur Perusahaan</td>
			<td class="text-center align-middle">
				@if ($disposisi->progress == 4)
					<input type="text" name="nama-direktur-perusahaan" class="form-control">
				@elseif (in_array($disposisi->progress, range(5,5)))
					<span class="text-warning">sedang diproses</span>
				@elseif ($disposisi->progress > 5)
					<i class="fa fa-check-circle text-green"></i><span class="ml-3">Ada</span>
				@else
					--
				@endif
			</td>
		</tr>
		<tr>
			<td class="align-middle">Nama Bapak/Ibu Pada Tujuan Surat</td>
			<td class="text-center align-middle">
				@if ($disposisi->progress == 4)
					<input type="text" name="nama-bapak-ibu-pada-tujuan-surat" class="form-control">
				@elseif (in_array($disposisi->progress, range(5,5)))
					<span class="text-warning">sedang diproses</span>
				@elseif ($disposisi->progress > 5)
					<i class="fa fa-check-circle text-green"></i><span class="ml-3">Ada</span>
				@else
					--
				@endif
			</td>
		</tr>
		<tr>
			<td class="align-middle">Alamat Proyek</td>
			<td class="text-center align-middle">
				@if ($disposisi->progress == 4)
					<input type="text" name="alamat-proyek" class="form-control">
				@elseif (in_array($disposisi->progress, range(5,5)))
					<span class="text-warning">sedang diproses</span>
				@elseif ($disposisi->progress > 5)
					<i class="fa fa-check-circle text-green"></i><span class="ml-3">Ada</span>
				@else
					--
				@endif
			</td>
		</tr>
		<tr>
			<td class="align-middle">Nama Proyek</td>
			<td class="text-center align-middle">
				@if ($disposisi->progress == 4)
					<input type="text" name="nama-proyek" class="form-control">
				@elseif (in_array($disposisi->progress, range(5,5)))
					<span class="text-warning">sedang diproses</span>
				@elseif ($disposisi->progress > 5)
					<i class="fa fa-check-circle text-green"></i><span class="ml-3">Ada</span>
				@else
					--
				@endif
			</td>
		</tr>
		<tr>
			<td class="align-middle">KP Selama</td>
			<td class="text-center align-middle">
				@if ($disposisi->progress == 4)
					<input type="text" name="kp-selama" class="form-control">
				@elseif (in_array($disposisi->progress, range(5,5)))
					<span class="text-warning">sedang diproses</span>
				@elseif ($disposisi->progress > 5)
					<i class="fa fa-check-circle text-green"></i><span class="ml-3">Ada</span>
				@else
					--
				@endif
			</td>
		</tr>
		@if ($disposisi->progress == 4)
			<tr>
				<td colspan="2" class="text-center align-middle">
					@csrf
					<button type="submit" class="btn btn-block btn-success">Kirim</button>
				</td>
			</tr>
		@elseif ($disposisi->progress < 4)
			<tr>
				<td colspan="2" class="text-center align-middle">
					<button class="btn btn-block btn-secondary disabled">Kirim</button>
				</td>
			</tr>
		@endif
	</tbody>
</table>
@if ($disposisi->progress == 4)
	</form>
@endif