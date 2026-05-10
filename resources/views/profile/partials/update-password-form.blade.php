<section>
    <header>
        <h2 class="text-lg font-semibold text-slate-900">
            Kemaskini Kata Laluan
        </h2>

        <p class="mt-1 text-sm leading-6 text-slate-500">
            Pastikan akaun anda menggunakan kata laluan yang kuat dan sukar diteka untuk kekal selamat.
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <x-input-label for="update_password_current_password" :value="'Kata Laluan Semasa'" />
            <x-text-input id="update_password_current_password" name="current_password" type="password" class="mt-1 block w-full rounded-2xl border-slate-200 bg-slate-50 px-4 py-3 text-slate-800 shadow-sm focus:border-sky-400 focus:ring-sky-100" autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="update_password_password" :value="'Kata Laluan Baharu'" />
            <x-text-input id="update_password_password" name="password" type="password" class="mt-1 block w-full rounded-2xl border-slate-200 bg-slate-50 px-4 py-3 text-slate-800 shadow-sm focus:border-sky-400 focus:ring-sky-100" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="update_password_password_confirmation" :value="'Sahkan Kata Laluan'" />
            <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full rounded-2xl border-slate-200 bg-slate-50 px-4 py-3 text-slate-800 shadow-sm focus:border-sky-400 focus:ring-sky-100" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex flex-col gap-3 sm:flex-row sm:items-center">
            <x-primary-button>Simpan</x-primary-button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >Berjaya disimpan.</p>
            @endif
        </div>
    </form>
</section>
