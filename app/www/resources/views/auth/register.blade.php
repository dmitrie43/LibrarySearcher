@extends ("layouts/index_layout")

@section('content')

    <div class="bannerSec">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="bannercntSec signupsec">
                        <div class="bannercnt signctn">
                            <h2 class="textwhitecolor signheading">Регистрация <span
                                    class="textbluecolor">libSearcher</span></h2>
                            <p class="textwhitecolor">Присоединяйтесь к нам! <br> Мы работаем над новым функционалом</p>
                            <div class="sign-from signup-form">
                                <x-auth-validation-errors class="mb-4 alert-danger" :errors="$errors"/>
                                <form method="POST" action="{{ route('register') }}">
                                    @csrf
                                    <div class="input-box">
                                        <input id="name" type="text" name="name" placeholder="Имя" required
                                               class="form-input">
                                    </div>
                                    <div class="input-box">
                                        <input id="email" type="email" name="email" placeholder="Email" required
                                               class="form-input">
                                    </div>
                                    <div class="row input-box">
                                        <div class="col-md-6">
                                            <input id="password" type="password" name="password" placeholder="Пароль"
                                                   required class="form-input">
                                        </div>
                                        <div class="col-md-6">
                                            <input id="password_confirmation" type="password"
                                                   name="password_confirmation" required
                                                   placeholder="Подтвердите пароль" class="form-input">
                                        </div>
                                    </div>
                                    <div class="sign-btn">
                                        <button class="btn btnlightblue me-3" type="submit">Зарегистрироваться</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
