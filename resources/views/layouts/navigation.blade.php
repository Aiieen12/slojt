<nav x-data="{ open: false }" class="sticky top-0 z-40 border-b border-white/70 bg-white/78 backdrop-blur-2xl">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-20 items-center justify-between gap-4">
            <div class="flex min-w-0 items-center gap-3 lg:gap-10">
                <a href="{{ route('dashboard') }}" class="flex min-w-0 items-center gap-3">
                    <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-white shadow-[0_10px_30px_-12px_rgba(14,165,233,0.35)] ring-1 ring-slate-200/80">
                        <img src="{{ \Illuminate\Support\Facades\Vite::asset('resources/image/logo.png') }}" alt="SLOJT Logo" class="h-9 w-9 object-contain" />
                    </div>

                    <div class="min-w-0">
                        <p class="truncate text-[11px] font-semibold uppercase tracking-[0.24em] text-sky-600">Sistem Laporan</p>
                        <p class="truncate text-sm font-bold tracking-tight text-slate-900 sm:text-base">Latihan Industri</p>
                    </div>
                </a>

                <div class="hidden items-center gap-2 lg:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        Dashboard
                    </x-nav-link>
                    <x-nav-link :href="route('daily-logs.index')" :active="request()->routeIs('daily-logs.*')">
                        Laporan Harian
                    </x-nav-link>
                    <x-nav-link :href="route('ojt.profile.edit')" :active="request()->routeIs('ojt.profile.*')">
                        Profil OJT
                    </x-nav-link>
                    @if(Auth::user()->isAdmin())
                        <x-nav-link :href="route('admin.users.index')" :active="request()->routeIs('admin.users.*')">
                            Pengguna
                        </x-nav-link>
                    @endif
                </div>
            </div>

            <div class="hidden items-center gap-3 lg:flex">

                <x-dropdown align="right" width="56">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center gap-3 rounded-2xl border border-slate-200 bg-white px-3 py-2 text-left shadow-sm transition hover:border-slate-300 hover:bg-slate-50 focus:outline-none">
                            @if(Auth::user()->profile_photo_url)
                                <img src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" class="h-10 w-10 rounded-xl object-cover shadow-sm" data-navbar-profile-photo>
                            @else
                                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-sky-100 text-sm font-bold text-sky-700" data-navbar-profile-fallback>
                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                </div>
                            @endif

                            <div class="hidden xl:block">
                                <div class="text-sm font-semibold text-slate-800">{{ Auth::user()->name }}</div>
                                <div class="text-xs text-slate-500">Pengguna Aktif</div>
                            </div>

                            <svg class="h-4 w-4 text-slate-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 0 1 1.06.02L10 11.168l3.71-3.938a.75.75 0 1 1 1.08 1.04l-4.25 4.5a.75.75 0 0 1-1.08 0l-4.25-4.5a.75.75 0 0 1 .02-1.06Z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="border-b border-slate-100 px-4 py-3">
                            <div class="text-sm font-semibold text-slate-800">{{ Auth::user()->name }}</div>
                            <div class="mt-1 text-xs text-slate-500">{{ Auth::user()->email }}</div>
                        </div>

                        <x-dropdown-link :href="route('profile.edit')">
                            Profil
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                Log Keluar
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <div class="flex items-center gap-2 lg:hidden">
                <a href="{{ route('daily-logs.index') }}"
                   class="inline-flex items-center justify-center rounded-2xl border border-slate-200 bg-white px-3 py-2 text-sm font-semibold text-slate-700 shadow-sm transition hover:bg-slate-50 sm:px-4">
                    Laporan
                </a>

                <button @click="open = ! open" class="inline-flex items-center justify-center rounded-2xl border border-slate-200 bg-white p-3 text-slate-600 shadow-sm transition hover:bg-slate-50 focus:outline-none">
                    <svg class="h-5 w-5" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div :class="{'block': open, 'hidden': ! open}" class="hidden border-t border-slate-200/80 bg-white/95 lg:hidden">
        <div class="space-y-3 px-4 pb-4 pt-4">
            <div class="rounded-2xl border border-slate-200 bg-slate-50 px-4 py-4">
                <div class="flex items-center gap-3">
                    @if(Auth::user()->profile_photo_url)
                        <img src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" class="h-12 w-12 rounded-2xl object-cover shadow-sm" data-navbar-profile-photo>
                    @else
                        <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-sky-100 text-sm font-bold text-sky-700" data-navbar-profile-fallback>
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                    @endif

                    <div class="min-w-0">
                        <div class="truncate text-sm font-semibold text-slate-800">{{ Auth::user()->name }}</div>
                        <div class="mt-1 truncate text-xs text-slate-500">{{ Auth::user()->email }}</div>
                    </div>
                </div>
            </div>

            <div class="grid gap-2">
                <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                    Papan Pemuka
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('daily-logs.index')" :active="request()->routeIs('daily-logs.*')">
                    Laporan Harian
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('ojt.profile.edit')" :active="request()->routeIs('ojt.profile.*')">
                    Profil OJT
                </x-responsive-nav-link>

                @if(Auth::user()->isAdmin())
                    <x-responsive-nav-link :href="route('admin.users.index')" :active="request()->routeIs('admin.users.*')">
                        Pengguna
                    </x-responsive-nav-link>
                @endif

                <x-responsive-nav-link :href="route('profile.edit')" :active="request()->routeIs('profile.edit')">
                    Profil
                </x-responsive-nav-link>
            </div>

            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <x-responsive-nav-link :href="route('logout')"
                    onclick="event.preventDefault(); this.closest('form').submit();">
                    Log Keluar
                </x-responsive-nav-link>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            window.addEventListener('profile-photo-preview-updated', function (event) {
                const previewUrl = event.detail?.url;

                if (!previewUrl) {
                    return;
                }

                const desktopOrMobileImages = document.querySelectorAll('[data-navbar-profile-photo]');
                const fallbackNodes = document.querySelectorAll('[data-navbar-profile-fallback]');

                desktopOrMobileImages.forEach((image) => {
                    image.src = previewUrl;
                });

                fallbackNodes.forEach((fallback) => {
                    const isMobile = fallback.classList.contains('h-12');
                    const img = document.createElement('img');
                    img.src = previewUrl;
                    img.alt = '{{ Auth::user()->name }}';
                    img.className = isMobile
                        ? 'h-12 w-12 rounded-2xl object-cover shadow-sm'
                        : 'h-10 w-10 rounded-xl object-cover shadow-sm';
                    img.setAttribute('data-navbar-profile-photo', '');
                    fallback.replaceWith(img);
                });
            });
        });
    </script>
</nav>
