@extends('admin.layout')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Редактирование пользователя
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">
            <form action="{{route('admin_panel.users.update', $user->id)}}" method="POST" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <!-- Default box -->
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Редактирование пользователя</h3>
                        @include('admin.errors')
                    </div>
                    <div class="box-body">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Имя</label>
                                <input name="name" type="text" class="form-control" id="name"
                                       placeholder="" value="{{$user->name}}">
                            </div>
                            <div class="form-group">
                                <label for="email">E-mail</label>
                                <input name="email" type="email" class="form-control" id="email"
                                       placeholder="" value="{{$user->email}}">
                            </div>
                            <div class="form-group">
                                <label for="password">Пароль</label>
                                <input name="password" type="password" class="form-control" id="password"
                                       placeholder="">
                            </div>
                            <div class="form-group">
                                <img src="{{asset($user->avatar)}}" alt="" width="200" class="img-responsive">
                                <label for="avatar">Аватар</label>
                                <input name="avatar" type="file" id="avatar">
                                <p class="help-block">png, jpeg, jpg, svg</p>
                            </div>
                            <div class="form-group">
                                <label for="role">Роль</label>
                                <select name="role_id" id="role">
                                    @foreach($roles as $role)
                                        <option value="{{$role->id}}" <?= $user->role_id == $role->id ? 'selected' : '' ?>>{{$role->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <a href="{{route('admin_panel.users.index')}}" class="btn btn-default">Назад</a>
                        <button class="btn btn-warning pull-right">Изменить</button>
                    </div>
                    <!-- /.box-footer-->
                </div>
                <!-- /.box -->
            </form>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
