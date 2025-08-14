<x-volt-base>
    <div class="layout--auth is-{!! config('laravolt.ui.login_layout') !!} !w-full !max-w-none flex items-center justify-center min-h-screen px-4">
        <div class="layout_login w-full flex justify-center">
            <div class="x-auth w-full sm:max-w-[800px] md:max-w-[1000px] lg:max-w-[1200px] xl:max-w-[1360px]">
                <main class="x-auth__content w-full" up-main="root">
                    <div class="p-2">
                        <x-volt-brand-image/>
                    </div>

                    {{ $slot }}
                    @stack('main')
                </main>
            </div>
        </div>
    </div>
</x-volt-base>
