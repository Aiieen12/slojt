<section class="space-y-6">
    <header>
        <h2 class="text-lg font-semibold text-slate-900">
            Padam Akaun
        </h2>

        <p class="mt-1 text-sm leading-6 text-slate-600">
            Selepas akaun anda dipadamkan, semua data berkaitan akan dipadam secara kekal. Pastikan anda menyimpan maklumat penting terlebih dahulu.
        </p>
    </header>

    <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="rounded-2xl"
    >Padam Akaun</x-danger-button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-semibold text-slate-900">
                Adakah anda pasti mahu memadam akaun anda?
            </h2>

            <p class="mt-1 text-sm leading-6 text-slate-600">
                Selepas akaun anda dipadamkan, semua data berkaitan akan dipadam secara kekal. Sila masukkan kata laluan anda untuk mengesahkan tindakan ini.
            </p>

            <div class="mt-6">
                <x-input-label for="password" value="Kata Laluan" class="sr-only" />

                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-full rounded-2xl border-slate-200 bg-slate-50 px-4 py-3 text-slate-800 shadow-sm focus:border-rose-400 focus:ring-rose-100 sm:w-3/4"
                    placeholder="Kata Laluan"
                />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    Batal
                </x-secondary-button>

                <x-danger-button class="ms-3">
                    Padam Akaun
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>
