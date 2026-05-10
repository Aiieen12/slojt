<section>
    <header>
        <h2 class="text-lg font-semibold text-slate-900">
            Maklumat Profil
        </h2>

        <p class="mt-1 text-sm leading-6 text-slate-500">
            Kemas kini maklumat profil dan alamat e-mel akaun anda.
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="profile_photo" :value="'Gambar Profil'" />

            <div class="mt-4 flex flex-col gap-4 sm:flex-row sm:items-center">
                @if($user->profile_photo_url)
                    <img src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}" class="h-20 w-20 rounded-[22px] object-cover shadow-sm" data-profile-photo-preview>
                @else
                    <div class="flex h-20 w-20 items-center justify-center rounded-[22px] bg-sky-100 text-xl font-bold text-sky-700 shadow-sm" data-profile-photo-fallback>
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                @endif

                <div class="flex-1">
                    <input id="profile_photo" name="profile_photo" type="file" accept="image/*"
                        class="block w-full rounded-2xl border border-slate-200 bg-slate-50 px-3 py-3 text-sm text-slate-600 file:mr-4 file:rounded-xl file:border-0 file:bg-sky-100 file:px-4 file:py-2.5 file:font-medium file:text-sky-700 hover:file:bg-sky-200"
                        data-profile-photo-input>

                    @if($user->profile_photo_url)
                        <label for="remove_profile_photo" class="mt-3 inline-flex items-center gap-2 text-sm text-slate-600">
                            <input id="remove_profile_photo" name="remove_profile_photo" type="checkbox" value="1" class="rounded border-slate-300 text-sky-600 focus:ring-sky-500">
                            <span>Buang gambar semasa</span>
                        </label>
                    @endif
                </div>
            </div>

            <x-input-error class="mt-2" :messages="$errors->get('profile_photo')" />
            <x-input-error class="mt-2" :messages="$errors->get('remove_profile_photo')" />
        </div>

        <div class="hidden rounded-[24px] border border-slate-200 bg-slate-50 p-4 sm:p-5" data-profile-photo-editor>
            <div class="mb-4 flex items-center justify-between gap-3">
                <div>
                    <p class="text-sm font-semibold text-slate-800">Laraskan Gambar Profil</p>
                    <p class="text-xs text-slate-500">Seret gambar dan gunakan zum supaya muka atau subjek muat dengan kemas dalam bingkai.</p>
                </div>
                <button type="button" class="rounded-xl border border-slate-200 bg-white px-3 py-2 text-xs font-medium text-slate-600 hover:bg-slate-100" data-profile-photo-reset>
                    Tetapkan Semula
                </button>
            </div>

            <div class="flex flex-col gap-4 lg:flex-row lg:items-center">
                <div class="relative h-64 w-full max-w-[260px] overflow-hidden rounded-[28px] border border-slate-200 bg-white shadow-sm" data-profile-photo-frame>
                    <img src="" alt="Editor gambar profil" class="absolute left-0 top-0 max-w-none select-none touch-none" draggable="false" data-profile-photo-editor-image>
                    <div class="pointer-events-none absolute inset-0 rounded-[28px] ring-1 ring-inset ring-black/5"></div>
                </div>

                <div class="flex-1 space-y-4">
                    <div>
                        <label class="mb-2 block text-sm font-medium text-slate-700">Zum</label>
                        <input type="range" min="1" max="3" step="0.01" value="1" class="w-full accent-sky-600" data-profile-photo-zoom>
                    </div>

                    <div class="flex flex-col gap-2 sm:flex-row">
                        <button type="button" class="inline-flex items-center justify-center rounded-2xl bg-sky-600 px-4 py-2.5 text-sm font-semibold text-white hover:bg-sky-700" data-profile-photo-apply>
                            Gunakan Potongan Ini
                        </button>
                        <p class="text-xs leading-5 text-slate-500">Selepas digunakan, gambar yang telah dipotong ini akan disimpan apabila anda menekan butang simpan profil.</p>
                    </div>
                </div>
            </div>
        </div>

        <div>
            <x-input-label for="name" :value="'Nama'" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full rounded-2xl border-slate-200 bg-slate-50 px-4 py-3 text-slate-800 shadow-sm focus:border-sky-400 focus:ring-sky-100" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="'E-mel'" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full rounded-2xl border-slate-200 bg-slate-50 px-4 py-3 text-slate-800 shadow-sm focus:border-sky-400 focus:ring-sky-100" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="mt-2 text-sm text-slate-700">
                        Alamat e-mel anda belum disahkan.

                        <button form="send-verification" class="rounded-md text-sm text-sky-600 underline hover:text-sky-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-sky-500">
                            Klik di sini untuk hantar semula e-mel pengesahan.
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 text-sm font-medium text-emerald-600">
                            Pautan pengesahan baharu telah dihantar ke alamat e-mel anda.
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex flex-col gap-3 sm:flex-row sm:items-center">
            <x-primary-button>Simpan</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >Berjaya disimpan.</p>
            @endif
        </div>
    </form>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const input = document.querySelector('[data-profile-photo-input]');
        const editor = document.querySelector('[data-profile-photo-editor]');
        const image = document.querySelector('[data-profile-photo-editor-image]');
        const frame = document.querySelector('[data-profile-photo-frame]');
        const zoomInput = document.querySelector('[data-profile-photo-zoom]');
        const applyButton = document.querySelector('[data-profile-photo-apply]');
        const resetButton = document.querySelector('[data-profile-photo-reset]');
        const previewImage = document.querySelector('[data-profile-photo-preview]');
        const fallbackPreview = document.querySelector('[data-profile-photo-fallback]');

        if (!input || !editor || !image || !frame || !zoomInput || !applyButton || !resetButton) {
            return;
        }

        let originalImage = null;
        let state = {
            scale: 1,
            minScale: 1,
            x: 0,
            y: 0,
            dragging: false,
            startX: 0,
            startY: 0,
            startOffsetX: 0,
            startOffsetY: 0,
        };

        const clampOffsets = () => {
            if (!originalImage) {
                return;
            }

            const frameSize = frame.clientWidth;
            const scaledWidth = originalImage.width * state.scale;
            const scaledHeight = originalImage.height * state.scale;

            const minX = Math.min(0, frameSize - scaledWidth);
            const minY = Math.min(0, frameSize - scaledHeight);

            state.x = Math.min(0, Math.max(minX, state.x));
            state.y = Math.min(0, Math.max(minY, state.y));
        };

        const renderImage = () => {
            if (!originalImage) {
                return;
            }

            clampOffsets();
            image.style.width = `${originalImage.width * state.scale}px`;
            image.style.height = `${originalImage.height * state.scale}px`;
            image.style.transform = `translate(${state.x}px, ${state.y}px)`;
        };

        const resetEditor = () => {
            if (!originalImage) {
                return;
            }

            const frameSize = frame.clientWidth;
            state.minScale = Math.max(frameSize / originalImage.width, frameSize / originalImage.height);
            state.scale = state.minScale;
            zoomInput.min = state.minScale.toFixed(2);
            zoomInput.max = Math.max(state.minScale, 3).toFixed(2);
            zoomInput.value = state.scale.toFixed(2);

            state.x = (frameSize - (originalImage.width * state.scale)) / 2;
            state.y = (frameSize - (originalImage.height * state.scale)) / 2;

            renderImage();
        };

        const openEditor = (file) => {
            const reader = new FileReader();

            reader.onload = (event) => {
                const tempImage = new Image();
                tempImage.onload = () => {
                    originalImage = tempImage;
                    image.src = event.target.result;
                    editor.classList.remove('hidden');
                    resetEditor();
                };
                tempImage.src = event.target.result;
            };

            reader.readAsDataURL(file);
        };

        input.addEventListener('change', function (event) {
            const file = event.target.files?.[0];

            if (!file) {
                return;
            }

            openEditor(file);
        });

        zoomInput.addEventListener('input', function () {
            if (!originalImage) {
                return;
            }

            const previousScale = state.scale;
            const frameSize = frame.clientWidth;
            const centerX = (frameSize / 2) - state.x;
            const centerY = (frameSize / 2) - state.y;

            state.scale = parseFloat(zoomInput.value);

            state.x = (frameSize / 2) - ((centerX / previousScale) * state.scale);
            state.y = (frameSize / 2) - ((centerY / previousScale) * state.scale);

            renderImage();
        });

        const startDrag = (clientX, clientY) => {
            state.dragging = true;
            state.startX = clientX;
            state.startY = clientY;
            state.startOffsetX = state.x;
            state.startOffsetY = state.y;
        };

        const moveDrag = (clientX, clientY) => {
            if (!state.dragging) {
                return;
            }

            state.x = state.startOffsetX + (clientX - state.startX);
            state.y = state.startOffsetY + (clientY - state.startY);
            renderImage();
        };

        const endDrag = () => {
            state.dragging = false;
        };

        frame.addEventListener('mousedown', (event) => {
            event.preventDefault();
            startDrag(event.clientX, event.clientY);
        });

        window.addEventListener('mousemove', (event) => moveDrag(event.clientX, event.clientY));
        window.addEventListener('mouseup', endDrag);

        frame.addEventListener('touchstart', (event) => {
            const touch = event.touches[0];
            if (!touch) {
                return;
            }
            startDrag(touch.clientX, touch.clientY);
        }, { passive: true });

        window.addEventListener('touchmove', (event) => {
            const touch = event.touches[0];
            if (!touch) {
                return;
            }
            moveDrag(touch.clientX, touch.clientY);
        }, { passive: true });

        window.addEventListener('touchend', endDrag);

        resetButton.addEventListener('click', resetEditor);

        applyButton.addEventListener('click', function () {
            if (!originalImage) {
                return;
            }

            const frameSize = frame.clientWidth;
            const canvasSize = 512;
            const canvas = document.createElement('canvas');
            canvas.width = canvasSize;
            canvas.height = canvasSize;

            const context = canvas.getContext('2d');
            const cropX = Math.max(0, (-state.x) / state.scale);
            const cropY = Math.max(0, (-state.y) / state.scale);
            const cropSize = frameSize / state.scale;

            context.drawImage(
                originalImage,
                cropX,
                cropY,
                cropSize,
                cropSize,
                0,
                0,
                canvasSize,
                canvasSize
            );

            canvas.toBlob((blob) => {
                if (!blob) {
                    return;
                }

                const file = new File([blob], 'profile-photo.png', { type: 'image/png' });
                const dataTransfer = new DataTransfer();
                dataTransfer.items.add(file);
                input.files = dataTransfer.files;

                const previewUrl = URL.createObjectURL(blob);

                if (previewImage) {
                    previewImage.src = previewUrl;
                } else if (fallbackPreview) {
                    const img = document.createElement('img');
                    img.src = previewUrl;
                    img.alt = 'Pratonton profil';
                    img.className = 'h-16 w-16 rounded-2xl object-cover shadow-sm';
                    fallbackPreview.replaceWith(img);
                    img.setAttribute('data-profile-photo-preview', '');
                }

                window.dispatchEvent(new CustomEvent('profile-photo-preview-updated', {
                    detail: { url: previewUrl }
                }));
            }, 'image/png');
        });
    });
</script>
