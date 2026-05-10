<x-app-layout>
    <div class="min-h-screen bg-[radial-gradient(circle_at_top,_rgba(125,211,252,0.16),_transparent_32%),linear-gradient(180deg,_#f8fbff_0%,_#f5f7fb_100%)] py-6 sm:py-8 lg:py-10">
        <div class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8">
            <div class="overflow-hidden rounded-[30px] border border-white/70 bg-white/85 shadow-[0_24px_70px_-34px_rgba(15,23,42,0.22)] backdrop-blur">
                <div class="border-b border-slate-200/80 bg-gradient-to-r from-amber-50 via-white to-orange-50 px-5 py-6 sm:px-8 sm:py-7">
                    <div class="flex flex-col gap-5 lg:flex-row lg:items-start lg:justify-between">
                        <div class="max-w-2xl">
                            <span class="inline-flex rounded-full bg-amber-100 px-3 py-1 text-xs font-semibold uppercase tracking-[0.18em] text-amber-700">
                                Laporan Harian
                            </span>
                            <h1 class="mt-4 text-2xl font-bold tracking-tight text-slate-900 sm:text-3xl">Edit Laporan Harian</h1>
                            <p class="mt-2 text-sm leading-6 text-slate-600 sm:text-base">
                                Kemaskini kandungan laporan anda dengan susun atur yang lebih mudah dibaca dan disemak.
                            </p>
                        </div>

                        <a href="{{ route('daily-logs.index') }}"
                           class="inline-flex items-center justify-center rounded-2xl border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">
                            &larr; Kembali ke Senarai
                        </a>
                    </div>
                </div>

                <form method="POST" action="{{ route('daily-logs.update', $daily_log) }}" enctype="multipart/form-data" class="space-y-6 px-4 py-5 sm:px-8 sm:py-8">
                    @csrf
                    @method('PUT')

                    <div class="rounded-[24px] border {{ $daily_log->status === 'draft' ? 'border-amber-200 bg-amber-50/80 text-amber-800' : 'border-slate-200 bg-slate-50/80 text-slate-700' }} px-4 py-4 text-sm leading-6">
                        {{ $daily_log->status === 'draft'
                            ? 'Laporan ini masih dalam status draf. Anda boleh simpan semula sebagai draf atau terus hantar sebagai laporan lengkap.'
                            : 'Anda boleh terus kemaskini laporan ini, atau simpan semula sebagai draf jika belum lengkap.' }}
                    </div>

                    <section class="rounded-[24px] border border-slate-200 bg-slate-50/70 p-4 sm:p-5">
                        <div class="mb-4">
                            <h2 class="text-lg font-semibold text-slate-900">Maklumat Asas</h2>
                            <p class="mt-1 text-sm text-slate-500">Semak semula hari, tarikh, lokasi, dan jabatan untuk laporan ini.</p>
                        </div>

                        <div class="grid gap-4 md:grid-cols-2">
                            <div>
                                <label class="mb-2 block text-sm font-semibold text-slate-700">Hari Ke-</label>
                                <input type="number" name="day_no" min="1" value="{{ old('day_no', $daily_log->day_no) }}"
                                       class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-slate-800 shadow-sm outline-none transition focus:border-amber-400 focus:ring-4 focus:ring-amber-100">
                                <p class="mt-2 text-xs leading-5 text-slate-500">Tukar nombor hari di sini jika laporan perlu dipindahkan ke hari lain.</p>
                                @error('day_no') <p class="mt-2 text-sm text-red-500">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label class="mb-2 block text-sm font-semibold text-slate-700">Tarikh</label>
                                <input type="date" name="log_date" value="{{ old('log_date', $daily_log->log_date) }}"
                                       class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-slate-800 shadow-sm outline-none transition focus:border-amber-400 focus:ring-4 focus:ring-amber-100">
                            </div>

                            <div>
                                <label class="mb-2 block text-sm font-semibold text-slate-700">Lokasi / Tempat</label>
                                <input type="text" name="location" value="{{ old('location', $daily_log->location) }}"
                                       class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-slate-800 shadow-sm outline-none transition focus:border-amber-400 focus:ring-4 focus:ring-amber-100">
                            </div>

                            <div>
                                <label class="mb-2 block text-sm font-semibold text-slate-700">Jabatan / Unit / Bahagian</label>
                                <input type="text" name="department_unit" value="{{ old('department_unit', $daily_log->department_unit) }}"
                                       class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-slate-800 shadow-sm outline-none transition focus:border-amber-400 focus:ring-4 focus:ring-amber-100">
                            </div>
                        </div>
                    </section>

                    <section class="rounded-[24px] border border-slate-200 bg-white p-4 shadow-sm sm:p-5">
                        <div class="mb-4">
                            <h2 class="text-lg font-semibold text-slate-900">Ringkasan Harian</h2>
                            <p class="mt-1 text-sm text-slate-500">Kemaskini aktiviti, pengetahuan, dan peralatan dalam format yang ringkas dan konsisten.</p>
                        </div>

                        <div class="grid gap-4">
                            <div>
                                <label class="mb-2 block text-sm font-semibold text-slate-700">Ringkasan Aktiviti Harian</label>
                                <textarea name="daily_activity" rows="5" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-slate-800 shadow-sm outline-none transition focus:border-amber-400 focus:bg-white focus:ring-4 focus:ring-amber-100"
                                          placeholder="Menyemak emel dan tugasan harian&#10;Mengemaskini data dalam sistem&#10;Menghadiri mesyuarat bersama penyelia">{{ old('daily_activity', $daily_log->daily_activity) }}</textarea>
                                <p class="mt-2 text-xs leading-5 text-slate-500">Masukkan satu aktiviti bagi setiap baris untuk paparan point.</p>
                            </div>

                            <div class="grid gap-4 lg:grid-cols-2">
                                <div>
                                    <label class="mb-2 block text-sm font-semibold text-slate-700">Pengetahuan / Kemahiran Yang Diperolehi</label>
                                    <textarea name="knowledge_skill" rows="5" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-slate-800 shadow-sm outline-none transition focus:border-emerald-400 focus:bg-white focus:ring-4 focus:ring-emerald-100"
                                              placeholder="Mempelajari aliran kerja jabatan&#10;Menambah kemahiran penggunaan Excel&#10;Memahami proses dokumentasi dalaman">{{ old('knowledge_skill', $daily_log->knowledge_skill) }}</textarea>
                                    <p class="mt-2 text-xs leading-5 text-slate-500">Masukkan satu pengetahuan atau kemahiran bagi setiap baris untuk paparan point.</p>
                                </div>

                                <div>
                                    <label class="mb-2 block text-sm font-semibold text-slate-700">Peralatan / Teknologi Yang Digunakan</label>
                                    <textarea name="tools_technology" rows="5" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-slate-800 shadow-sm outline-none transition focus:border-violet-400 focus:bg-white focus:ring-4 focus:ring-violet-100"
                                              placeholder="Microsoft Excel&#10;Sistem pengurusan dalaman&#10;Google Meet">{{ old('tools_technology', $daily_log->tools_technology) }}</textarea>
                                    <p class="mt-2 text-xs leading-5 text-slate-500">Masukkan satu peralatan atau teknologi bagi setiap baris untuk paparan point.</p>
                                </div>
                            </div>
                        </div>
                    </section>

                    <section class="rounded-[24px] border border-slate-200 bg-white p-4 shadow-sm sm:p-5">
                        <div class="mb-4">
                            <h2 class="text-lg font-semibold text-slate-900">Isu / Gambar / Carta Alir</h2>
                            <p class="mt-1 text-sm text-slate-500">Pilih format tambahan untuk gambaran kerja, isu, atau aliran proses bagi laporan ini.</p>
                        </div>

                        @php
                            $issueType = old('issue_challenge_type', $daily_log->issue_challenge_type ?? 'issue');
                        @endphp

                        <div class="grid gap-3 md:grid-cols-3">
                            <label class="cursor-pointer rounded-2xl border border-slate-200 bg-slate-50 p-4 transition hover:border-amber-300 hover:bg-amber-50/70">
                                <div class="flex items-start gap-3">
                                    <input type="radio" name="issue_challenge_type" value="issue" class="mt-1 shrink-0" {{ $issueType === 'issue' ? 'checked' : '' }}>
                                    <div>
                                        <p class="font-semibold text-slate-800">Isu / Cabaran</p>
                                        <p class="mt-1 text-sm text-slate-500">Rekod cabaran dalam bentuk point yang ringkas.</p>
                                    </div>
                                </div>
                            </label>

                            <label class="cursor-pointer rounded-2xl border border-slate-200 bg-slate-50 p-4 transition hover:border-amber-300 hover:bg-amber-50/70">
                                <div class="flex items-start gap-3">
                                    <input type="radio" name="issue_challenge_type" value="image" class="mt-1 shrink-0" {{ $issueType === 'image' ? 'checked' : '' }}>
                                    <div>
                                        <p class="font-semibold text-slate-800">Muat Naik Gambar</p>
                                        <p class="mt-1 text-sm text-slate-500">Gantikan atau kekalkan gambar sedia ada untuk rujukan.</p>
                                    </div>
                                </div>
                            </label>

                            <label class="cursor-pointer rounded-2xl border border-slate-200 bg-slate-50 p-4 transition hover:border-amber-300 hover:bg-amber-50/70">
                                <div class="flex items-start gap-3">
                                    <input type="radio" name="issue_challenge_type" value="flowchart" class="mt-1 shrink-0" {{ $issueType === 'flowchart' ? 'checked' : '' }}>
                                    <div>
                                        <p class="font-semibold text-slate-800">Carta Alir</p>
                                        <p class="mt-1 text-sm text-slate-500">Kemaskini langkah untuk dijadikan flowchart automatik.</p>
                                    </div>
                                </div>
                            </label>
                        </div>

                        <div id="issue-text-section" class="mt-5">
                            <label class="mb-2 block text-sm font-semibold text-slate-700">Isu / Cabaran</label>
                            <textarea name="issue_challenge" rows="4" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-slate-800 shadow-sm outline-none transition focus:border-rose-400 focus:bg-white focus:ring-4 focus:ring-rose-100"
                                      placeholder="Sukar mendapatkan data lengkap daripada unit lain&#10;Perlu semak semula dokumen sebelum dihantar">{{ old('issue_challenge', $daily_log->issue_challenge) }}</textarea>
                            <p class="mt-2 text-xs leading-5 text-slate-500">Masukkan satu isu atau cabaran bagi setiap baris untuk paparan point.</p>
                        </div>

                        <div id="issue-image-section" class="mt-5">
                            <label class="mb-2 block text-sm font-semibold text-slate-700">Muat Naik Gambar</label>
                            <input type="file" name="issue_challenge_image" accept="image/*"
                                   class="w-full rounded-2xl border border-dashed border-slate-300 bg-slate-50 px-4 py-4 text-sm text-slate-600 shadow-sm outline-none transition file:mr-4 file:rounded-xl file:border-0 file:bg-amber-100 file:px-4 file:py-2 file:font-medium file:text-amber-700 hover:border-amber-300 hover:bg-amber-50">
                            <div class="mt-3 grid gap-3 sm:grid-cols-2">
                                <label class="cursor-pointer rounded-2xl border border-slate-200 bg-white p-4 transition hover:border-amber-300 hover:bg-amber-50/70">
                                    <input type="radio" name="image_source_hint" value="upload" class="sr-only" checked>
                                    <p class="text-sm font-semibold text-slate-800">Pilih dari galeri / fail</p>
                                    <p class="mt-1 text-xs leading-5 text-slate-500">Gunakan pilihan ini jika gambar sudah ada dalam telefon.</p>
                                </label>
                                <label class="cursor-pointer rounded-2xl border border-slate-200 bg-white p-4 transition hover:border-amber-300 hover:bg-amber-50/70">
                                    <input type="radio" name="image_source_hint" value="camera" class="sr-only">
                                    <p class="text-sm font-semibold text-slate-800">Ambil gambar terus</p>
                                    <p class="mt-1 text-xs leading-5 text-slate-500">Pada telefon, browser biasanya akan buka kamera bila pilihan ini dipilih.</p>
                                </label>
                            </div>
                            @if($daily_log->issue_challenge_image_path)
                                <div class="mt-3 rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-600">
                                    Gambar semasa:
                                    <a href="{{ route('daily-logs.issue-image.view', $daily_log) }}" target="_blank" class="font-medium text-blue-600 underline">Lihat</a>
                                    <span class="mx-2 text-slate-300">|</span>
                                    <a href="{{ route('daily-logs.issue-image.download', $daily_log) }}" class="font-medium text-blue-600 underline">Muat Turun</a>
                                </div>
                            @endif
                            <p class="mt-2 text-xs leading-5 text-slate-500">Muat naik gambar baru jika mahu gantikan gambar sedia ada.</p>
                        </div>

                        <div id="flowchart-section" class="mt-5">
                            <label class="mb-2 block text-sm font-semibold text-slate-700">Langkah Carta Alir</label>
                            <textarea name="flowchart_steps" rows="5" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-slate-800 shadow-sm outline-none transition focus:border-amber-400 focus:bg-white focus:ring-4 focus:ring-amber-100"
                                      placeholder="Terima tugasan&#10;Semak dokumen&#10;Kemas kini data&#10;Hantar kepada penyelia">{{ old('flowchart_steps', $daily_log->flowchart_steps) }}</textarea>
                            <p class="mt-2 text-xs leading-5 text-slate-500">Masukkan satu langkah setiap baris. Sistem akan tukarkan kepada carta alir secara automatik.</p>
                        </div>

                        @error('issue_challenge_type') <p class="mt-3 text-sm text-red-500">{{ $message }}</p> @enderror
                        @error('issue_challenge') <p class="mt-3 text-sm text-red-500">{{ $message }}</p> @enderror
                        @error('issue_challenge_image') <p class="mt-3 text-sm text-red-500">{{ $message }}</p> @enderror
                        @error('flowchart_steps') <p class="mt-3 text-sm text-red-500">{{ $message }}</p> @enderror
                    </section>

                    <section class="rounded-[24px] border border-slate-200 bg-white p-4 shadow-sm sm:p-5">
                        <div class="mb-4">
                            <h2 class="text-lg font-semibold text-slate-900">Refleksi Akhir</h2>
                            <p class="mt-1 text-sm text-slate-500">Tambah nota penting, refleksi, atau penyelesaian yang anda capai pada hari tersebut.</p>
                        </div>

                        <label class="mb-2 block text-sm font-semibold text-slate-700">Catatan / Refleksi / Kaedah Penyelesaian</label>
                        <textarea name="reflection_solution" rows="4" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-slate-800 shadow-sm outline-none transition focus:border-slate-400 focus:bg-white focus:ring-4 focus:ring-slate-100">{{ old('reflection_solution', $daily_log->reflection_solution) }}</textarea>
                    </section>

                    <div class="sticky bottom-4 z-10 rounded-[24px] border border-white/80 bg-white/90 p-4 shadow-[0_18px_40px_-28px_rgba(15,23,42,0.3)] backdrop-blur">
                        <div class="flex flex-col-reverse gap-3 sm:flex-row sm:items-center sm:justify-between">
                            <a href="{{ route('daily-logs.index') }}"
                               class="inline-flex items-center justify-center rounded-2xl border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">
                                &larr; Kembali
                            </a>

                            <div class="flex w-full flex-col gap-3 sm:w-auto sm:flex-row">
                                <button type="submit" name="save_action" value="draft" class="inline-flex w-full items-center justify-center rounded-2xl border border-slate-200 bg-slate-100 px-6 py-3.5 text-sm font-semibold text-slate-700 transition hover:-translate-y-0.5 hover:bg-slate-200 sm:w-auto">
                                    Simpan Draf
                                </button>

                                <button type="submit" name="save_action" value="completed" class="inline-flex w-full items-center justify-center rounded-2xl bg-amber-500 px-6 py-3.5 text-sm font-semibold text-white shadow-lg shadow-amber-500/20 transition hover:-translate-y-0.5 hover:bg-amber-600 sm:w-auto">
                                    Hantar Laporan
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const radios = document.querySelectorAll('input[name="issue_challenge_type"]');
            const imageInput = document.querySelector('input[name="issue_challenge_image"]');
            const imageSourceHints = document.querySelectorAll('input[name="image_source_hint"]');
            const sections = {
                issue: document.getElementById('issue-text-section'),
                image: document.getElementById('issue-image-section'),
                flowchart: document.getElementById('flowchart-section'),
            };

            const toggleSections = () => {
                const selected = document.querySelector('input[name="issue_challenge_type"]:checked')?.value || 'issue';

                Object.entries(sections).forEach(([key, section]) => {
                    section.classList.toggle('hidden', key !== selected);
                });
            };

            radios.forEach((radio) => radio.addEventListener('change', toggleSections));
            toggleSections();

            const updateImageCaptureMode = () => {
                const selectedMode = document.querySelector('input[name="image_source_hint"]:checked')?.value || 'upload';

                if (!imageInput) {
                    return;
                }

                if (selectedMode === 'camera') {
                    imageInput.setAttribute('capture', 'environment');
                } else {
                    imageInput.removeAttribute('capture');
                }
            };

            imageSourceHints.forEach((radio) => radio.addEventListener('change', updateImageCaptureMode));
            updateImageCaptureMode();
        });
    </script>
</x-app-layout>
