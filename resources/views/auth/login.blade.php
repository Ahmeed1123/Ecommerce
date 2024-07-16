<x-layouts.authentication>
    <h4 class="mb-2">Welcome to Sneat! 👋</h4>
    <p class="mb-4">Please sign-in to your account and start the adventure</p>
    <form id="formAuthentication" class="mb-3" method="POST" action="{{ route('login') }}">
        @csrf


        <div class="form-group mb-3">
                <label for="email" class="col-md-4 col-form-label text-md-start">{{ __('Email Address') }}</label>
                <input
                    id="email"
                    type="email"
                    class="form-control @error('email') is-invalid @enderror"
                    name="email" value="{{ old('email') }}"
                    required
                    placeholder="Enter your email or username"
                    autocomplete="email"
                    autofocus/>

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="mb-3 form-password-toggle">
                <div class="d-flex flex-sm-row flex-column gap-sm-0 gap-1 justify-content-between">
                    <label for="password" class="col-md-4 col-form-label text-md-start">{{ __('Password') }}</label>
                    <a href="{{ route('password.request') }}">
                        <small>Forgot Password?</small>
                    </a>
                </div>
                <div class="input-group input-group-merge">
                    <input
                    id="password"
                    type="password"
                    class="form-control @error('password') is-invalid @enderror"
                    name="password"
                    required
                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                    autocomplete="current-password">
                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                </div>
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
        </div>

        <div class="mb-3">
            <div class="form-check d-flex gap-2 align-items-center">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                    <label class="form-check-label mt-1" for="remember">
                        {{ __('Remember Me') }}
                    </label>
            </div>
        </div>

        <div class="mb-3">
                <button type="submit" class="btn btn-primary d-grid w-100">
                    {{ __('Login') }}
                </button>


        </div>
    </form>
    <p class="text-center">
        <span>New on our platform?</span>
        <a href="{{ route('register') }}">
          <span>Create an account</span>
        </a>
    </p>
</x-layouts.authentication>
