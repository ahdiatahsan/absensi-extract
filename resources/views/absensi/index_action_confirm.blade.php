<form action="{{ route('absensi.destroy', $absensi->id) }}" method="POST">
    @csrf
    @method('DELETE')

    <button type="submit" class="btn btn-sm btn-icon btn-icon-sm btn-elevate btn-elevate-air" title="Hapus"
        onclick="return confirm('Hapus data ini ?')">
        <i class="fa fa-trash text-danger"></i>
    </button>

    <a href="{{ route('absensi.edit', $absensi->id) }}"
        class="btn btn-sm btn-icon btn-icon-sm btn-elevate btn-elevate-air" title="Ubah">
        <i class="fa fa-edit text-warning"></i>
    </a>

</form>

<form action="{{ route('absensi_konfirmasi', $absensi->id) }}" method="POST">
    @csrf
    @method('PUT')

    <button type="submit" class="btn btn-sm btn-icon btn-icon-sm btn-elevate btn-elevate-air" title="Konfirmasi"
        onclick="return confirm('Konfirmasi absen pulang data ini ?')">
        <i class="fa fa-check text-success"></i>
    </button>
</form>

