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
                    <h3 class="card-title">Tabel Negara</h3>
                    <button class="btn btn-info ml-auto d-flex align-items-center" data-toggle="modal" data-target="#tambah">
                        <i class="fas fa-plus mr-2"></i>
                        Tambah Negara
                    </button>
                </div>
                <div class="card-body">
                    @if ($negaras->isNotEmpty())
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama Negara</th>
                                    <th>Kawasan</th>
                                    <th>Direktorat</th>
                                    <th>Created_At</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($negaras as $negara)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $negara->nama_negara }}</td>
                                        <td>{{ $negara->kawasans->nama_kawasan }}</td>
                                        <td>{{ $negara->direktorats->nama_direktorat }}</td>
                                        <td>{{ $negara->kawasans->created_at }}</td>
                                        <td class="text-center">
                                            <button style="height: 50%;" class="btn btn-danger" data-toggle="modal"
                                                data-target="#delete{{ $negara->id }}"><i class="fas fa-trash"></i></button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <span>Anda belum memiliki negara</span>
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
                    <h5 class="modal-title" id="modalCenterTitle">Tambah Negara</h5>
                    <button type="button" class="btn btn-transparent" data-dismiss="modal" aria-label="Close"><i class="fa fa-times" aria-hidden="true"></i></button>
                </div>
                <div class="modal-body">
                    <form action="/tambahnegara" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <input type="text" name="nama_negara" class="form-control" placeholder="Nama Negara">
                        </div>
                        <div class="mb-3">
                            <input type="text" name="kode_negara" class="form-control" placeholder="Kode Negara">
                        </div>
                        <div class="mb-3">
                            <span>Pilih Direktorat</span>
                            <select class="form-control" name="direktorat_id" id="direktorat">
                                <option value="">Pilih Direktorat</option>
                                @foreach ($direktorats as $direktorat)
                                    <option value="{{ $direktorat->id }}">{{ $direktorat->nama_direktorat }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <span>Pilih Kawasan</span>
                            <select class="form-control" name="kawasan_id" id="kawasan">
                                <option value="">Pilih Kawasan</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <span>Pilih Bendera</span>
                            <input type="file" name="flag" class="form-control-file" >
                        </div>

                        <button type="submit" class="btn btn-info">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Delete --}}
    @foreach ($negaras as $negara)
        <div class="modal fade" id="delete{{ $negara->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <h5>Apakah anda yakin untuk menghapus Negara {{ $negara->nama_negara }}?</h5>
                        <form action="/deletenegara" method="post">
                            @csrf
                            <div class="mb-3">
                                <input type="hidden" name="id" value="{{ $negara->id }}">
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

    <script>
        $(document).ready(function(){
            $('#direktorat').change(function(){
                var direktorat_id = $(this).val();

                if(direktorat_id) {
                    $.ajax({
                        url: '/get-kawasan/' + direktorat_id,
                        type: "GET",
                        dataType: "json",
                        success:function(data) {
                            $('#kawasan').empty();
                            $('#kawasan').append('<option value="">Pilih Kawasan</option>');
                            $.each(data, function(key, value) {
                                $('#kawasan').append('<option value="'+ key +'">'+ value +'</option>');
                            });
                        }
                    });
                } else {
                    $('#kawasan').empty();
                    $('#kawasan').append('<option value="">Pilih Kawasan</option>');
                }
            });
        });
    </script>

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
