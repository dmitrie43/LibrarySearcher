@extends('admin.layout')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Комментарии
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
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Тема</th>
                            <th>Комментарий</th>
                            <th>Одобрен</th>
                            <th>Действия</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($comments as $comment)
                            <tr>
                                <td>{{$comment->id}}</td>
                                <td>{{$comment->theme}}</td>
                                <td>{{$comment->text}}</td>
                                <td>{{$comment->is_approved ? 'Да' : 'Нет'}}</td>
                                <td>
                                    @if($comment->is_approved == 0)
                                        <a href="{{route('admin_panel.comments.approve', $comment->id)}}" class="fa fa-check" title="Одобрить комментарий"></a>
                                    @else
                                        <a href="{{route('admin_panel.comments.disapprove', $comment->id)}}" class="fa fa-ban" title="Не отображать отзыв"></a>
                                    @endif
                                    <form action="{{route('admin_panel.comments.destroy', $comment->id)}}" method="post">
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
                    {{ $comments->links() }}
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

@endsection
