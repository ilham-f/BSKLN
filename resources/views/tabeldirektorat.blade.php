@extends('layouts.main')

@section('content')
    <section class="content pt-4">
        <div class="container-fluid">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @elseif (session('failed'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    {{ session('failed') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <div class="card">
                <div class="card-header d-flex align-items-center">
                    <h3 class="card-title">Tabel Direktorat</h3>
                    <button class="btn btn-info ml-auto d-flex align-items-center" data-toggle="modal" data-target="#tambah">
                        <i class="fas fa-plus mr-2"></i>
                        Tambah Direktorat
                    </button>
                </div>
                <div class="card-body">
                    @if ($direktorats->isNotEmpty())
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama Direktorat</th>
                                    <th>Created_At</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($direktorats as $direktorat)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $direktorat->nama_direktorat }}</td>
                                        <td>{{ $direktorat->created_at }}</td>
                                        <td class="text-center">
                                            <button style="height: 50%;" class="btn btn-danger" data-toggle="modal"
                                                data-target="#delete{{ $direktorat->id }}"><i class="fas fa-trash"></i></button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <span>Anda belum memiliki direktorat</span>
                    @endif
                </div>
            </div>
        </div>
    </section>

    {{-- Modal Tambah --}}
    <div class="modal fade" id="tambah" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCenterTitle">Tambah Direktorat</h5>
                    <button type="button" class="btn btn-transparent" data-dismiss="modal" aria-label="Close"><i class="fa fa-times" aria-hidden="true"></i></button>
                </div>
                <div class="modal-body">
                    <form action="/tambahdirektorat" method="post">
                        @csrf
                        <div class="mb-3">
                            <input type="text" name="nama_direktorat" class="form-control" placeholder="Nama Direktorat">
                        </div>
                        <div class="mb-3">
                            <span>Pilih warna</span>
                            <input type="color" name="warna" class="form-control">
                        </div>

                        <button type="submit" class="btn btn-info">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Delete --}}
    @foreach ($direktorats as $direktorat)
        <div class="modal fade" id="delete{{ $direktorat->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <h5>Apakah anda yakin untuk menghapus Direktorat {{ $direktorat->nama_direktorat }}?</h5>
                        <form action="/deletedirektorat" method="post">
                            @csrf
                            <div class="mb-3">
                                <input type="hidden" name="id" value="{{ $direktorat->id }}">
                            </div>

                            <div class="mt-4 d-flex justify-content-end">
                                <button class="btn btn-secondary mr-3" type="button" data-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-danger">Hapus</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <!-- DataTables Script -->
    <script>
        $(document).ready(function () {
          $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
          }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        });
    </script>
@endsection
