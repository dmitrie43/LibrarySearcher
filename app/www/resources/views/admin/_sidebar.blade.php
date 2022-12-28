<ul class="sidebar-menu">
    <li class="header">ОСНОВНАЯ НАВИГАЦИЯ</li>
    <li class="treeview">
        <a href="{{route('admin_panel.dashboard')}}">
            <i class="fa fa-dashboard"></i><span>Главная</span>
        </a>
    </li>
    {{--    <li><a href="{{route('posts.index')}}"><i class="fa fa-sticky-note-o"></i> <span>Посты</span></a></li>--}}
    {{--    <li><a href="{{route('categories.index')}}"><i class="fa fa-list-ul"></i> <span>Категории</span></a></li>--}}
    {{--    <li><a href="{{route('tags.index')}}"><i class="fa fa-tags"></i> <span>Теги</span></a></li>--}}
    <li>
        <a href="/admin/comments">
            <i class="fa fa-commenting"></i> <span>Комментарии</span>
            <span class="pull-right-container">
{{--              <small class="label pull-right bg-green">{{App\Comment::where('status', 0)->count()}}</small>--}}
            </span>
        </a>
    </li>
    <li>
        <a href="{{route('admin_panel.users.index')}}">
            <i class="fa fa-users"></i><span>Пользователи</span>
        </a>
    </li>
    <li><a href="#"><i class="fa fa-user-plus"></i><span>Подписчики</span></a></li>
    <li><a href="/"><i class="fa fa-user"></i><span>На сайт</span></a></li>
</ul>
