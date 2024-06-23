<!-- resources/views/pegawai/create.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Pegawai</title>
    <!-- Tambahkan CSS Bootstrap atau custom CSS sesuai kebutuhan -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/create.css') }}">
</head>
<body>
    <div class="container">
        <h2 class="mt-4">Tambah Data Pegawai</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('pegawai.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="foto_pegawai">Foto Pegawai</label>
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="foto_pegawai" name="foto_pegawai" onchange="previewImage(event)">
                    <label class="custom-file-label" for="foto_pegawai">Choose file</label>
                </div>
                <img id="img-preview" src="" alt="Foto Pegawai" class="img-thumbnail img-preview mt-2">
            </div>

            <div class="form-group">
                <label for="nip">NIP</label>
                <input type="text" class="form-control" id="nip" name="nip" value="{{ old('nip') }}" required>
            </div>

            <div class="form-group">
                <label for="nama_depan">Nama Depan</label>
                <input type="text" class="form-control" id="nama_depan" name="nama_depan" value="{{ old('nama_depan') }}" required>
            </div>

            <div class="form-group">
                <label for="nama_belakang">Nama Belakang</label>
                <input type="text" class="form-control" id="nama_belakang" name="nama_belakang" value="{{ old('nama_belakang') }}" required>
            </div>

            <div class="form-group">
                <label for="tanggal_lahir">Tanggal Lahir</label>
                <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}">
            </div>

            <div class="form-group">
                <label for="tanggal_masuk">Tanggal Masuk</label>
                <input type="date" class="form-control" id="tanggal_masuk" name="tanggal_masuk" value="{{ old('tanggal_masuk') }}" required>
            </div>

            <div class="form-group">
                <label for="jenis_kelamin">Jenis Kelamin</label>
                <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
                    <option value="Laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
            </div>

            <div class="form-group">
                <label for="alamat">Alamat</label>
                <input type="text" class="form-control" id="alamat" name="alamat" value="{{ old('alamat') }}">
            </div>

            <div class="form-group">
                <label for="kota">Kota</label>
                <input type="text" class="form-control" id="kota" name="kota" value="{{ old('kota') }}">
            </div>

            <div class="form-group">
                <label for="provinsi">Provinsi</label>
                <input type="text" class="form-control" id="provinsi" name="provinsi" value="{{ old('provinsi') }}">
            </div>

            <div class="form-group">
                <label for="kode_pos">Kode Pos</label>
                <input type="text" class="form-control" id="kode_pos" name="kode_pos" value="{{ old('kode_pos') }}">
            </div>

            <div class="form-group">
                <label for="nomor_telepon">Nomor Telepon</label>
                <input type="text" class="form-control" id="nomor_telepon" name="nomor_telepon" value="{{ old('nomor_telepon') }}">
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
            </div>

            <div class="form-group">
                <label for="id_departemen">Departemen</label>
                <select class="form-control" id="id_departemen" name="id_departemen">
                    @foreach ($departemens as $departemen)
                        <option value="{{ $departemen->id_departemen }}">{{ $departemen->nama_departemen }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="id_jabatan">Jabatan</label>
                <select class="form-control" id="id_jabatan" name="id_jabatan">
                    @foreach ($jabatans as $jabatan)
                        <option value="{{ $jabatan->id_jabatan }}">{{ $jabatan->nama_jabatan }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="{{ asset('js/create.js') }}"></script>
</body>
</html>
