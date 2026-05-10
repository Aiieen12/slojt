<x-app-layout>
    @php
        $totalUsers = \App\Models\User::count();
        $totalStudents = \App\Models\User::where('role', 'student')->count();
        $totalAdmins = \App\Models\User::where('role', 'admin')->count();

        $recentUsers = \App\Models\User::orderByDesc('created_at')->take(5)->get();

        $summaryCards = [
            [
                'title' => 'Jumlah Pengguna',
                'value' => $totalUsers,
                'icon' => 'M17 20h5V10a2 2 0 0 0-2-2h-3m-4 12H7m10 0v-6a2 2 0 0 0-2-2h-2a2 2 0 0 0-2 2v6m4 0H7m0 0H2V10a2 2 0 0 1 2-2h3m0 0V6a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v2M7 8h10',
                'accent' => 'from-sky-500 to-cyan-400',
                'soft' => 'bg-sky-50 text-sky-700',
            ],
            [
                'title' => 'Jumlah Student',
                'value' => $totalStudents,
                'icon' => 'M15 19.128a9.38 9.38 0 0 0 2.625.372M15 19.128v-.037a6.008 6.008 0 0 0-.817-3.057m0 0A5.98 5.98 0 0 0 12 15c-1.125 0-2.177.31-3.076.853m6.259.181a5.98 5.98 0 0 1 .817 3.057m0 0A9.7 9.7 0 0 1 12 21a9.7 9.7 0 0 1-4.183-.91m0 0a6.008 6.008 0 0 1 .817-3.057m0 0A5.98 5.98 0 0 1 12 15m0 0a5.98 5.98 0 0 1 3.366 1.034M12 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8Z',
                'accent' => 'from-emerald-500 to-teal-400',
                'soft' => 'bg-emerald-50 text-emerald-700',
            ],
            [
                'title' => 'Jumlah Admin',
                'value' => $totalAdmins,
                'icon' => 'M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 0h10.5A2.25 2.25 0 0 1 19.5 12.75v6A2.25 2.25 0 0 1 17.25 21h-10.5A2.25 2.25 0 0 1 4.5 18.75v-6A2.25 2.25 0 0 1 6.75 10.5Z',
                'accent' => 'from-violet-500 to-fuchsia-400',
                'soft' => 'bg-violet-50 text-violet-700',
            ],
        ];
    @endphp

    <div class="min-h-screen bg-[radial-gradient(circle_at_top,_rgba(125,211,252,0.18),_transparent_32%),linear-gradient(180deg,_#f8fbff_0%,_#f4f7fb_100%)] py-6 sm:py-8 lg:py-10">
        <div class="mx-auto flex max-w-7xl flex-col gap-6 px-4 sm:px-6 lg:px-8">
            <section class="overflow-hidden rounded-[28px] border border-white/60 bg-white/80 px-5 py-6 shadow-[0_18px_60px_-24px_rgba(15,23,42,0.18)] backdrop-blur sm:px-8 sm:py-8">
                <div class="flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">
                    <div class="max-w-3xl">
                        <span class="inline-flex rounded-full bg-sky-100 px-3 py-1 text-xs font-semibold uppercase tracking-[0.18em] text-sky-700">
                            Pentadbir SLOJT
                        </span>
                        <h1 class="mt-4 text-3xl font-bold tracking-tight text-slate-900 sm:text-4xl">
                            Papan Pemuka Admin
                        </h1>
                        <p class="mt-3 text-sm leading-7 text-slate-600 sm:text-base">
                            Urus akaun pengguna dengan ringkas. Admin hanya digunakan untuk tambah pengguna baru dan tetapkan semula kata laluan.
                        </p>
                    </div>

                    <div class="flex flex-col gap-3 sm:flex-row">
                        <a href="{{ route('admin.users.create') }}"
                           class="inline-flex items-center justify-center rounded-2xl bg-slate-900 px-6 py-3.5 text-base font-semibold text-white shadow-lg shadow-slate-900/20 transition duration-200 hover:-translate-y-0.5 hover:bg-slate-800">
                            + Tambah User
                        </a>
                        <a href="{{ route('admin.users.index') }}"
                           class="inline-flex items-center justify-center rounded-2xl border border-slate-200 bg-white px-6 py-3.5 text-base font-semibold text-slate-700 transition duration-200 hover:-translate-y-0.5 hover:bg-slate-50">
                            Urus Pengguna
                        </a>
                    </div>
                </div>
            </section>

            <section class="grid gap-4 sm:grid-cols-2 xl:grid-cols-3">
                @foreach($summaryCards as $card)
                    <div class="group rounded-[24px] border border-white/70 bg-white/85 p-5 shadow-[0_14px_40px_-24px_rgba(15,23,42,0.2)] backdrop-blur transition duration-200 hover:-translate-y-1 hover:shadow-[0_22px_50px_-24px_rgba(15,23,42,0.28)]">
                        <div class="flex items-start justify-between gap-4">
                            <div>
                                <p class="text-sm font-medium text-slate-500">{{ $card['title'] }}</p>
                                <p class="mt-3 text-3xl font-bold tracking-tight text-slate-900">{{ $card['value'] }}</p>
                            </div>

                            <div class="inline-flex h-12 w-12 items-center justify-center rounded-2xl bg-gradient-to-br {{ $card['accent'] }} text-white shadow-md">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="{{ $card['icon'] }}" />
                                </svg>
                            </div>
                        </div>

                        <div class="mt-4">
                            <span class="inline-flex rounded-full px-3 py-1 text-xs font-medium {{ $card['soft'] }}">
                                Ringkasan semasa
                            </span>
                        </div>
                    </div>
                @endforeach
            </section>

            <section class="grid gap-6 xl:grid-cols-[minmax(0,1.5fr)_minmax(320px,1fr)]">
                <div class="rounded-[28px] border border-white/60 bg-white/88 p-4 shadow-[0_18px_50px_-26px_rgba(15,23,42,0.18)] backdrop-blur sm:p-6">
                    <div class="mb-5 flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
                        <div>
                            <h3 class="text-xl font-semibold text-slate-900">Pengguna Terkini</h3>
                            <p class="text-sm text-slate-500">5 akaun terbaru yang didaftarkan dalam sistem.</p>
                        </div>

                        <a href="{{ route('admin.users.index') }}"
                           class="inline-flex items-center rounded-xl border border-slate-200 bg-slate-50 px-4 py-2 text-sm font-medium text-slate-700 transition hover:bg-slate-100">
                            Lihat Semua User
                        </a>
                    </div>

                    <div class="overflow-hidden rounded-2xl border border-slate-200">
                        <div class="hidden bg-slate-50 px-5 py-3 text-sm font-semibold text-slate-600 md:grid md:grid-cols-[minmax(0,1fr)_minmax(0,1fr)_120px] md:gap-4">
                            <div>Nama</div>
                            <div>Email</div>
                            <div>Role</div>
                        </div>

                        <div class="divide-y divide-slate-200 bg-white">
                            @forelse($recentUsers as $user)
                                <div class="px-4 py-4 md:grid md:grid-cols-[minmax(0,1fr)_minmax(0,1fr)_120px] md:items-center md:gap-4 md:px-5">
                                    <div class="text-sm font-semibold text-slate-800">{{ $user->name }}</div>
                                    <div class="mt-2 text-sm text-slate-600 md:mt-0">{{ $user->email }}</div>
                                    <div class="mt-3 md:mt-0">
                                        <span class="inline-flex rounded-full px-3 py-1 text-xs font-semibold {{ $user->role === 'admin' ? 'bg-sky-100 text-sky-700' : 'bg-emerald-100 text-emerald-700' }}">
                                            {{ $user->role === 'admin' ? 'Admin' : 'Student' }}
                                        </span>
                                    </div>
                                </div>
                            @empty
                                <div class="px-5 py-10 text-center text-sm text-slate-500">
                                    Belum ada pengguna direkodkan.
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <div class="flex flex-col gap-6">
                    <section class="rounded-[28px] border border-amber-100 bg-gradient-to-br from-amber-50 to-orange-50 p-5 shadow-[0_18px_50px_-26px_rgba(251,146,60,0.28)] sm:p-6">
                        <div class="flex items-start gap-4">
                            <div class="inline-flex h-12 w-12 items-center justify-center rounded-2xl bg-white text-amber-500 shadow-sm">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v4m0 4h.01M10.29 3.86 1.82 18a2 2 0 0 0 1.72 3h16.92a2 2 0 0 0 1.72-3L13.71 3.86a2 2 0 0 0-3.42 0Z" />
                                </svg>
                            </div>

                            <div>
                                <h3 class="text-lg font-semibold text-slate-900">Nota Admin</h3>
                                <p class="mt-2 text-sm leading-7 text-slate-600">
                                    Akses admin dihadkan kepada pengurusan pengguna sahaja. Gunakan menu ini untuk tambah pengguna baru dan bantu pengguna yang perlu reset kata laluan.
                                </p>
                            </div>
                        </div>
                    </section>

                    <section class="rounded-[28px] border border-white/60 bg-white/88 p-5 shadow-[0_18px_50px_-26px_rgba(15,23,42,0.18)] backdrop-blur sm:p-6">
                        <h3 class="text-xl font-semibold text-slate-900">Tindakan Cepat</h3>
                        <div class="mt-5 grid gap-3">
                            <a href="{{ route('admin.users.create') }}"
                               class="inline-flex items-center justify-center rounded-2xl bg-slate-900 px-4 py-3 text-sm font-semibold text-white transition hover:bg-slate-800">
                                Tambah User Baru
                            </a>
                            <a href="{{ route('admin.users.index') }}"
                               class="inline-flex items-center justify-center rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-100">
                                Buka Senarai User
                            </a>
                        </div>
                    </section>
                </div>
            </section>
        </div>
    </div>
</x-app-layout>
