@extends('layouts.app-noauth')

@section('content')
    <h3 class="mb-5">Для входа в личную зону<br/>введите регистрационные данные</h3>
    <div>
        <form id="login-form" method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-group row">
                <label for="email" class="col-md-3 col-form-label">Email</label>

                <div class="col-md-7">
                    <input id="email" type="email"
                           class="my-form-control @error('email') is-invalid @enderror" name="email"
                           value="{{ old('email') }}" required autocomplete="email" autofocus>

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
                           required autocomplete="current-password">

                    @error('password')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <div class="col-md-7 offset-md-3">
                    <div class="remember-check">
                        <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label" for="remember">
                            Запомнить меня
                        </label>
                    </div>
                </div>
            </div>

            <div class="form-group row mb-4">
                <div class="col-md-7 offset-md-3">
                    <div class="g-recaptcha" data-sitekey="{{ env('GOOGLE_RECAPTCHA_KEY')  }}"></div>
                </div>
            </div>

            <div class="form-group row mb-0">
                <div class="col-md-7 offset-md-3">
                    <button type="submit" class="btn btn-primary">
                        Войти
                    </button>

                    @if (Route::has('password.request'))
                        <div class="text-center mt-1">
                            Забыли пароль?
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                Восстановить доступ
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </form>
    </div>
@endsection
