<x-app-layout>
    @php
        $roleMeta = [
            'admin' => ['label' => 'Admin', 'class' => 'bg-sky-100 text-sky-700'],
            'student' => ['label' => 'Student', 'class' => 'bg-emerald-100 text-emerald-700'],
        ];
    @endphp

    <div class="min-h-screen bg-[radial-gradient(circle_at_top,_rgba(125,211,252,0.16),_transparent_32%),linear-gradient(180deg,_#f8fbff_0%,_#f5f7fb_100%)] py-6 sm:py-8 lg:py-10">
        <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
            <div class="mb-6 overflow-hidden rounded-[28px] border border-white/70 bg-white/85 shadow-[0_24px_70px_-34px_rgba(15,23,42,0.22)] backdrop-blur">
                <div class="flex flex-col gap-4 border-b border-slate-200/80 bg-gradient-to-r from-sky-50 via-white to-cyan-50 px-5 py-6 sm:px-8 sm:py-7 lg:flex-row lg:items-center lg:justify-between">
                    <div class="max-w-2xl">
                        <span class="inline-flex rounded-full bg-sky-100 px-3 py-1 text-xs font-semibold uppercase tracking-[0.18em] text-sky-700">
                            Admin
                        </span>
                        <h1 class="mt-4 text-2xl font-bold tracking-tight text-slate-900 sm:text-3xl">Pengurusan Pengguna</h1>
                        <p class="mt-2 text-sm leading-6 text-slate-600 sm:text-base">
                            Tambah pengguna baru dan tetapkan semula kata laluan pelajar dengan pantas.
                        </p>
                    </div>

                    <a href="{{ route('admin.users.create') }}"
                       class="inline-flex items-center justify-center rounded-2xl bg-slate-900 px-5 py-3 text-sm font-semibold text-white shadow-lg shadow-slate-900/20 transition hover:-translate-y-0.5 hover:bg-slate-800">
                        + Tambah User
                    </a>
                </div>

                <div class="px-4 py-5 sm:px-8 sm:py-8">
                    @if(session('success'))
                        <div class="mb-5 rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="space-y-4 sm:hidden">
                        @forelse($users as $user)
                            @php
                                $role = $roleMeta[$user->role] ?? $roleMeta['student'];
                            @endphp

                            <div class="rounded-[24px] border border-slate-200 bg-white p-4 shadow-sm">
                                <div class="flex items-start justify-between gap-3">
                                    <div>
                                        <p class="text-base font-semibold text-slate-900">{{ $user->name }}</p>
                                        <p class="mt-1 text-sm text-slate-500">{{ $user->email }}</p>
                                    </div>

                                    <span class="rounded-full px-3 py-1 text-xs font-semibold {{ $role['class'] }}">
                                        {{ $role['label'] }}
                                    </span>
                                </div>

                                <div class="mt-4">
                                    <a href="{{ route('admin.users.password.edit', $user) }}"
                                       class="inline-flex w-full items-center justify-center rounded-2xl bg-amber-50 px-4 py-3 text-sm font-semibold text-amber-700 transition hover:bg-amber-100">
                                        Reset Password
                                    </a>
                                </div>
                            </div>
                        @empty
                            <div class="rounded-[24px] border border-slate-200 bg-white p-6 text-center text-sm text-slate-500 shadow-sm">
                                Belum ada pengguna direkodkan.
                            </div>
                        @endforelse
                    </div>

                    <div class="hidden overflow-hidden rounded-[24px] border border-slate-200 bg-white shadow-sm sm:block">
                        <div class="overflow-x-auto">
                            <table class="min-w-full">
                                <thead class="bg-slate-50 text-left text-sm font-semibold text-slate-600">
                                    <tr>
                                        <th class="px-5 py-4">Nama</th>
                                        <th class="px-5 py-4">Email</th>
                                        <th class="px-5 py-4">Role</th>
                                        <th class="px-5 py-4 text-right">Tindakan</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-200">
                                    @forelse($users as $user)
                                        @php
                                            $role = $roleMeta[$user->role] ?? $roleMeta['student'];
                                        @endphp

                                        <tr class="align-top">
                                            <td class="px-5 py-4 font-medium text-slate-900">{{ $user->name }}</td>
                                            <td class="px-5 py-4 text-slate-600">{{ $user->email }}</td>
                                            <td class="px-5 py-4">
                                                <span class="rounded-full px-3 py-1 text-xs font-semibold {{ $role['class'] }}">
                                                    {{ $role['label'] }}
                                                </span>
                                            </td>
                                            <td class="px-5 py-4 text-right">
                                                <a href="{{ route('admin.users.password.edit', $user) }}"
                                                   class="inline-flex items-center justify-center rounded-xl bg-amber-50 px-4 py-2 text-sm font-semibold text-amber-700 transition hover:bg-amber-100">
                                                    Reset Password
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="px-5 py-8 text-center text-sm text-slate-500">
                                                Belum ada pengguna direkodkan.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
