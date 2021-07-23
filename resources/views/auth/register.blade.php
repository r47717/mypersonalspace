@extends('layouts.app-noauth')

@section('content')
    <h3 class="mb-5">Зарегистрируйся и получи доступ к<br/>своей личной зоне</h3>
    <div>
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="form-group row">
                <label for="name" class="col-md-3 col-form-label">Ваше имя</label>

                <div class="col-md-7">
                    <input id="name" type="text"
                           class="my-form-control @error('name') is-invalid @enderror" name="name"
                           value="{{ old('name') }}" required autocomplete="name" autofocus>

                    @error('name')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="email" class="col-md-3 col-form-label">Email</label>

                <div class="col-md-7">
                    <input id="email" type="email"
                           class="my-form-control @error('email') is-invalid @enderror" name="email"
                           value="{{ old('email') }}" required autocomplete="email">

                    @error('email')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="password" class="col-md-3 col-form-label">Пароль</label>

                <div class="col-md-7">
                    <input id="password" type="password"
                           class="my-form-control @error('password') is-invalid @enderror" name="password"
                           required autocomplete="new-password">

                    @error('password')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="password-confirm" class="col-md-3 col-form-label">Подтвердите пароль</label>

                <div class="col-md-7">
                    <input id="password-confirm" type="password" class="my-form-control"
                           name="password_confirmation" required autocomplete="new-password">
                </div>
            </div>

            <div class="form-group row mb-4 mt-4">
                <div class="col-md-7 offset-md-3">
                    <div class="g-recaptcha" data-sitekey="{{ env('GOOGLE_RECAPTCHA_KEY')  }}"></div>
                </div>
            </div>

            <div class="form-group row mb-0">
                <div class="col-md-7 offset-md-3">
                    <button type="submit">
                        Регистрация
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection
