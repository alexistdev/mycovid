<x-backend.dashboard-layout :title="$judul" :tagSubMenu="$tagSubMenu" :total-notif="null">
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>{{($tag != 'edit')?"Tambah":"Edit"}} Data Penyakit</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{route('admin.penyakit')}}">Penyakit</a></li>
                            <li class="breadcrumb-item active">{{($tag != 'edit')?"Tambah":"Edit"}}</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-8">
                        <x:notify-messages/>
                        <!-- Default box -->
                        <div class="card card-dark">
                            <div class="card-header">
                                <h3 class="card-title">Form {{($tag != 'edit')?"Input":"Edit"}} Data Penyakit</h3>
                            </div>
                            <div class="card-body">
                                @if($tag === 'add')
                                <form action="{{route('admin.savepenyakit')}}" method="post" role="form">
                                    @csrf
                                        <div class="form-group">
                                            <label for="name">Nama Penyakit</label>
                                            <input type="text" class="form-control" id="name" name="name" value="{{old('name')}}" placeholder="Masukkan Nama Penyakit">
                                            @error('name')
                                            <div class="text-sm text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    <a href="{{route('admin.penyakit')}}"><button type="button" class="btn btn-danger">Batal</button></a>
                                </form>
                                @else
                                    <form action="{{route('admin.updatepenyakit')}}" method="post" role="form">
                                        @csrf
                                        @method('patch')
                                        <input type="hidden" name="id" value="{{$idEdit}}">
                                        <div class="form-group">
                                            <label for="name">Nama Penyakit</label>
                                            <input type="text" class="form-control" id="name" name="name" value="{{$name}}" placeholder="Masukkan Nama Penyakit">
                                            @error('name')
                                            <div class="text-sm text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                        <a href="{{route('admin.penyakit')}}"><button type="button" class="btn btn-danger">Batal</button></a>
                                    </form>
                                @endif
                            </div>
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div>


        </section>
        <!-- /.content -->
    </div>
    <!-- START: Script -->
    <x-backend.script-layout/>
    <!-- END: Script -->
    <script>
        $(document).ready(function () {
            $('#tabelPenyakit').DataTable({
                responsive : true,
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.penyakit') }}",
                columns: [
                    {
                        data: 'index',
                        class: 'text-center',
                        defaultContent: '',
                        orderable: false,
                        searchable: false,
                        width: '5%',
                        render: function (data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1; //auto increment
                        }
                    },
                    {data: 'name', class: 'text-left'},
                    {data: 'created_at',width:"10%", class: 'text-center'},
                    {data: 'action',width: "15%", class: 'text-center'},
                ],
            });
        });
    </script>
</x-backend.dashboard-layout>
