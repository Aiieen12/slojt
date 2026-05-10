<x-app-layout>
    @php
        $statusMeta = [
            'draft' => [
                'label' => 'Draf',
                'mobile' => 'bg-amber-100 text-amber-700',
                'desktop' => 'bg-amber-100 text-amber-700',
            ],
            'completed' => [
                'label' => 'Lengkap',
                'mobile' => 'bg-emerald-100 text-emerald-700',
                'desktop' => 'bg-emerald-100 text-emerald-700',
            ],
        ];
    @endphp

    <div class="max-w-6xl mx-auto py-6 sm:py-8 lg:py-10 px-4">

        <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <p class="text-sm text-gray-500 sm:text-base">Senarai laporan harian latihan industri</p>
            </div>

            <a href="{{ route('daily-logs.create') }}"
               class="inline-flex w-full justify-center rounded-lg bg-blue-600 px-5 py-3 text-white hover:bg-blue-700 sm:w-auto">
                + Tambah Laporan
            </a>
        </div>

        @if(session('success'))
            <div class="mb-4 rounded bg-green-100 p-4 text-green-700">
                {{ session('success') }}
            </div>
        @endif

        <div class="space-y-4 sm:hidden">
                @forelse($logs as $log)
                @php
                    $activities = collect(preg_split('/\r\n|\r|\n/', $log->daily_activity ?? ''))
                        ->map(fn ($activity) => trim($activity))
                        ->filter()
                        ->values();
                @endphp

                <div class="rounded-2xl bg-white p-4 shadow">
                    <div class="mb-4 flex items-start justify-between gap-3">
                        <div>
                            <p class="font-semibold text-gray-900">Hari ke-{{ $log->day_no }}</p>
                            <p class="text-sm text-gray-500">{{ $log->log_date }}</p>
                        </div>

                        @php
                            $status = $statusMeta[$log->status] ?? $statusMeta['completed'];
                        @endphp
                        <span class="rounded-full px-3 py-1 text-xs font-medium {{ $status['mobile'] }}">
                            {{ $status['label'] }}
                        </span>
                    </div>

                    <div class="mb-4">
                        <p class="mb-2 text-sm font-medium text-gray-700">Aktiviti</p>
                        @if($activities->isNotEmpty())
                            <ul class="list-disc list-inside space-y-1 text-sm text-gray-700">
                                @foreach($activities as $activity)
                                    <li>{{ \Illuminate\Support\Str::limit($activity, 70) }}</li>
                                @endforeach
                            </ul>
                        @else
                            <span class="text-sm text-gray-400">Tiada aktiviti direkodkan.</span>
                        @endif
                    </div>

                    <div class="grid grid-cols-1 gap-2">
                        <a href="{{ route('daily-logs.show', $log) }}" class="inline-flex justify-center rounded-lg bg-blue-50 px-4 py-2 text-sm font-medium text-blue-700">
                            Lihat
                        </a>
                        <a href="{{ route('daily-logs.edit', $log) }}" class="inline-flex justify-center rounded-lg bg-yellow-50 px-4 py-2 text-sm font-medium text-yellow-700">
                            Edit
                        </a>
                        <form action="{{ route('daily-logs.destroy', $log) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Padam laporan ini?')" class="w-full rounded-lg bg-red-50 px-4 py-2 text-sm font-medium text-red-700">
                                Padam
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="rounded-2xl bg-white p-6 text-center text-gray-500 shadow">
                    Belum ada laporan harian.
                </div>
            @endforelse
        </div>

        <div class="hidden overflow-x-auto rounded-xl bg-white shadow sm:block">
            <table class="w-full min-w-[760px]">
                <thead class="bg-gray-100 text-left">
                    <tr>
                        <th class="p-4">Hari</th>
                        <th class="p-4">Tarikh</th>
                        <th class="p-4">Aktiviti</th>
                        <th class="p-4">Status</th>
                        <th class="p-4 text-right">Tindakan</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($logs as $log)
                        <tr class="border-t align-top">
                            <td class="p-4">Hari ke-{{ $log->day_no }}</td>
                            <td class="p-4">{{ $log->log_date }}</td>
                            <td class="p-4">
                                @php
                                    $activities = collect(preg_split('/\r\n|\r|\n/', $log->daily_activity ?? ''))
                                        ->map(fn ($activity) => trim($activity))
                                        ->filter()
                                        ->values();
                                @endphp

                                @if($activities->isNotEmpty())
                                    <ul class="list-disc list-inside space-y-1 text-sm text-gray-700">
                                        @foreach($activities as $activity)
                                            <li>{{ \Illuminate\Support\Str::limit($activity, 70) }}</li>
                                        @endforeach
                                    </ul>
                                @else
                                    <span class="text-gray-400">Tiada aktiviti direkodkan.</span>
                                @endif
                            </td>
                            <td class="p-4">
                                @php
                                    $status = $statusMeta[$log->status] ?? $statusMeta['completed'];
                                @endphp
                                <span class="rounded-full px-3 py-1 text-sm {{ $status['desktop'] }}">
                                    {{ $status['label'] }}
                                </span>
                            </td>
                            <td class="p-4">
                                <div class="flex items-center justify-end gap-3 whitespace-nowrap">
                                    <a href="{{ route('daily-logs.show', $log) }}" class="text-blue-600">Lihat</a>
                                    <a href="{{ route('daily-logs.edit', $log) }}" class="text-yellow-600">Edit</a>
                                    <form action="{{ route('daily-logs.destroy', $log) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button onclick="return confirm('Padam laporan ini?')" class="text-red-600">
                                            Padam
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="p-6 text-center text-gray-500">
                                Belum ada laporan harian.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</x-app-layout>
