@extends ("layouts/index_layout")

@section('content')

    <div class="bannerSec">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="bannercntSec signcntsec">
                        <div class="signctn">
                            <h2 class="textwhitecolor signheading">Авторизация <span
                                    class="textbluecolor">libSearcher</span></h2>
                            <div class="sign-from">
                                <x-auth-validation-errors class="mb-4 alert-danger" :errors="$errors"/>
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <div class="input-box">
                                        <input id="email" type="email" name="email" placeholder="Email" required
                                               class="form-input">
                                    </div>
                                    <div class="input-box">
                                        <input id="password" type="password" name="password" placeholder="Пароль"
                                               required class="form-input">
                                    </div>
                                    <div class="sign-btn">
                                        <button class="btn btnlightblue me-3" type="submit">Вход</button>
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
