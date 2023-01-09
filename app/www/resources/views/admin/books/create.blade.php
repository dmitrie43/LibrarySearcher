@extends('admin.layout')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Добавить книгу
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">
            <form action="{{route('admin_panel.books.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <!-- Default box -->
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Добавляем книгу</h3>
                        @include('admin.errors')
                    </div>
                    <div class="box-body">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Название</label>
                                <input value="{{old('name')}}" name="name" type="text" class="form-control"
                                       id="name" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="date_publish">Дата публикации</label>
                                <input value="{{old('date_publish')}}" name="date_publish" type="date" class="form-control"
                                       id="date_publish" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="cover_img">Обложка</label>
                                <input name="cover_img" type="file" id="cover_img">
                                <p class="help-block">Формат: png, jpg, jpeg, svg</p>
                            </div>
                            <div class="form-group">
                                <label for="pages_quantity">Кол-во страниц</label>
                                <input value="{{old('pages_quantity')}}" name="pages_quantity" type="text" class="form-control"
                                       id="pages_quantity" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="description">Описание</label>
                                <textarea class="form-control" name="description" id="description" cols="30" rows="5">{{old('description')}}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="age_rating">Возрастной рейтинг</label>
                                <input value="{{old('age_rating')}}" name="age_rating" type="text" class="form-control"
                                       id="age_rating" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="novelty">Новинка</label>
                                <select class="form-control" name="novelty" id="novelty">
                                    <option value="0">Нет</option>
                                    <option value="1">Да</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="popular">Популярное</label>
                                <select class="form-control" name="popular" id="popular">
                                    <option value="0">Нет</option>
                                    <option value="1">Да</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="recommended">Рекомендация</label>
                                <select class="form-control" name="recommended" id="recommended">
                                    <option value="0">Нет</option>
                                    <option value="1">Да</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="author">Автор</label>
                                <select class="form-control" name="author" id="author">
                                    @foreach($authors as $author)
                                        <option value="{{$author->id}}" @if($loop->iteration === 1) selected @endif>{{$author->full_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="publisher">Издатель</label>
                                <select class="form-control" name="publisher" id="publisher">
                                    @foreach($publishers as $publisher)
                                        <option value="{{$publisher->id}}" @if($loop->iteration === 1) selected @endif>{{$publisher->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="genres">Жанры</label>
                                <select class="form-control" name="genres[]" id="genres" multiple="multiple">
                                    @foreach($genres as $genre)
                                        <option value="{{$genre->id}}">{{$genre->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <a href="{{route('admin_panel.books.index')}}" class="btn btn-default">Назад</a>
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
