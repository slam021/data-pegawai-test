<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Data Pegawai</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.3/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.bootstrap5.min.css">
</head>
<body style="background: rgb(219, 218, 218)">

    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <h4 class="text-center my-4 mt-2">Data Pegawai</h4>
                        <hr>
                        <a href="{{ route('pegawais.create') }}" class="btn btn-sm btn-success mb-3"><i class='fa fa-plus-circle'></i> TAMBAH</a>
                        <div class="table-responsive">
                            <table id="myTable" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                                <thead>
                                    <tr>
                                        <th class="text-center" scope="col">NO.</th>
                                        <th class="text-center" scope="col">FOTO</th>
                                        <th class="text-center" scope="col">NAMA</th>
                                        <th class="text-center" scope="col">JABATAN</th>
                                        <th class="text-center" scope="col">TANGGAL LAHIR</th>
                                        <th class="text-center" scope="col">KELAMIN</th>
                                        <th class="text-center" scope="col">ALAMAT</th>
                                        <th class="text-center" scope="col" style="width: 20%">AKSI</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data_pegawai as $pegawai)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}.</td>
                                            <td class="text-center">
                                                @if ($pegawai->foto == 'default.png' || $pegawai->foto == null)
                                                    <img src="{{ asset('default.png') }}" class="rounded" style="width: 150px">
                                                @else
                                                    <img src="{{ asset('storage/foto_pegawai/'.$pegawai->foto) }}" class="rounded" style="width: 150px">
                                                @endif
                                            </td>
                                            <td>{{ $pegawai->nama_lengkap }}</td>
                                            <td>{{ $pegawai->jabatan }}</td>
                                            <td>{{ date('m/d/Y', strtotime($pegawai->tanggal_lahir)) }}</td>
                                            <td class="text-center">
                                                @if ($pegawai->kelamin == 1)
                                                    <span class="badge text-bg-primary">Laki-laki</span>
                                                @elseif ($pegawai->kelamin == 2)
                                                    <span class="badge text-bg-secondary">Perempuan</span>
                                                @else
                                                    <span class="badge text-bg-warning">Tidak Diketahui</span>
                                                @endif
                                            </td>
                                            <td>{{ $pegawai->alamat }}</td>
                                            <td class="text-center">
                                                <form action="{{ route('pegawais.destroy', $pegawai->id) }}" method="POST">
                                                    <a href="{{ route('pegawais.show', $pegawai->id) }}" class="btn btn-sm btn-dark" title="SHOW"><i class='fa fa-eye'></i></a>
                                                    <a href="{{ route('pegawais.edit', $pegawai->id) }}" class="btn btn-sm btn-primary" title="EDIT"><i class='fa fa-edit'></i></a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" title="DELETE"><i class='fa fa-trash'></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.3/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.1/js/responsive.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#myTable').DataTable({
                scrollX: true,
                responsive: true
            });
        });

        //message with sweetalert
        @if(session('success'))
            Swal.fire({
                icon: "success",
                title: "BERHASIL",
                text: "{{ session('success') }}",
                showConfirmButton: false,
                timer: 2000
            });
        @elseif(session('error'))
            Swal.fire({
                icon: "error",
                title: "GAGAL!",
                text: "{{ session('error') }}",
                showConfirmButton: false,
                timer: 2000
            });
        @endif

        // Confirmation dialog with SweetAlert2
        $('form').on('submit', function(e) {
            e.preventDefault();
            var form = this;

            Swal.fire({
                title: 'Apakah Anda Yakin?',
                text: "Anda tidak akan dapat mengembalikan ini!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    </script>

</body>
</html>
