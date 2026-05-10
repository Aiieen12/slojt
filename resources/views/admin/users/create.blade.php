<x-app-layout>
    <div class="min-h-screen bg-[radial-gradient(circle_at_top,_rgba(125,211,252,0.16),_transparent_32%),linear-gradient(180deg,_#f8fbff_0%,_#f5f7fb_100%)] py-6 sm:py-8 lg:py-10">
        <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">
            <div class="overflow-hidden rounded-[28px] border border-white/70 bg-white/85 shadow-[0_24px_70px_-34px_rgba(15,23,42,0.22)] backdrop-blur">
                <div class="border-b border-slate-200/80 bg-gradient-to-r from-sky-50 via-white to-cyan-50 px-5 py-6 sm:px-8 sm:py-7">
                    <div class="flex flex-col gap-5 lg:flex-row lg:items-start lg:justify-between">
                        <div class="max-w-2xl">
                            <span class="inline-flex rounded-full bg-sky-100 px-3 py-1 text-xs font-semibold uppercase tracking-[0.18em] text-sky-700">
                                Admin
                            </span>
                            <h1 class="mt-4 text-2xl font-bold tracking-tight text-slate-900 sm:text-3xl">Tambah User Baru</h1>
                            <p class="mt-2 text-sm leading-6 text-slate-600 sm:text-base">
                                Daftarkan akaun baru untuk admin atau student dengan maklumat asas sahaja.
                            </p>
                        </div>

                        <a href="{{ route('admin.users.index') }}"
                           class="inline-flex items-center justify-center rounded-2xl border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">
                            &larr; Kembali ke Senarai
                        </a>
                    </div>
                </div>

                <form method="POST" action="{{ route('admin.users.store') }}" class="space-y-6 px-4 py-5 sm:px-8 sm:py-8">
                    @csrf

                    <section class="rounded-[24px] border border-slate-200 bg-white p-4 shadow-sm sm:p-5">
                        <div class="mb-4">
                            <h2 class="text-lg font-semibold text-slate-900">Maklumat Pengguna</h2>
                            <p class="mt-1 text-sm text-slate-500">Isi nama, email, kata laluan, dan jenis peranan pengguna.</p>
                        </div>

                        <div class="grid gap-4 md:grid-cols-2">
                            <div class="md:col-span-2">
                                <label class="mb-2 block text-sm font-semibold text-slate-700">Nama</label>
                                <input type="text" name="name" value="{{ old('name') }}"
                                       class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-slate-800 shadow-sm outline-none transition focus:border-sky-400 focus:bg-white focus:ring-4 focus:ring-sky-100">
                                @error('name') <p class="mt-2 text-sm text-red-500">{{ $message }}</p> @enderror
                            </div>

                            <div class="md:col-span-2">
                                <label class="mb-2 block text-sm font-semibold text-slate-700">Email</label>
                                <input type="email" name="email" value="{{ old('email') }}"
                                       class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-slate-800 shadow-sm outline-none transition focus:border-sky-400 focus:bg-white focus:ring-4 focus:ring-sky-100">
                                @error('email') <p class="mt-2 text-sm text-red-500">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label class="mb-2 block text-sm font-semibold text-slate-700">Password</label>
                                <input type="password" name="password"
                                       class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-slate-800 shadow-sm outline-none transition focus:border-sky-400 focus:bg-white focus:ring-4 focus:ring-sky-100">
                                @error('password') <p class="mt-2 text-sm text-red-500">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label class="mb-2 block text-sm font-semibold text-slate-700">Confirm Password</label>
                                <input type="password" name="password_confirmation"
                                       class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-slate-800 shadow-sm outline-none transition focus:border-sky-400 focus:bg-white focus:ring-4 focus:ring-sky-100">
                            </div>

                            <div class="md:col-span-2">
                                <label class="mb-2 block text-sm font-semibold text-slate-700">Role</label>
                                <select name="role"
                                        class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-slate-800 shadow-sm outline-none transition focus:border-sky-400 focus:bg-white focus:ring-4 focus:ring-sky-100">
                                    <option value="student" {{ old('role', 'student') === 'student' ? 'selected' : '' }}>student</option>
                                    <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>admin</option>
                                </select>
                                @error('role') <p class="mt-2 text-sm text-red-500">{{ $message }}</p> @enderror
                            </div>
                        </div>
                    </section>

                    <div class="sticky bottom-4 z-10 rounded-[24px] border border-white/80 bg-white/90 p-4 shadow-[0_18px_40px_-28px_rgba(15,23,42,0.3)] backdrop-blur">
                        <div class="flex flex-col-reverse gap-3 sm:flex-row sm:items-center sm:justify-between">
                            <a href="{{ route('admin.users.index') }}"
                               class="inline-flex items-center justify-center rounded-2xl border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">
                                &larr; Kembali
                            </a>

                            <button type="submit" class="inline-flex w-full items-center justify-center rounded-2xl bg-slate-900 px-6 py-3.5 text-sm font-semibold text-white shadow-lg shadow-slate-900/20 transition hover:-translate-y-0.5 hover:bg-slate-800 sm:w-auto">
                                Simpan User
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
