<table width="100%" class="table table-bordered{{ formBackground(20, 22, $disposisi) }}">
	<tbody>
		<tr>
			<td class="align-middle text-center">1.</td>
			<td class="align-middle">Kelengkapan dokumen administrasi (Dokumen: PSTS 2)</td>
			<td class="align-middle text-center">
				@if ($disposisi->progress == 20)
					Belum diunggah
				@elseif (in_array($disposisi->progress, range(21,22)))
					<span class="text-warning">sedang diperiksa</span>
				@elseif ($disposisi->progress > 22)
					<i class="fa fa-check-circle text-green"></i><span class="ml-3">Ada</span>
				@else
					Belum diunggah
				@endif
			</td>
		</tr>
		<tr>
			<td class="align-middle text-center">2.</td>
			<td colspan="2" class="align-middle">Softcopy dokumen administrasi dikirim ke</td>
		</tr>
		<tr>
			<td></td>
			<td colspan="2" class="align-middle">
				Nama file : NIM_KP.zip
			</td>
		</tr>
		<tr>
			<td></td>
			<td colspan="2" class="align-middle">
				Email Administrasi : jtspsts{!! '@' !!}gmail.com
			</td>
		</tr>
	</tbody>
</table>