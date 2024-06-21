<!DOCTYPE html>
<html>
<head>
    <title>Edit Pegawai</title>
    <!-- Tambahkan CSS Bootstrap atau custom CSS sesuai kebutuhan -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2 class="mt-4">Edit Data Pegawai</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('pegawais.update', $pegawai->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="nama_depan">Nama Depan</label>
                <input type="text" class="form-control" id="nama_depan" name="nama_depan" value="{{ $pegawai->nama_depan }}" required>
            </div>

            <div class="form-group">
                <label for="nama_belakang">Nama Belakang</label>
                <input type="text" class="form-control" id="nama_belakang" name="nama_belakang" value="{{ $pegawai->nama_belakang }}" required>
            </div>

            <div class="form-group">
                <label for="tanggal_lahir">Tanggal Lahir</label>
                <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="{{ $pegawai->tanggal_lahir }}">
            </div>

            <div class="form-group">
                <label for="tanggal_masuk">Tanggal Masuk</label>
                <input type="date" class="form-control" id="tanggal_masuk" name="tanggal_masuk" value="{{ $pegawai->tanggal_masuk }}" required>
            </div>

            <div class="form-group">
                <label for="jenis_kelamin">Jenis Kelamin</label>
                <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
                    <option value="Laki" {{ $pegawai->jenis_kelamin == 'Laki' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="Perempuan" {{ $pegawai->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                </select>
            </div>

            <div class="form-group">
                <label for="alamat">Alamat</label>
                <input type="text" class="form-control" id="alamat" name="alamat" value="{{ $pegawai->alamat }}">
            </div>

            <div class="form-group">
                <label for="kota">Kota</label>
                <input type="text" class="form-control" id="kota" name="kota" value="{{ $pegawai->kota }}">
            </div>

            <div class="form-group">
                <label for="provinsi">Provinsi</label>
                <input type="text" class="form-control" id="provinsi" name="provinsi" value="{{ $pegawai->provinsi }}">
            </div>

            <div class="form-group">
                <label for="kode_pos">Kode Pos</label>
                <input type="text" class="form-control" id="kode_pos" name="kode_pos" value="{{ $pegawai->kode_pos }}">
            </div>

            <div class="form-group">
                <label for="nomor_telepon">Nomor Telepon</label>
                <input type="text" class="form-control" id="nomor_telepon" name="nomor_telepon" value="{{ $pegawai->nomor_telepon }}">
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ $pegawai->email }}" required>
            </div>

            <div class="form-group">
                <label for="id_departemen">Departemen</label>
                <select class="form-control" id="id_departemen" name="id_departemen">
                    @foreach ($departemens as $departemen)
                        <option value="{{ $departemen->id_departemen }}" {{ $pegawai->id_departemen == $departemen->id_departemen ? 'selected' : '' }}>
                            {{ $departemen->nama_departemen }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="id_jabatan">Jabatan</label>
                <select class="form-control" id="id_jabatan" name="id_jabatan">
                    @foreach ($jabatans as $jabatan)
                        <option value="{{ $jabatan->id_jabatan }}" {{ $pegawai->id_jabatan == $jabatan->id_jabatan ? 'selected' : '' }}>
                            {{ $jabatan->nama_jabatan }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</body>
</html>
