@extends('admin.layout')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Книги
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
                        <a href="{{route('admin_panel.books.create')}}" class="btn btn-success">Добавить</a>
                    </div>
                    {{ $books->links() }}
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Название</th>
                            <th>Дата публикации</th>
                            <th>Обложка</th>
                            <th>Кол-во страниц</th>
                            <th>Описание</th>
                            <th>Новинка</th>
                            <th>Популярное</th>
                            <th>Рекомендация</th>
                            <th>Действия</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($books as $book)
                            <tr>
                                <td>{{$book->id}}</td>
                                <td>{{$book->name}}</td>
                                <td>{{$book->date_publish}}</td>
                                <td>
                                    <img src="{{asset($book->cover_img)}}" alt="" class="img-responsive" width="150">
                                </td>
                                <td>{{$book->pages_quantity}}</td>
                                <td>{{$book->description}}</td>
                                <td>{{$book->novelty == '1' ? 'Да' : 'Нет'}}</td>
                                <td>{{$book->popular == '1' ? 'Да' : 'Нет'}}</td>
                                <td>{{$book->recommended == '1' ? 'Да' : 'Нет'}}</td>
                                <td>
                                    <a href="{{route('admin_panel.books.edit', $book->id)}}" class="fa fa-pencil"></a>
                                    <form action="{{route('admin_panel.books.destroy', $book->id)}}" method="post">
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
                    {{ $books->links() }}
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

@endsection
