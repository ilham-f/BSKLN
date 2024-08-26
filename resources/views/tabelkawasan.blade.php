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
                    <h3 class="card-title">Tabel Kawasan</h3>
                    <button class="btn btn-info ml-auto d-flex align-items-center" data-toggle="modal" data-target="#tambah">
                        <i class="fas fa-plus mr-2"></i>
                        Tambah Kawasan
                    </button>
                </div>
                <div class="card-body">
                    @if ($kawasans->isNotEmpty())
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama Kawasan</th>
                                    <th>Direktorat</th>
                                    <th>Created_At</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kawasans as $kawasan)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $kawasan->nama_kawasan }}</td>
                                        <td>{{ $kawasan->direktorats->nama_direktorat }}</td>
                                        <td>{{ $kawasan->created_at }}</td>
                                        <td class="text-center">
                                            <button style="height: 50%;" class="btn btn-danger" data-toggle="modal"
                                                data-target="#delete{{ $kawasan->id }}"><i class="fas fa-trash"></i></button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <span>Anda belum memiliki kawasan</span>
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
                    <h5 class="modal-title" id="modalCenterTitle">Tambah Kawasan</h5>
                    <button type="button" class="btn btn-transparent" data-dismiss="modal" aria-label="Close"><i class="fa fa-times" aria-hidden="true"></i></button>
                </div>
                <div class="modal-body">
                    <form action="/tambahkawasan" method="post">
                        @csrf
                        <div class="mb-3">
                            <input type="text" name="nama_kawasan" class="form-control" placeholder="Nama Kawasan">
                        </div>
                        <div class="mb-3">
                            <span>Pilih Direktorat</span>
                            <select class="form-control" name="direktorat_id">
                                @foreach ($direktorats as $direktorat)
                                    <option value="{{ $direktorat->id }}">{{ $direktorat->nama_direktorat }}</option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" class="btn btn-info">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Delete --}}
    @foreach ($kawasans as $kawasan)
        <div class="modal fade" id="delete{{ $kawasan->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <h5>Apakah anda yakin untuk menghapus Kawasan {{ $kawasan->nama_kawasan }}?</h5>
                        <form action="/deletekawasan" method="post">
                            @csrf
                            <div class="mb-3">
                                <input type="hidden" name="id" value="{{ $kawasan->id }}">
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
