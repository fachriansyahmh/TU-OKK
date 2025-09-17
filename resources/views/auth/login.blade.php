<x-volt-auth>
    <h3 class="ui header horizontal divider section">@lang('laravolt::auth.login')</h3>

    {!! form()->open(route('auth::login.store'))->attribute('up-target', 'body') !!}
    {!! form()->email('email')->label(__('laravolt::auth.identifier')) !!}

    {{-- Mengganti form builder dengan HTML manual untuk menambahkan ikon mata --}}
    <div class="field required">
        <label for="password">@lang('laravolt::auth.password')</label>
        <div class="ui icon input">
            <input type="password" name="password" id="password-field" required>
            <i class="eye link icon" id="toggle-password"></i>
        </div>
    </div>


    @if(config('laravolt.platform.features.captcha'))
        <div class="field">
            {!! app('captcha')->display() !!}
            {!! app('captcha')->renderJs() !!}

        </div>
    @endif

    <div class="ui field m-b-2">
        <div class="ui equal width grid">
            <div class="column left aligned">
                <div class="ui checkbox">
                    <input type="checkbox" name="remember" {{ request()->old('remember')?'checked':'' }}>
                    <label>@lang('laravolt::auth.remember')</label>
                </div>
            </div>
            <div class="column right aligned">
                <a themed href="{{ route('auth::forgot.show') }}"
                   class="link">@lang('laravolt::auth.forgot_password')</a>
            </div>
        </div>
    </div>

    <div class="field action">
        <x-volt-button class="fluid">@lang('laravolt::auth.login')</x-volt-button>
    </div>

    @if(config('laravolt.platform.features.registration'))
        <div class="ui divider section"></div>
        <div>
            @lang('laravolt::auth.not_registered_yet?')
            <a themed href="{{ route('auth::registration.show') }}"
               class="link">@lang('laravolt::auth.register_here')</a>
        </div>
    @endif
    {!! form()->close() !!}

</x-volt-auth>

<script>
    // Menunggu seluruh halaman dimuat sebelum menjalankan skrip
    document.addEventListener('DOMContentLoaded', function() {
        const togglePassword = document.querySelector('#toggle-password');
        const password = document.querySelector('#password-field');

        if(togglePassword && password) {
            togglePassword.addEventListener('click', function (e) {
                // Mengubah tipe input dari 'password' ke 'text' dan sebaliknya
                const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                password.setAttribute('type', type);

                // Mengubah ikon dari 'eye' menjadi 'eye slash' dan sebaliknya
                this.classList.toggle('slash');
            });
        }
    });
</script>
