<x-app-layout>
    <div class="min-h-screen bg-[radial-gradient(circle_at_top,_rgba(125,211,252,0.16),_transparent_32%),linear-gradient(180deg,_#f8fbff_0%,_#f5f7fb_100%)] py-6 sm:py-8 lg:py-10">
        <div class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8">
            <div class="overflow-hidden rounded-[30px] border border-white/70 bg-white/85 shadow-[0_24px_70px_-34px_rgba(15,23,42,0.22)] backdrop-blur">
                <div class="border-b border-slate-200/80 bg-gradient-to-r from-sky-50 via-white to-cyan-50 px-5 py-6 sm:px-8 sm:py-7">
                    <div class="flex flex-col gap-5 lg:flex-row lg:items-start lg:justify-between">
                        <div class="max-w-2xl">
                            <span class="inline-flex rounded-full bg-sky-100 px-3 py-1 text-xs font-semibold uppercase tracking-[0.18em] text-sky-700">
                                Profil OJT
                            </span>
                            <h1 class="mt-4 text-2xl font-bold tracking-tight text-slate-900 sm:text-3xl">Maklumat Profil OJT</h1>
                            <p class="mt-2 text-sm leading-6 text-slate-600 sm:text-base">
                                Lengkapkan butiran syarikat, jabatan, dan tempoh latihan industri supaya dashboard serta progress OJT dipaparkan dengan lebih tepat.
                            </p>
                        </div>

                        <a href="{{ route('dashboard') }}"
                           class="inline-flex items-center justify-center rounded-2xl border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">
                            &larr; Kembali ke Dashboard
                        </a>
                    </div>
                </div>

                <div class="px-4 py-5 sm:px-8 sm:py-8">
                    @if(session('success'))
                        <div class="mb-6 rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-4 text-sm font-medium text-emerald-700">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('ojt.profile.update') }}" class="space-y-6">
                        @csrf

                        <section class="rounded-[24px] border border-slate-200 bg-slate-50/70 p-4 sm:p-5">
                            <div class="mb-4">
                                <h2 class="text-lg font-semibold text-slate-900">Maklumat Penempatan</h2>
                                <p class="mt-1 text-sm text-slate-500">Butiran asas tentang tempat anda menjalani latihan industri.</p>
                            </div>

                            <div class="grid gap-4 md:grid-cols-2">
                                <div class="md:col-span-2">
                                    <label class="mb-2 block text-sm font-semibold text-slate-700">Nama Syarikat / Organisasi</label>
                                    <input type="text" name="company_name"
                                        value="{{ old('company_name', $profile->company_name) }}"
                                        class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-slate-800 shadow-sm outline-none transition focus:border-sky-400 focus:ring-4 focus:ring-sky-100">
                                    @error('company_name') <p class="mt-2 text-sm text-red-500">{{ $message }}</p> @enderror
                                </div>

                                <div class="md:col-span-2">
                                    <label class="mb-2 block text-sm font-semibold text-slate-700">Jabatan / Unit / Bahagian</label>
                                    <input type="text" name="department"
                                        value="{{ old('department', $profile->department) }}"
                                        class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-slate-800 shadow-sm outline-none transition focus:border-sky-400 focus:ring-4 focus:ring-sky-100">
                                    @error('department') <p class="mt-2 text-sm text-red-500">{{ $message }}</p> @enderror
                                </div>
                            </div>
                        </section>

                        <section class="rounded-[24px] border border-slate-200 bg-white p-4 shadow-sm sm:p-5">
                            <div class="mb-4">
                                <h2 class="text-lg font-semibold text-slate-900">Tempoh OJT</h2>
                                <p class="mt-1 text-sm text-slate-500">Tarikh ini digunakan untuk pengiraan progress OJT pada dashboard.</p>
                            </div>

                            <div class="grid gap-4 md:grid-cols-2">
                                <div>
                                    <label class="mb-2 block text-sm font-semibold text-slate-700">Tarikh Mula</label>
                                    <input type="date" name="start_date"
                                        value="{{ old('start_date', $profile->start_date) }}"
                                        class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-slate-800 shadow-sm outline-none transition focus:border-sky-400 focus:bg-white focus:ring-4 focus:ring-sky-100">
                                    @error('start_date') <p class="mt-2 text-sm text-red-500">{{ $message }}</p> @enderror
                                </div>

                                <div>
                                    <label class="mb-2 block text-sm font-semibold text-slate-700">Tarikh Tamat</label>
                                    <input type="date" name="end_date"
                                        value="{{ old('end_date', $profile->end_date) }}"
                                        class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-slate-800 shadow-sm outline-none transition focus:border-sky-400 focus:bg-white focus:ring-4 focus:ring-sky-100">
                                    @error('end_date') <p class="mt-2 text-sm text-red-500">{{ $message }}</p> @enderror
                                </div>
                            </div>

                            <div class="mt-4 rounded-2xl border border-sky-100 bg-sky-50 px-4 py-4 text-sm leading-6 text-sky-800">
                                Pastikan tempoh OJT diisi dengan betul supaya peratus kemajuan pada dashboard dipaparkan secara tepat.
                            </div>
                        </section>

                        <div class="sticky bottom-4 z-10 rounded-[24px] border border-white/80 bg-white/90 p-4 shadow-[0_18px_40px_-28px_rgba(15,23,42,0.3)] backdrop-blur">
                            <div class="flex flex-col-reverse gap-3 sm:flex-row sm:items-center sm:justify-between">
                                <a href="{{ route('dashboard') }}"
                                   class="inline-flex items-center justify-center rounded-2xl border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">
                                    &larr; Batal
                                </a>

                                <button class="inline-flex w-full items-center justify-center rounded-2xl bg-sky-600 px-6 py-3.5 text-sm font-semibold text-white shadow-lg shadow-sky-600/20 transition hover:-translate-y-0.5 hover:bg-sky-700 sm:w-auto">
                                    Simpan Profil
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
