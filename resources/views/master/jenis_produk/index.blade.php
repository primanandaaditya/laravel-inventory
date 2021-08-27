@extends ('template')

@section ('head')
    Jenis Produk
@stop

@section ('main')


    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Tabel</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table class="table table-hover table-bordered">
                <tr>
                    <th>Jenis Produk</th>
                    <th>Keterangan</th>
                </tr>

                <?php foreach ($jenis as $j): ?>
                <tr>
                    <td>{{ $j->nama }}</td>
                    <td>{{ $j->keterangan }}</td>
                </tr>
                <?php endforeach ?>
            </table>


        </div>
        <!-- /.card-body -->
        <div class="card-footer clearfix">

        </div>
    </div>



@stop 