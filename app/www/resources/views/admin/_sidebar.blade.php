<ul class="sidebar-menu">
    <li class="header">ОСНОВНАЯ НАВИГАЦИЯ</li>
    <li class="treeview">
        <a href="{{route('admin_panel.dashboard')}}">
            <i class="fa fa-dashboard"></i><span>Главная</span>
        </a>
    </li>
    <li>
        <a href="{{route('admin_panel.authors.index')}}">
            <i class="fa fa-sticky-note-o"></i><span>Авторы</span>
        </a>
    </li>
    <li>
        <a href="{{route('admin_panel.genres.index')}}">
            <i class="fa fa-list-ul"></i><span>Жанры</span>
        </a>
    </li>
    <li>
        <a href="{{route('admin_panel.publishers.index')}}">
            <i class="fa fa-bank"></i><span>Издатели</span>
        </a>
    </li>
    <li>
        <a href="{{route('admin_panel.books.index')}}">
            <i class="fa fa-book"></i><span>Книги</span>
        </a>
    </li>
    <li>
        <a href="{{route('admin_panel.users.index')}}">
            <i class="fa fa-users"></i><span>Пользователи</span>
        </a>
    </li>
    <li>
        <a href="{{route('admin_panel.comments.index')}}">
            <i class="fa fa-commenting"></i><span>Комментарии</span>
            <span class="pull-right-container">
                <small class="label pull-right bg-green">{{\App\Models\Comment::where('is_approved', 0)->count()}}</small>
            </span>
        </a>
    </li>
    <li><a href="/"><i class="fa fa-user"></i><span>На сайт</span></a></li>
</ul>
