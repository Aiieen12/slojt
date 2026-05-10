<x-app-layout>
    <div class="min-h-screen bg-[radial-gradient(circle_at_top,_rgba(125,211,252,0.16),_transparent_32%),linear-gradient(180deg,_#f8fbff_0%,_#f5f7fb_100%)] py-6 sm:py-8 lg:py-10">
        <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
            <div class="overflow-hidden rounded-[30px] border border-white/70 bg-white/85 shadow-[0_24px_70px_-34px_rgba(15,23,42,0.22)] backdrop-blur">
                <div class="border-b border-slate-200/80 bg-gradient-to-r from-sky-50 via-white to-cyan-50 px-5 py-6 sm:px-8 sm:py-7">
                    <div class="flex flex-col gap-5 lg:flex-row lg:items-start lg:justify-between">
                        <div class="max-w-3xl">
                            <span class="inline-flex rounded-full bg-sky-100 px-3 py-1 text-xs font-semibold uppercase tracking-[0.18em] text-sky-700">
                                Akaun Pengguna
                            </span>
                            <h1 class="mt-4 text-2xl font-bold tracking-tight text-slate-900 sm:text-3xl">Tetapan Profil</h1>
                            <p class="mt-2 text-sm leading-6 text-slate-600 sm:text-base">
                                Urus gambar profil, maklumat akaun, keselamatan kata laluan, dan tetapan penting akaun anda dalam satu halaman yang lebih kemas.
                            </p>
                        </div>

                        <a href="{{ route('dashboard') }}"
                           class="inline-flex items-center justify-center rounded-2xl border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">
                            &larr; Kembali ke Dashboard
                        </a>
                    </div>
                </div>

                <div class="space-y-6 px-4 py-5 sm:px-8 sm:py-8">
                    <div class="grid gap-6 xl:grid-cols-2">
                        <section class="rounded-[24px] border border-slate-200 bg-white p-5 shadow-sm sm:p-6">
                            @include('profile.partials.update-profile-information-form')
                        </section>

                        <section class="rounded-[24px] border border-slate-200 bg-white p-5 shadow-sm sm:p-6">
                            @include('profile.partials.update-password-form')
                        </section>
                    </div>

                    <section class="rounded-[24px] border border-rose-200 bg-gradient-to-br from-rose-50 to-orange-50 p-5 shadow-sm sm:p-6">
                        @include('profile.partials.delete-user-form')
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
