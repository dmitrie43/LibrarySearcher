@extends('admin.layout')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Редактирование книги
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">
            <form action="{{route('admin_panel.books.update', $book->id)}}" method="POST" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <!-- Default box -->
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Редактирование книги</h3>
                        @include('admin.errors')
                    </div>
                    <div class="box-body">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Название</label>
                                <input value="{{$book->name}}" name="name" type="text" class="form-control"
                                       id="name" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="date_publish">Дата публикации</label>
                                <input value="{{$book->date_publish}}" name="date_publish" type="date" class="form-control"
                                       id="date_publish" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="file">Файл {{($book->file) ? 'закачен: '.$book->file : ''}}</label>
                                <input name="file" type="file" id="file" accept=".pdf, .epub, .fb2">
                                <p class="help-block">Формат: pdf, epub, fb2</p>
                            </div>
                            <div class="form-group">
                                <img src="{{asset($book->cover_img)}}" alt="" width="200" class="img-responsive">
                                <label for="cover_img">Обложка</label>
                                <input name="cover_img" type="file" id="cover_img">
                                <p class="help-block">Формат: png, jpg, jpeg, svg</p>
                            </div>
                            <div class="form-group">
                                <label for="pages_quantity">Кол-во страниц</label>
                                <input value="{{$book->pages_quantity}}" name="pages_quantity" type="text" class="form-control"
                                       id="pages_quantity" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="description">Описание</label>
                                <textarea class="form-control" name="description" id="description" cols="30" rows="5">{{$book->description}}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="age_rating">Возрастной рейтинг</label>
                                <input value="{{$book->age_rating}}" name="age_rating" type="text" class="form-control"
                                       id="age_rating" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="novelty">Новинка</label>
                                <select class="form-control" name="is_novelty" id="novelty">
                                    <option value="0" {{$book->is_novelty ? 'selected' : ''}}>Нет</option>
                                    <option value="1" {{$book->is_novelty ? 'selected' : ''}}>Да</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="popular">Популярное</label>
                                <select class="form-control" name="is_popular" id="popular">
                                    <option value="0" {{$book->is_popular ? 'selected' : ''}}>Нет</option>
                                    <option value="1" {{$book->is_popular ? 'selected' : ''}}>Да</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="recommended">Рекомендация</label>
                                <select class="form-control" name="is_recommended" id="recommended">
                                    <option value="0" {{$book->is_recommended ? 'selected' : ''}}>Нет</option>
                                    <option value="1" {{$book->is_recommended ? 'selected' : ''}}>Да</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="author">Автор</label>
                                <select class="form-control" name="author" id="author">
                                    @foreach($authors as $author)
                                        <option value="{{$author->id}}" {{$book->author_id == $author->id ? 'selected' : ''}}>{{$author->full_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="publisher">Издатель</label>
                                <select class="form-control" name="publisher" id="publisher">
                                    @foreach($publishers as $publisher)
                                        <option value="{{$publisher->id}}" {{$book->publisher_id == $publisher->id ? 'selected' : ''}}>{{$publisher->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="genres">Жанры</label>
                                <select class="form-control" name="genres[]" id="genres" multiple>
                                    @foreach($genres as $genre)
                                        <option value="{{$genre->id}}" {{isset($bookGenreIds[$genre->id]) ? 'selected' : ''}}>{{$genre->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <a href="{{route('admin_panel.books.index')}}" class="btn btn-default">Назад</a>
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
