@extends('admin.layout')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Добавить пользователя
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">
            <form action="{{route('admin_panel.users.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <!-- Default box -->
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Добавляем пользователя</h3>
                        @include('admin.errors')
                    </div>
                    <div class="box-body">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Имя</label>
                                <input value="{{old('name')}}" name="name" type="text" class="form-control"
                                       id="name" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="email">E-mail</label>
                                <input value="{{old('email')}}" name="email" type="email" class="form-control"
                                       id="email" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="password">Пароль</label>
                                <input name="password" type="password" class="form-control" id="password"
                                       placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="avatar">Аватар</label>
                                <input name="avatar" type="file" id="avatar">
                                <p class="help-block">Формат: png, jpg, jpeg, svg</p>
                            </div>
                            <div class="form-group">
                                <label for="role">Роль</label>
                                <select name="role" id="role">
                                    @foreach($roles as $role)
                                        <option value="{{$role->id}}">{{$role->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <a href="{{route('admin_panel.users.index')}}" class="btn btn-default">Назад</a>
                        <button class="btn btn-success pull-right">Добавить</button>
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
