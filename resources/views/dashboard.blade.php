<x-app-layout>

    @php
        $userId = auth()->id();
        $today = \Illuminate\Support\Carbon::today();
        $weekStart = $today->copy()->startOfWeek();
        $weekEnd = $today->copy()->endOfWeek();
        $monthStart = $today->copy()->startOfMonth();
        $monthEnd = $today->copy()->endOfMonth();

        $logs = \App\Models\DailyLog::where('user_id', $userId)
            ->orderByDesc('log_date')
            ->orderByDesc('id')
            ->get();

        $recentLogs = $logs->take(5);
        $totalLogs = $logs->count();
        $monthlyLogs = $logs->filter(fn ($log) => $log->log_date >= $monthStart->toDateString() && $log->log_date <= $monthEnd->toDateString())->count();
        $weeklyLogs = $logs->filter(fn ($log) => $log->log_date >= $weekStart->toDateString() && $log->log_date <= $weekEnd->toDateString())->count();
        $draftLogs = $logs->where('status', 'draft')->count();

        $profile = \App\Models\OjtProfile::where('user_id', $userId)->first();
        $startDate = $profile?->start_date ? \Illuminate\Support\Carbon::parse($profile->start_date) : null;
        $endDate = $profile?->end_date ? \Illuminate\Support\Carbon::parse($profile->end_date) : null;

        $progressPercentage = 0;
        $ojtPeriodLabel = 'Belum ditetapkan';

        if ($startDate && $endDate) {
            $ojtPeriodLabel = $startDate->format('d M Y') . ' - ' . $endDate->format('d M Y');

            if ($today->lessThanOrEqualTo($startDate)) {
                $progressPercentage = 0;
            } elseif ($today->greaterThanOrEqualTo($endDate)) {
                $progressPercentage = 100;
            } else {
                $totalDays = max($startDate->diffInDays($endDate), 1);
                $elapsedDays = $startDate->diffInDays($today);
                $progressPercentage = (int) round(($elapsedDays / $totalDays) * 100);
            }
        }

        $summaryCards = [
            [
                'title' => 'Jumlah Laporan',
                'value' => $totalLogs,
                'icon' => 'M9 5H7a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V9m-4-4h4m0 0v4m0-4L10 14',
                'accent' => 'from-sky-500 to-cyan-400',
                'soft' => 'bg-sky-50 text-sky-700',
            ],
            [
                'title' => 'Laporan Bulan Ini',
                'value' => $monthlyLogs,
                'icon' => 'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2Z',
                'accent' => 'from-emerald-500 to-teal-400',
                'soft' => 'bg-emerald-50 text-emerald-700',
            ],
            [
                'title' => 'Laporan Minggu Ini',
                'value' => $weeklyLogs,
                'icon' => 'M16 8v8m-4-5v5M8 13v3m-3 5h14a2 2 0 0 0 2-2V5a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2Z',
                'accent' => 'from-violet-500 to-fuchsia-400',
                'soft' => 'bg-violet-50 text-violet-700',
            ],
            [
                'title' => 'Draf / Belum Lengkap',
                'value' => $draftLogs,
                'icon' => 'M12 8v4l3 3m6-3a9 9 0 1 1-18 0a9 9 0 0 1 18 0Z',
                'accent' => 'from-amber-500 to-orange-400',
                'soft' => 'bg-amber-50 text-amber-700',
            ],
        ];
    @endphp

    <div class="min-h-screen bg-[radial-gradient(circle_at_top,_rgba(125,211,252,0.18),_transparent_32%),linear-gradient(180deg,_#f8fbff_0%,_#f4f7fb_100%)] py-6 sm:py-8 lg:py-10">
        <div class="mx-auto flex max-w-7xl flex-col gap-6 px-4 sm:px-6 lg:px-8">
            <section class="overflow-hidden rounded-[28px] border border-white/60 bg-white/80 px-5 py-6 shadow-[0_18px_60px_-24px_rgba(15,23,42,0.18)] backdrop-blur sm:px-8 sm:py-8">
                <div class="flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">
                    <div class="max-w-2xl">
                        <span class="inline-flex rounded-full bg-sky-100 px-3 py-1 text-xs font-semibold uppercase tracking-[0.18em] text-sky-700">
                            Sistem Laporan OJT
                        </span>
                        <h1 class="mt-4 text-3xl font-bold tracking-tight text-slate-900 sm:text-4xl">
                            Selamat Datang ke Dashboard SLOJT
                        </h1>
                        <p class="mt-3 text-sm leading-7 text-slate-600 sm:text-base">
                            Urus dan pantau laporan harian OJT anda dengan mudah. Lihat ringkasan penting, semak perkembangan semasa, dan tambah laporan baru dengan lebih pantas.
                        </p>
                    </div>

                    <div class="flex flex-col gap-3 sm:flex-row">
                        <a href="{{ route('daily-logs.create') }}"
                           class="inline-flex items-center justify-center rounded-2xl bg-slate-900 px-6 py-3.5 text-base font-semibold text-white shadow-lg shadow-slate-900/20 transition duration-200 hover:-translate-y-0.5 hover:bg-slate-800">
                            + Tambah Laporan Harian
                        </a>
                    </div>
                </div>
            </section>

            <section class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
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

            <section class="grid gap-6 xl:grid-cols-[minmax(0,1.7fr)_minmax(300px,1fr)]">
                <div class="rounded-[28px] border border-white/60 bg-white/88 p-4 shadow-[0_18px_50px_-26px_rgba(15,23,42,0.18)] backdrop-blur sm:p-6">
                    <div class="mb-5 flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
                        <div>
                            <h3 class="text-xl font-semibold text-slate-900">Laporan Terkini</h3>
                            <p class="text-sm text-slate-500">5 laporan terbaru untuk rujukan pantas.</p>
                        </div>

                        <a href="{{ route('daily-logs.index') }}"
                           class="inline-flex items-center rounded-xl border border-slate-200 bg-slate-50 px-4 py-2 text-sm font-medium text-slate-700 transition hover:bg-slate-100">
                            Lihat Semua
                        </a>
                    </div>

                    <div class="overflow-hidden rounded-2xl border border-slate-200">
                        <div class="hidden bg-slate-50 px-5 py-3 text-sm font-semibold text-slate-600 md:grid md:grid-cols-[140px_minmax(0,1fr)_120px_160px] md:gap-4">
                            <div>Tarikh</div>
                            <div>Tajuk Aktiviti</div>
                            <div>Status</div>
                            <div class="text-right">Tindakan</div>
                        </div>

                        <div class="divide-y divide-slate-200 bg-white">
                            @forelse($recentLogs as $log)
                                @php
                                    $activityTitle = collect(preg_split('/\r\n|\r|\n/', $log->daily_activity ?? ''))
                                        ->map(fn ($item) => trim($item))
                                        ->filter()
                                        ->first() ?? 'Tiada aktiviti';
                                @endphp

                                <div class="px-4 py-4 md:grid md:grid-cols-[140px_minmax(0,1fr)_120px_160px] md:items-center md:gap-4 md:px-5">
                                    <div class="text-sm font-medium text-slate-700">{{ $log->log_date }}</div>

                                    <div class="mt-2 text-sm leading-6 text-slate-600 md:mt-0">
                                        {{ \Illuminate\Support\Str::limit($activityTitle, 60) }}
                                    </div>

                                    <div class="mt-3 md:mt-0">
                                        <span class="inline-flex rounded-full px-3 py-1 text-xs font-semibold {{ $log->status === 'draft' ? 'bg-amber-100 text-amber-700' : 'bg-emerald-100 text-emerald-700' }}">
                                            {{ $log->status === 'draft' ? 'Draf' : 'Lengkap' }}
                                        </span>
                                    </div>

                                    <div class="mt-4 flex gap-2 md:mt-0 md:justify-end">
                                        <a href="{{ route('daily-logs.show', $log) }}"
                                           class="inline-flex flex-1 items-center justify-center rounded-xl bg-sky-50 px-3 py-2 text-sm font-medium text-sky-700 transition hover:bg-sky-100 md:flex-none">
                                            Lihat
                                        </a>
                                        <a href="{{ route('daily-logs.edit', $log) }}"
                                           class="inline-flex flex-1 items-center justify-center rounded-xl bg-slate-100 px-3 py-2 text-sm font-medium text-slate-700 transition hover:bg-slate-200 md:flex-none">
                                            Kemaskini
                                        </a>
                                    </div>
                                </div>
                            @empty
                                <div class="px-5 py-10 text-center text-sm text-slate-500">
                                    Belum ada laporan harian direkodkan.
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <div class="flex flex-col gap-6">
                    <section class="order-1 rounded-[28px] border border-amber-100 bg-gradient-to-br from-amber-50 to-orange-50 p-5 shadow-[0_18px_50px_-26px_rgba(251,146,60,0.28)] sm:p-6 xl:order-2">
                        <div class="flex items-start gap-4">
                            <div class="inline-flex h-12 w-12 items-center justify-center rounded-2xl bg-white text-amber-500 shadow-sm">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v4m0 4h.01M10.29 3.86 1.82 18a2 2 0 0 0 1.72 3h16.92a2 2 0 0 0 1.72-3L13.71 3.86a2 2 0 0 0-3.42 0Z" />
                                </svg>
                            </div>

                            <div>
                                <h3 class="text-lg font-semibold text-slate-900">Peringatan / Nota Ringkas</h3>
                                <p class="mt-2 text-sm leading-7 text-slate-600">
                                    Jangan lupa kemaskini laporan harian sebelum tamat waktu kerja.
                                </p>
                            </div>
                        </div>
                    </section>

                    <section class="order-2 rounded-[28px] border border-white/60 bg-white/88 p-5 shadow-[0_18px_50px_-26px_rgba(15,23,42,0.18)] backdrop-blur sm:p-6 xl:order-1">
                        <div class="flex items-start justify-between gap-4">
                            <div>
                                <h3 class="text-xl font-semibold text-slate-900">Progress OJT</h3>
                                <p class="mt-1 text-sm text-slate-500">Pemantauan kemajuan latihan industri semasa.</p>
                            </div>

                            <div class="inline-flex h-12 w-12 items-center justify-center rounded-2xl bg-gradient-to-br from-sky-500 to-indigo-500 text-white shadow-md">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.5 9 8l4 4 8-7.5M21 21H3" />
                                </svg>
                            </div>
                        </div>

                        <div class="mt-6 space-y-4">
                            <div class="rounded-2xl bg-slate-50 p-4">
                                <p class="text-xs font-semibold uppercase tracking-[0.18em] text-slate-400">Tempoh OJT</p>
                                <p class="mt-2 text-base font-semibold text-slate-800">{{ $ojtPeriodLabel }}</p>
                                @if($profile?->company_name)
                                    <p class="mt-2 text-sm text-slate-500">{{ $profile->company_name }}{{ $profile->department ? ' • ' . $profile->department : '' }}</p>
                                @endif
                            </div>

                            <div>
                                <div class="mb-2 flex items-center justify-between text-sm">
                                    <span class="font-medium text-slate-600">Kemajuan Semasa</span>
                                    <span class="font-semibold text-slate-900">{{ $progressPercentage }}%</span>
                                </div>

                                <div class="h-3 overflow-hidden rounded-full bg-slate-200">
                                    <div class="h-full rounded-full bg-gradient-to-r from-sky-500 via-cyan-400 to-emerald-400 shadow-[0_6px_20px_-8px_rgba(14,165,233,0.8)]" style="width: {{ $progressPercentage }}%"></div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </section>
        </div>
    </div>
</x-app-layout>
