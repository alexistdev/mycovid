<x-backend.dashboard-layout :title="$judul" :tagSubMenu="$tagSubMenu" :total-notif="null">
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Data Rule</h1>
                    </div>
                    <div class="col-sm-6">
                        <x:notify-messages/>
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item active">Rule</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="card card-dark">
                <div class="card-header">
                    <h3 class="card-title">Master Data Rule</h3>
                    <a href="{{route('admin.addpenyakit')}}"><button class="btn btn-sm btn-primary float-right"><i class="fas fa-plus"></i> Tambah</button></a>
                </div>
                <div class="card-body">
                    <table id="tabelRule" class="table table-bordered table-hover" style="width: 100%">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama Gejala</th>
                                <th>Nama Penyakit</th>
                                <th>Nilai CF</th>
                                <th>Dibuat</th>
                                <th>Action</th>
                            </tr>
                            <tbody>

                            </tbody>
                        </thead>
                    </table>
                </div>
            </div>
            <!-- /.card -->

        </section>
        <!-- /.content -->
    </div>
    <!-- Modal -->
    <div class="modal fade" id="modalHapus" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Hapus Data!</h5>
                </div>
                <form action="{{route('admin.deletepenyakit')}}" method="post">
                    @csrf
                    @method('delete')
                    <div class="modal-body">
                        <input type="hidden" id="idHapus" name="id" value="">
                        Apakah anda ingin menghapus data ini?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <!-- START: Script -->
    <x-backend.script-layout/>
    <!-- END: Script -->
    <script>
        $(document).on("click", ".hapus-Modal", function () {
            let fid = $(this).data('id');
            $('#idHapus').val(fid);
        });

        $(document).ready(function () {
            $('#tabelRule').DataTable({
                responsive : true,
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.rule') }}",
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
                    {data: 'gejala.name', class: 'text-left'},
                    {data: 'penyakit.name', class: 'text-left'},
                    {data: 'nilai_cf', class: 'text-left'},
                    {data: 'created_at',width:"15%", class: 'text-center'},
                    {data: 'action',width: "15%", class: 'text-center'},
                ],
            });
        });
    </script>
</x-backend.dashboard-layout>
