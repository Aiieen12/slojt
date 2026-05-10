<x-guest-layout>
    <div class="overflow-hidden rounded-[34px] border border-white/80 bg-white shadow-[0_35px_90px_-35px_rgba(76,29,149,0.28)]">
        <div class="grid lg:grid-cols-[minmax(0,1.05fr)_minmax(340px,0.95fr)]" x-data="{ showLogin: false }">
            <section class="relative order-2 px-5 py-8 sm:px-8 lg:order-1 lg:px-12 lg:py-12">
                <div class="mx-auto max-w-md">
                    <div class="relative min-h-[760px] sm:min-h-[780px]">
                        <div x-show="!showLogin" x-transition:enter="transition ease-out duration-500" x-transition:enter-start="opacity-0 -translate-x-8" x-transition:enter-end="opacity-100 translate-x-0" x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100 translate-x-0" x-transition:leave-end="opacity-0 -translate-x-8" class="absolute inset-0">
                            <div class="animate-[riseIn_0.7s_ease-out_both]">
                                <p class="text-xs font-semibold uppercase tracking-[0.28em] text-violet-500">Akaun Baru</p>
                                <h1 class="mt-3 text-3xl font-semibold tracking-tight text-slate-900 sm:text-[2rem]">Daftar Akaun</h1>
                                <p class="mt-3 text-sm leading-6 text-slate-500">Lengkapkan maklumat di bawah untuk mula menggunakan sistem.</p>
                            </div>

                            <form method="POST" action="{{ route('register') }}" class="mt-8 space-y-5">
                                @csrf

                                <div class="animate-[riseIn_0.8s_ease-out_0.08s_both]">
                                    <label for="name" class="mb-2 block text-sm font-semibold text-slate-700">Nama</label>
                                    <div class="relative">
                                        <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-violet-500">
                                            <span class="inline-flex h-10 w-10 items-center justify-center rounded-full bg-violet-100 shadow-[0_12px_24px_-16px_rgba(109,40,217,0.8)]">
                                                <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" aria-hidden="true">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6.75a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                                                </svg>
                                            </span>
                                        </span>
                                        <input
                                            id="name"
                                            class="block w-full rounded-full border border-violet-100 bg-white py-4 pl-16 pr-5 text-sm text-slate-900 shadow-[0_16px_40px_-24px_rgba(109,40,217,0.28)] transition duration-200 placeholder:text-slate-400 focus:border-violet-300 focus:outline-none focus:ring-4 focus:ring-violet-100"
                                            type="text"
                                            name="name"
                                            value="{{ old('name') }}"
                                            required
                                            autofocus
                                            autocomplete="name"
                                            placeholder="Masukkan nama penuh"
                                        />
                                    </div>
                                    <x-input-error :messages="$errors->get('name')" class="mt-2 text-sm text-rose-600" />
                                </div>

                                <div class="animate-[riseIn_0.8s_ease-out_0.16s_both]">
                                    <label for="email" class="mb-2 block text-sm font-semibold text-slate-700">E-mel</label>
                                    <div class="relative">
                                        <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-violet-500">
                                            <span class="inline-flex h-10 w-10 items-center justify-center rounded-full bg-violet-100 shadow-[0_12px_24px_-16px_rgba(109,40,217,0.8)]">
                                                <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" aria-hidden="true">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5A2.25 2.25 0 0 1 19.5 19.5h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15A2.25 2.25 0 0 0 2.25 6.75m19.5 0-8.69 5.793a1.5 1.5 0 0 1-1.622 0L2.25 6.75" />
                                                </svg>
                                            </span>
                                        </span>
                                        <input
                                            id="email"
                                            class="block w-full rounded-full border border-violet-100 bg-white py-4 pl-16 pr-5 text-sm text-slate-900 shadow-[0_16px_40px_-24px_rgba(109,40,217,0.28)] transition duration-200 placeholder:text-slate-400 focus:border-violet-300 focus:outline-none focus:ring-4 focus:ring-violet-100"
                                            type="email"
                                            name="email"
                                            value="{{ old('email') }}"
                                            required
                                            autocomplete="username"
                                            placeholder="nama@domain.com"
                                        />
                                    </div>
                                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-rose-600" />
                                </div>

                                <div class="animate-[riseIn_0.8s_ease-out_0.24s_both]">
                                    <label for="password" class="mb-2 block text-sm font-semibold text-slate-700">Kata Laluan</label>
                                    <div class="relative">
                                        <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-violet-500">
                                            <span class="inline-flex h-10 w-10 items-center justify-center rounded-full bg-violet-100 shadow-[0_12px_24px_-16px_rgba(109,40,217,0.8)]">
                                                <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" aria-hidden="true">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V7.875a4.5 4.5 0 1 0-9 0V10.5m-.75 0h10.5A2.25 2.25 0 0 1 19.5 12.75v6A2.25 2.25 0 0 1 17.25 21h-10.5A2.25 2.25 0 0 1 4.5 18.75v-6A2.25 2.25 0 0 1 6.75 10.5Z" />
                                                </svg>
                                            </span>
                                        </span>
                                        <input
                                            id="password"
                                            class="block w-full rounded-full border border-violet-100 bg-white py-4 pl-16 pr-14 text-sm text-slate-900 shadow-[0_16px_40px_-24px_rgba(109,40,217,0.28)] transition duration-200 placeholder:text-slate-400 focus:border-violet-300 focus:outline-none focus:ring-4 focus:ring-violet-100"
                                            type="password"
                                            name="password"
                                            required
                                            autocomplete="new-password"
                                            placeholder="Masukkan kata laluan"
                                        />
                                        <span class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-5 text-violet-400">
                                            <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.644C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.437 0 .644C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.964-7.178Z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                            </svg>
                                        </span>
                                    </div>
                                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm text-rose-600" />
                                </div>

                                <div class="animate-[riseIn_0.8s_ease-out_0.32s_both]">
                                    <label for="password_confirmation" class="mb-2 block text-sm font-semibold text-slate-700">Sahkan Kata Laluan</label>
                                    <div class="relative">
                                        <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-violet-500">
                                            <span class="inline-flex h-10 w-10 items-center justify-center rounded-full bg-violet-100 shadow-[0_12px_24px_-16px_rgba(109,40,217,0.8)]">
                                                <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" aria-hidden="true">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75m6 2.25a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                                </svg>
                                            </span>
                                        </span>
                                        <input
                                            id="password_confirmation"
                                            class="block w-full rounded-full border border-violet-100 bg-white py-4 pl-16 pr-14 text-sm text-slate-900 shadow-[0_16px_40px_-24px_rgba(109,40,217,0.28)] transition duration-200 placeholder:text-slate-400 focus:border-violet-300 focus:outline-none focus:ring-4 focus:ring-violet-100"
                                            type="password"
                                            name="password_confirmation"
                                            required
                                            autocomplete="new-password"
                                            placeholder="Sahkan kata laluan"
                                        />
                                        <span class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-5 text-violet-400">
                                            <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.644C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.437 0 .644C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.964-7.178Z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                            </svg>
                                        </span>
                                    </div>
                                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-sm text-rose-600" />
                                </div>

                                <div class="flex justify-center pt-2 animate-[riseIn_0.8s_ease-out_0.48s_both]">
                                    <button type="submit" class="inline-flex min-w-[210px] items-center justify-center rounded-full bg-gradient-to-r from-violet-700 via-violet-600 to-fuchsia-500 px-8 py-3.5 text-sm font-semibold text-white shadow-[0_20px_35px_-18px_rgba(124,58,237,0.75)] transition duration-200 hover:-translate-y-0.5 hover:shadow-[0_26px_42px_-16px_rgba(124,58,237,0.85)] focus:outline-none focus:ring-4 focus:ring-violet-200">
                                        Daftar
                                    </button>
                                </div>
                            </form>
                        </div>

                        <div x-show="showLogin" x-transition:enter="transition ease-out duration-500" x-transition:enter-start="opacity-0 translate-x-8" x-transition:enter-end="opacity-100 translate-x-0" x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100 translate-x-0" x-transition:leave-end="opacity-0 translate-x-8" class="absolute inset-0">
                            <div class="animate-[riseIn_0.7s_ease-out_both]">
                                <p class="text-xs font-semibold uppercase tracking-[0.28em] text-violet-500">Akses Akaun</p>
                                <h2 class="mt-3 text-3xl font-semibold tracking-tight text-slate-900 sm:text-[2rem]">Log Masuk</h2>
                                <p class="mt-3 text-sm leading-6 text-slate-500">Masukkan e-mel dan kata laluan anda untuk meneruskan akses.</p>
                            </div>

                            <form method="POST" action="{{ route('login') }}" class="mt-10 space-y-5">
                                @csrf

                                <div class="animate-[riseIn_0.8s_ease-out_0.08s_both]">
                                    <label for="login_email" class="mb-2 block text-sm font-semibold text-slate-700">E-mel</label>
                                    <div class="relative">
                                        <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-violet-500">
                                            <span class="inline-flex h-10 w-10 items-center justify-center rounded-full bg-violet-100 shadow-[0_12px_24px_-16px_rgba(109,40,217,0.8)]">
                                                <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" aria-hidden="true">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5A2.25 2.25 0 0 1 19.5 19.5h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15A2.25 2.25 0 0 0 2.25 6.75m19.5 0-8.69 5.793a1.5 1.5 0 0 1-1.622 0L2.25 6.75" />
                                                </svg>
                                            </span>
                                        </span>
                                        <input
                                            id="login_email"
                                            class="block w-full rounded-full border border-violet-100 bg-white py-4 pl-16 pr-5 text-sm text-slate-900 shadow-[0_16px_40px_-24px_rgba(109,40,217,0.28)] transition duration-200 placeholder:text-slate-400 focus:border-violet-300 focus:outline-none focus:ring-4 focus:ring-violet-100"
                                            type="email"
                                            name="email"
                                            value="{{ old('email') }}"
                                            required
                                            autocomplete="username"
                                            placeholder="nama@domain.com"
                                        />
                                    </div>
                                </div>

                                <div class="animate-[riseIn_0.8s_ease-out_0.16s_both]">
                                    <div class="mb-2 flex items-center justify-between gap-3">
                                        <label for="login_password" class="block text-sm font-semibold text-slate-700">Kata Laluan</label>
                                        @if (Route::has('password.request'))
                                            <a href="{{ route('password.request') }}" class="text-sm font-medium text-violet-600 transition hover:text-violet-700">
                                                Lupa kata laluan?
                                            </a>
                                        @endif
                                    </div>
                                    <div class="relative">
                                        <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-violet-500">
                                            <span class="inline-flex h-10 w-10 items-center justify-center rounded-full bg-violet-100 shadow-[0_12px_24px_-16px_rgba(109,40,217,0.8)]">
                                                <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" aria-hidden="true">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V7.875a4.5 4.5 0 1 0-9 0V10.5m-.75 0h10.5A2.25 2.25 0 0 1 19.5 12.75v6A2.25 2.25 0 0 1 17.25 21h-10.5A2.25 2.25 0 0 1 4.5 18.75v-6A2.25 2.25 0 0 1 6.75 10.5Z" />
                                                </svg>
                                            </span>
                                        </span>
                                        <input
                                            id="login_password"
                                            class="block w-full rounded-full border border-violet-100 bg-white py-4 pl-16 pr-5 text-sm text-slate-900 shadow-[0_16px_40px_-24px_rgba(109,40,217,0.28)] transition duration-200 placeholder:text-slate-400 focus:border-violet-300 focus:outline-none focus:ring-4 focus:ring-violet-100"
                                            type="password"
                                            name="password"
                                            required
                                            autocomplete="current-password"
                                            placeholder="Masukkan kata laluan"
                                        />
                                    </div>
                                </div>

                                <label for="remember" class="flex items-center gap-3 rounded-full border border-violet-100 bg-violet-50/60 px-4 py-3 text-sm text-slate-600 shadow-[0_14px_32px_-24px_rgba(109,40,217,0.3)] animate-[riseIn_0.8s_ease-out_0.24s_both]">
                                    <input id="remember" type="checkbox" name="remember" class="h-4 w-4 rounded border-violet-300 text-violet-600 focus:ring-violet-500">
                                    <span>Ingat saya pada peranti ini</span>
                                </label>

                                <div class="flex justify-center pt-2 animate-[riseIn_0.8s_ease-out_0.4s_both]">
                                    <button type="submit" class="inline-flex min-w-[210px] items-center justify-center rounded-full bg-gradient-to-r from-violet-700 via-violet-600 to-fuchsia-500 px-8 py-3.5 text-sm font-semibold text-white shadow-[0_20px_35px_-18px_rgba(124,58,237,0.75)] transition duration-200 hover:-translate-y-0.5 hover:shadow-[0_26px_42px_-16px_rgba(124,58,237,0.85)] focus:outline-none focus:ring-4 focus:ring-violet-200">
                                        Log Masuk
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>

            <section class="relative order-1 min-h-[260px] overflow-hidden bg-gradient-to-br from-violet-700 via-violet-600 to-fuchsia-500 px-6 py-10 text-white sm:min-h-[320px] sm:px-8 lg:order-2 lg:min-h-full lg:px-10 lg:py-12">
                <div class="absolute inset-0 bg-[radial-gradient(circle_at_20%_20%,_rgba(255,255,255,0.14),_transparent_22%),radial-gradient(circle_at_80%_25%,_rgba(255,255,255,0.12),_transparent_20%),radial-gradient(circle_at_50%_100%,_rgba(255,255,255,0.1),_transparent_28%)]"></div>

                <div class="absolute -left-10 -top-8 h-28 w-40 rounded-[45%] bg-white sm:h-32 sm:w-48"></div>
                <div class="absolute left-16 top-10 h-24 w-24 rounded-full bg-white"></div>
                <div class="absolute left-32 top-6 h-28 w-28 rounded-full bg-white"></div>
                <div class="absolute left-52 top-12 h-24 w-24 rounded-full bg-white"></div>
                <div class="absolute right-10 top-16 h-20 w-28 rounded-[45%] bg-white/95"></div>

                <div class="absolute -bottom-10 -left-8 h-28 w-36 rounded-[45%] bg-white sm:h-32 sm:w-44"></div>
                <div class="absolute bottom-8 left-14 h-24 w-24 rounded-full bg-white"></div>
                <div class="absolute bottom-0 left-32 h-28 w-28 rounded-full bg-white"></div>
                <div class="absolute bottom-10 left-56 h-24 w-24 rounded-full bg-white"></div>
                <div class="absolute -bottom-4 right-10 h-32 w-32 rounded-full bg-white"></div>
                <div class="absolute bottom-6 right-28 h-24 w-24 rounded-full bg-white"></div>

                <div class="relative flex h-full min-h-[220px] items-center justify-center">
                    <div class="relative w-full max-w-sm overflow-hidden">
                        <div x-show="!showLogin" x-transition:enter="transition ease-out duration-700" x-transition:enter-start="translate-x-full opacity-0" x-transition:enter-end="translate-x-0 opacity-100" x-transition:leave="transition ease-in duration-500" x-transition:leave-start="translate-x-0 opacity-100" x-transition:leave-end="-translate-x-16 opacity-0" class="text-center">
                            <h2 class="text-3xl font-semibold tracking-tight sm:text-4xl">Selamat Datang!</h2>
                            <p class="mt-4 text-sm leading-7 text-violet-100 sm:text-base">
                                Daftar akaun anda untuk mula menggunakan sistem.
                            </p>
                            <button
                                type="button"
                                @click="showLogin = true"
                                class="mt-8 inline-flex items-center justify-center rounded-full border border-white/30 bg-white/12 px-6 py-3 text-sm font-semibold text-white shadow-[0_18px_34px_-22px_rgba(255,255,255,0.35)] backdrop-blur-sm transition duration-200 hover:-translate-y-0.5 hover:bg-white/18"
                            >
                                Sudah ada akaun? Log masuk
                            </button>
                        </div>

                        <div x-show="showLogin" x-transition:enter="transition ease-out duration-700" x-transition:enter-start="translate-x-16 opacity-0" x-transition:enter-end="-translate-x-10 opacity-100" x-transition:leave="transition ease-in duration-500" x-transition:leave-start="-translate-x-10 opacity-100" x-transition:leave-end="translate-x-16 opacity-0" class="text-center">
                            <h2 class="text-3xl font-semibold tracking-tight sm:text-4xl">Selamat Kembali!</h2>
                            <p class="mt-4 text-sm leading-7 text-violet-100 sm:text-base">
                                Log masuk ke akaun anda untuk meneruskan penggunaan sistem.
                            </p>
                            <button
                                type="button"
                                @click="showLogin = false"
                                class="mt-8 inline-flex items-center justify-center rounded-full border border-white/30 bg-white/12 px-6 py-3 text-sm font-semibold text-white shadow-[0_18px_34px_-22px_rgba(255,255,255,0.35)] backdrop-blur-sm transition duration-200 hover:-translate-y-0.5 hover:bg-white/18"
                            >
                                Belum ada akaun? Daftar
                            </button>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <style>
        @keyframes riseIn {
            from {
                opacity: 0;
                transform: translateY(18px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</x-guest-layout>
