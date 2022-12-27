@include ("header")

<div class="bannerSec">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="bannercntSec signupsec">
                    <div class="bannercnt signctn">
                        <h2 class="textwhitecolor signheading">Регистрация <span class="textbluecolor">libSearcher</span></h2>
                        <p class="textwhitecolor">Присоединяйтесь к нам! <br> Мы работаем над новым функционалом</p>
                        <div class="sign-from signup-form">
                            <form method="POST" action="{{ route('register') }}">
                                @csrf
                                <div class="input-box">
                                    <input id="name" type="text" name="name" placeholder="Имя" required class="form-input">
                                </div>
                                <div class="input-box">
                                    <input id="email" type="email" name="email" placeholder="Email" required class="form-input">
                                </div>
                                <div class="row input-box">
                                    <div class="col-md-6">
                                        <input id="password" type="password" name="password" placeholder="Пароль" required class="form-input">
                                    </div>
                                    <div class="col-md-6">
                                        <input id="password_confirmation" type="password" name="password_confirmation" required placeholder="Подтвердите пароль" class="form-input">
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

@include ("footer")

<? /*
<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div>
                <x-label for="name" :value="__('Name')" />

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ml-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
 */?>
