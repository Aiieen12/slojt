<x-app-layout>
    <div class="max-w-6xl mx-auto py-6 sm:py-8 lg:py-10 px-4">
        @php
            $statusMeta = $daily_log->status === 'draft'
                ? ['label' => 'Draf', 'class' => 'bg-amber-100 text-amber-700']
                : ['label' => 'Lengkap', 'class' => 'bg-emerald-100 text-emerald-700'];

            $dailyActivities = collect(preg_split('/\r\n|\r|\n/', $daily_log->daily_activity ?? ''))
                ->map(fn ($item) => trim($item))
                ->filter()
                ->values();

            $knowledgeSkills = collect(preg_split('/\r\n|\r|\n/', $daily_log->knowledge_skill ?? ''))
                ->map(fn ($item) => trim($item))
                ->filter()
                ->values();

            $toolsTechnologies = collect(preg_split('/\r\n|\r|\n/', $daily_log->tools_technology ?? ''))
                ->map(fn ($item) => trim($item))
                ->filter()
                ->values();

            $issueChallenges = collect(preg_split('/\r\n|\r|\n/', $daily_log->issue_challenge ?? ''))
                ->map(fn ($item) => trim($item))
                ->filter()
                ->values();

            $flowchartSteps = collect(preg_split('/\r\n|\r|\n/', $daily_log->flowchart_steps ?? ''))
                ->map(fn ($item) => trim($item))
                ->filter()
                ->values();

            $imageUrl = $daily_log->issue_challenge_image_path
                ? route('daily-logs.issue-image.view', $daily_log)
                : null;
        @endphp

        <div class="overflow-hidden rounded-[28px] border border-slate-200 bg-gradient-to-br from-white via-slate-50 to-sky-50 shadow-sm">
            <div class="border-b border-slate-200 px-4 py-5 sm:px-8 sm:py-6">
                <div class="flex flex-col gap-4 lg:flex-row lg:items-start lg:justify-between">
                    <div class="space-y-3">
                        <div class="flex flex-wrap items-center gap-2 text-sm">
                            <span class="rounded-full bg-sky-100 px-3 py-1 font-medium text-sky-700">Hari ke-{{ $daily_log->day_no }}</span>
                            <span class="rounded-full bg-slate-100 px-3 py-1 font-medium text-slate-600">{{ $daily_log->log_date }}</span>
                            <span class="rounded-full px-3 py-1 font-medium {{ $statusMeta['class'] }}">{{ $statusMeta['label'] }}</span>
                        </div>

                        <div>
                            <h1 class="text-2xl font-bold tracking-tight text-slate-900 sm:text-3xl">Laporan Harian</h1>
                            <p class="mt-1 text-sm leading-6 text-slate-500 sm:text-base">Paparan ringkas yang mudah dibaca untuk telefon dan desktop.</p>
                        </div>
                    </div>

                    <div class="flex flex-col gap-2 sm:flex-row">
                        <a href="{{ route('daily-logs.edit', $daily_log) }}"
                           class="inline-flex items-center justify-center rounded-xl bg-amber-500 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-amber-600">
                            Edit Laporan
                        </a>
                        <a href="{{ route('daily-logs.index') }}"
                           class="inline-flex items-center justify-center rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">
                            Kembali
                        </a>
                    </div>
                </div>
            </div>

            <div class="grid gap-4 p-4 sm:gap-5 sm:p-6 lg:grid-cols-2">
                <section class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                    <p class="text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">Lokasi</p>
                    <p class="mt-2 text-base font-medium text-slate-800">{{ $daily_log->location ?? '-' }}</p>
                </section>

                <section class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                    <p class="text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">Jabatan</p>
                    <p class="mt-2 text-base font-medium text-slate-800">{{ $daily_log->department_unit ?? '-' }}</p>
                </section>

                <section class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                    <p class="text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">Aktiviti Harian</p>
                    @if($dailyActivities->isNotEmpty())
                        <ul class="mt-3 space-y-2 text-sm leading-6 text-slate-700">
                            @foreach($dailyActivities as $activity)
                                <li class="flex gap-3">
                                    <span class="mt-2 h-2 w-2 shrink-0 rounded-full bg-sky-500"></span>
                                    <span>{{ $activity }}</span>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="mt-3 text-sm text-slate-400">-</p>
                    @endif
                </section>

                <section class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                    <p class="text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">Pengetahuan / Kemahiran</p>
                    @if($knowledgeSkills->isNotEmpty())
                        <ul class="mt-3 space-y-2 text-sm leading-6 text-slate-700">
                            @foreach($knowledgeSkills as $knowledgeSkill)
                                <li class="flex gap-3">
                                    <span class="mt-2 h-2 w-2 shrink-0 rounded-full bg-emerald-500"></span>
                                    <span>{{ $knowledgeSkill }}</span>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="mt-3 text-sm text-slate-400">-</p>
                    @endif
                </section>

                <section class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                    <p class="text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">Peralatan / Teknologi</p>
                    @if($toolsTechnologies->isNotEmpty())
                        <ul class="mt-3 space-y-2 text-sm leading-6 text-slate-700">
                            @foreach($toolsTechnologies as $toolTechnology)
                                <li class="flex gap-3">
                                    <span class="mt-2 h-2 w-2 shrink-0 rounded-full bg-violet-500"></span>
                                    <span>{{ $toolTechnology }}</span>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="mt-3 text-sm text-slate-400">-</p>
                    @endif
                </section>

                <section class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                    <p class="text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">Refleksi / Penyelesaian</p>
                    <p class="mt-3 whitespace-pre-line text-sm leading-6 text-slate-700">{{ $daily_log->reflection_solution ?? '-' }}</p>
                </section>

                <section class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm lg:col-span-2">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">Gambarajah / Carta Alir / Isu / Cabaran</p>
                        <p class="mt-1 text-sm text-slate-500">Paparan disesuaikan ikut jenis kandungan yang dipilih.</p>
                    </div>

                    @if(($daily_log->issue_challenge_type ?? 'issue') === 'image' && $imageUrl)
                        <div class="mt-4 flex justify-center">
                            <div class="group relative w-full max-w-[280px] overflow-hidden rounded-2xl border border-slate-200 bg-slate-100 shadow-sm sm:max-w-[320px]">
                                <img src="{{ $imageUrl }}"
                                     alt="Gambar isu atau cabaran"
                                     class="h-48 w-full object-cover sm:h-56">

                                <div class="absolute inset-0 flex items-center justify-center bg-slate-900/45 transition group-hover:bg-slate-900/55">
                                    <div class="flex w-full max-w-[180px] flex-col gap-2 px-4">
                                        <button type="button"
                                                data-image-preview-open
                                                class="rounded-xl bg-white px-4 py-2 text-sm font-semibold text-slate-800 shadow-sm transition hover:bg-slate-100">
                                            Lihat
                                        </button>
                                        <a href="{{ route('daily-logs.issue-image.download', $daily_log) }}"
                                           class="rounded-xl bg-sky-600 px-4 py-2 text-center text-sm font-semibold text-white shadow-sm transition hover:bg-sky-700">
                                            Muat Turun
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @elseif(($daily_log->issue_challenge_type ?? 'issue') === 'flowchart')
                        @if($flowchartSteps->isNotEmpty())
                            <div class="mt-4 flex flex-col items-center gap-3">
                                @foreach($flowchartSteps as $step)
                                    <div class="w-full max-w-[260px] rounded-2xl border border-sky-200 bg-sky-50 px-4 py-3 text-center text-sm font-medium leading-5 text-slate-700 shadow-sm">
                                        {{ $step }}
                                    </div>

                                    @if(! $loop->last)
                                        <div class="text-lg font-bold text-sky-400">&darr;</div>
                                    @endif
                                @endforeach
                            </div>
                        @else
                            <p class="mt-4 text-sm text-slate-400">-</p>
                        @endif
                    @elseif($issueChallenges->isNotEmpty())
                        <ul class="mt-4 space-y-2 text-sm leading-6 text-slate-700">
                            @foreach($issueChallenges as $issueChallenge)
                                <li class="flex gap-3">
                                    <span class="mt-2 h-2 w-2 shrink-0 rounded-full bg-rose-500"></span>
                                    <span>{{ $issueChallenge }}</span>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="mt-4 text-sm text-slate-400">-</p>
                    @endif
                </section>
            </div>
        </div>
    </div>

    @if($imageUrl)
        <div id="image-preview-modal" class="fixed inset-0 z-50 hidden">
            <div class="absolute inset-0 bg-slate-950/80" data-image-preview-close></div>

            <div class="relative flex min-h-full items-center justify-center p-4">
                <div class="w-full max-w-4xl rounded-3xl bg-white p-3 shadow-2xl sm:p-4">
                    <div class="mb-3 flex flex-col gap-3 px-2 sm:flex-row sm:items-center sm:justify-between">
                        <p class="text-sm font-semibold text-slate-700">Pratonton Gambar</p>
                        <div class="flex flex-col gap-2 sm:flex-row sm:items-center">
                            <a href="{{ route('daily-logs.issue-image.download', $daily_log) }}"
                               class="rounded-xl bg-sky-600 px-4 py-2 text-center text-sm font-semibold text-white transition hover:bg-sky-700">
                                Muat Turun
                            </a>
                            <button type="button"
                                    data-image-preview-close
                                    class="rounded-xl border border-slate-200 px-4 py-2 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">
                                Tutup
                            </button>
                        </div>
                    </div>

                    <img src="{{ $imageUrl }}" alt="Pratonton gambar isu atau cabaran" class="max-h-[75vh] w-full rounded-2xl bg-slate-100 object-contain">
                </div>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const modal = document.getElementById('image-preview-modal');
                const openButton = document.querySelector('[data-image-preview-open]');
                const closeButtons = document.querySelectorAll('[data-image-preview-close]');

                if (!modal || !openButton) {
                    return;
                }

                const closeModal = () => {
                    modal.classList.add('hidden');
                    document.body.classList.remove('overflow-hidden');
                };

                openButton.addEventListener('click', function () {
                    modal.classList.remove('hidden');
                    document.body.classList.add('overflow-hidden');
                });

                closeButtons.forEach((button) => {
                    button.addEventListener('click', closeModal);
                });

                document.addEventListener('keydown', function (event) {
                    if (event.key === 'Escape') {
                        closeModal();
                    }
                });
            });
        </script>
    @endif
</x-app-layout>
