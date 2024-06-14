<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Detail Pegawai</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body style="background: lightgray">

    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <h4 class="text-center my-4 mt-2">Detail Pegawai</h4>
                        <hr>
                        <div class="form-group mb-3 text-center">
                            <img src="{{ asset('/storage/foto_pegawai/'.$pegawai->foto) }}" class="rounded" style="width: 150px">
                        </div>
                        <div class="form-group mb-3">
                            <label class="font-weight-bold">NAMA LENGKAP</label>
                            <input type="text" class="form-control" value="{{ $pegawai->nama_panggilan }}" disabled>
                        </div>
                        <div class="form-group mb-3">
                            <label class="font-weight-bold">NAMA PANGGILAN</label>
                            <input type="text" class="form-control" value="{{ $pegawai->nama_lengkap }}" disabled>
                        </div>
                        <div class="form-group mb-3">
                            <label class="font-weight-bold">JABATAN</label>
                            <input type="text" class="form-control" value="{{ $pegawai->jabatan }}" disabled>
                        </div>
                        <div class="form-group mb-3">
                            <label class="font-weight-bold">TANGGAL LAHIR</label>
                            <input type="text" class="form-control" value="{{ date('m/d/Y', strtotime($pegawai->tanggal_lahir)) }}" disabled>
                        </div>
                        <div class="form-group mb-3">
                            <label class="font-weight-bold">JENIS KELAMIN</label>
                            <input type="text" class="form-control" value="{{ $pegawai->kelamin == 1 ? 'Laki-laki' : 'Perempuan' }}" disabled>
                        </div>
                        <div class="form-group mb-3">
                            <label class="font-weight-bold">ALAMAT</label>
                            <textarea class="form-control" rows="5" disabled>{{ $pegawai->alamat }}</textarea>
                        </div>
                        <a href="{{ route('pegawais.index') }}" class="btn btn-sm btn-secondary float-end"><i class="fa fa-arrow-circle-left"></i> BACK</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
