@extends('admin.layout')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Авторы
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Листинг сущности</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="form-group">
                        <a href="{{route('admin_panel.authors.create')}}" class="btn btn-success">Добавить</a>
                    </div>
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Имя</th>
                            <th>Фото</th>
                            <th>Действия</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($authors as $author)
                            <tr>
                                <td>{{$author->id}}</td>
                                <td>{{$author->full_name}}</td>
                                <td>
                                    <img src="{{asset($author->photo)}}" alt="" class="img-responsive" width="150">
                                </td>
                                <td>
                                    <a href="{{route('admin_panel.authors.edit', $author->id)}}" class="fa fa-pencil"></a>
                                    <form action="{{route('admin_panel.authors.destroy', $author->id)}}" method="post">
                                        @method('DELETE')
                                        @csrf
                                        <button onclick="return confirm('Вы уверены?')" type="submit" class="delete">
                                            <a class="fa fa-remove"></a>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tfoot>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

@endsection
