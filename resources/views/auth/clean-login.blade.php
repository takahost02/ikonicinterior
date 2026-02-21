<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <title>{{ __('Login') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Include Bootstrap 5 CDN or your preferred CSS framework --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Optional: Custom modern login form styling --}}
    <style>
        body {
            background: #f3f4f6;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .login-box {
            background: white;
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }

        .login-box h2 {
            margin-bottom: 1.5rem;
        }

        .form-control:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 0.2rem rgba(59, 130, 246, 0.25);
        }

        .btn-primary {
            background-color: #3b82f6;
            border: none;
        }

        .btn-primary:hover {
            background-color: #2563eb;
        }

        .text-link {
            font-size: 0.9rem;
        }
    </style>

    @if ($settings['recaptcha_module'] == 'on' && isset($settings['google_recaptcha_version']) && $settings['google_recaptcha_version'] == 'v2-checkbox')
        {!! NoCaptcha::renderJs() !!}
    @endif
</head>
<body>
    <div class="login-box">
        <h2 class="text-center">{{ __('Login') }}</h2>

        @if (session('status'))
            <div class="alert alert-danger">
                {{ session('status') }}
            </div>
        @endif

        {{ Form::open(['route' => 'login', 'method' => 'post', 'id' => 'loginForm', 'novalidate']) }}

            <div class="mb-3">
                <label class="form-label">{{ __('Email') }}</label>
                {{ Form::text('email', null, ['class' => 'form-control', 'required', 'placeholder' => 'Enter your email']) }}
                @error('email')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">{{ __('Password') }}</label>
                {{ Form::password('password', ['class' => 'form-control', 'required', 'placeholder' => 'Enter your password']) }}
                @error('password')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            @if ($settings['recaptcha_module'] == 'on')
                <div class="mb-3">
                    @if ($settings['google_recaptcha_version'] == 'v2-checkbox')
                        {!! NoCaptcha::display() !!}
                        @error('g-recaptcha-response')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    @else
                        <input type="hidden" name="g-recaptcha-response" id="g-recaptcha-response">
                        @error('g-recaptcha-response')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    @endif
                </div>
            @endif

            <div class="d-grid">
                <button type="submit" class="btn btn-primary">{{ __('Login') }}</button>
            </div>

            <div class="mt-3 text-center">
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request', $lang ?? app()->getLocale()) }}" class="text-link">{{ __('Forgot your password?') }}</a>
                @endif
            </div>

            @if ($settings['enable_signup'] == 'on')
                <div class="mt-3 text-center">
                    <p>{{ __("Don't have an account?") }}
                        <a href="{{ route('register', ['0', $lang ?? app()->getLocale()]) }}">{{ __('Register') }}</a>
                    </p>
                </div>
            @endif

        {{ Form::close() }}
    </div>

    {{-- Scripts --}}
    <script src="{{ asset('js/jquery.min.js') }}"></script>

    @if ($settings['recaptcha_module'] == 'on' && $settings['google_recaptcha_version'] != 'v2-checkbox')
        <script src="https://www.google.com/recaptcha/api.js?render={{ $settings['google_recaptcha_key'] }}"></script>
        <script>
            grecaptcha.ready(function () {
                grecaptcha.execute('{{ $settings['google_recaptcha_key'] }}', { action: 'submit' }).then(function (token) {
                    document.getElementById('g-recaptcha-response').value = token;
                });
            });
        </script>
    @endif
</body>
</html>
