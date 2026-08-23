<x-app-layout>
    <div class="min-h-screen bg-slate-50/50 py-8">
        <div class="mx-auto max-w-4xl space-y-8 px-6">

            {{-- ================================================= --}}
            {{-- HEADER BANNER --}}
            {{-- ================================================= --}}
            <div class="relative overflow-hidden rounded-[2rem] bg-slate-900 p-8 shadow-2xl shadow-indigo-900/20 md:p-10">

                {{-- Glow --}}
                <div class="absolute -right-24 -top-24 h-64 w-64 rounded-full bg-indigo-500/40 blur-[80px]"></div>
                <div class="absolute -bottom-24 -left-24 h-64 w-64 rounded-full bg-violet-600/30 blur-[80px]"></div>
                <div class="absolute left-1/2 top-1/2 h-32 w-32 -translate-x-1/2 -translate-y-1/2 rounded-full bg-indigo-400/10 blur-3xl"></div>

                <div class="relative z-10 flex flex-col justify-between gap-6 md:flex-row md:items-center">

                    <div>
                        <div class="flex items-center gap-3">
                            <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-indigo-500/20 text-indigo-400 ring-1 ring-indigo-400/20">
                                <svg
                                    class="h-5 w-5"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M12 4v16m8-8H4"
                                    />
                                </svg>
                            </div>

                            <p class="text-xs font-bold uppercase tracking-widest text-indigo-400">
                                Task Management
                            </p>
                        </div>

                        <h1 class="mt-4 text-3xl font-extrabold tracking-tight text-white md:text-4xl">
                            Tambah Task Baru
                        </h1>

                        <p class="mt-3 max-w-xl text-sm leading-relaxed text-slate-400 md:text-base">
                            Catat tugas baru, atur prioritas, kategori, deadline, dan pengingat agar semua aktivitasmu tetap terorganisir.
                        </p>
                    </div>

                    <div class="hidden shrink-0 md:block">
                        <div class="flex h-20 w-20 items-center justify-center rounded-[1.5rem] bg-white/10 text-4xl shadow-inner ring-1 ring-white/10 backdrop-blur-md">
                            ✨
                        </div>
                    </div>

                </div>
            </div>


            {{-- ================================================= --}}
            {{-- NAVIGASI --}}
            {{-- ================================================= --}}
            <div class="flex items-center justify-between">

                <a
                    href="{{ route('tasks.index') }}"
                    class="group inline-flex items-center gap-2 rounded-xl bg-white px-4 py-2.5 text-sm font-semibold text-slate-600 shadow-sm ring-1 ring-slate-200 transition-all duration-300 hover:-translate-x-0.5 hover:bg-slate-50 hover:text-indigo-600 hover:ring-indigo-200"
                >
                    <svg
                        class="h-4 w-4 transition-transform duration-300 group-hover:-translate-x-1"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18"
                        />
                    </svg>

                    Daftar Task
                </a>

                <div class="hidden items-center gap-2 text-xs font-medium text-slate-400 sm:flex">
                    <span class="h-1.5 w-1.5 rounded-full bg-indigo-500"></span>
                    TaskFlow
                    <span>/</span>
                    Tambah Task
                </div>

            </div>


            {{-- ================================================= --}}
            {{-- FORM CARD --}}
            {{-- ================================================= --}}
            <div class="overflow-hidden rounded-[2rem] border border-slate-200/80 bg-white shadow-xl shadow-indigo-900/5">

                {{-- Form Header --}}
                <div class="border-b border-slate-100 bg-gradient-to-r from-indigo-50/70 via-white to-violet-50/50 px-6 py-5 md:px-8">

                    <div class="flex items-center gap-3">

                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-indigo-100 text-indigo-600">
                            <svg
                                class="h-5 w-5"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M12 4v16m8-8H4"
                                />
                            </svg>
                        </div>

                        <div>
                            <h2 class="font-bold text-slate-800">
                                Informasi Task
                            </h2>

                            <p class="text-xs font-medium text-slate-500">
                                Lengkapi informasi tugas yang ingin kamu simpan.
                            </p>
                        </div>

                    </div>

                </div>


                <form action="{{ route('tasks.store') }}" method="POST">
                    @csrf

                    <div class="space-y-7 p-6 md:p-8">

                        {{-- ================================================= --}}
                        {{-- JUDUL --}}
                        {{-- ================================================= --}}
                        <div>
                            <label
                                for="judul"
                                class="mb-2 flex items-center gap-1.5 text-sm font-bold text-slate-700"
                            >
                                <svg
                                    class="h-4 w-4 text-indigo-500"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"
                                    />
                                </svg>

                                Judul Task
                                <span class="text-rose-500">*</span>
                            </label>

                            <input
                                type="text"
                                id="judul"
                                name="judul"
                                value="{{ old('judul') }}"
                                placeholder="Contoh: Mengerjakan laporan PKL"
                                required
                                class="w-full rounded-xl border-slate-200 bg-slate-50/40 px-4 py-3 text-slate-900 placeholder-slate-400 outline-none transition duration-200 focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 @error('judul') border-rose-400 @enderror"
                            >

                            @error('judul')
                                <p class="mt-1.5 flex items-center gap-1 text-xs text-rose-500">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>


                        {{-- ================================================= --}}
                        {{-- DESKRIPSI --}}
                        {{-- ================================================= --}}
                        <div>
                            <label
                                for="deskripsi"
                                class="mb-2 flex items-center gap-1.5 text-sm font-bold text-slate-700"
                            >
                                <svg
                                    class="h-4 w-4 text-indigo-500"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M4 6h16M4 12h16M4 18h7"
                                    />
                                </svg>

                                Deskripsi
                                <span class="text-xs font-normal text-slate-400">
                                    (Opsional)
                                </span>
                            </label>

                            <textarea
                                id="deskripsi"
                                name="deskripsi"
                                rows="4"
                                placeholder="Tuliskan detail atau catatan mengenai task ini..."
                                class="w-full resize-none rounded-xl border-slate-200 bg-slate-50/40 px-4 py-3 text-slate-900 placeholder-slate-400 outline-none transition duration-200 focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 @error('deskripsi') border-rose-400 @enderror"
                            >{{ old('deskripsi') }}</textarea>

                            @error('deskripsi')
                                <p class="mt-1.5 flex items-center gap-1 text-xs text-rose-500">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>


                        {{-- ================================================= --}}
                        {{-- KATEGORI + STATUS --}}
                        {{-- ================================================= --}}
                        <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">

                            <div>
                                <label
                                    for="category_id"
                                    class="mb-2 flex items-center gap-1.5 text-sm font-bold text-slate-700"
                                >
                                    <svg
                                        class="h-4 w-4 text-indigo-500"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="2"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"
                                        />
                                    </svg>

                                    Kategori
                                    <span class="text-rose-500">*</span>
                                </label>

                                <select
                                    id="category_id"
                                    name="category_id"
                                    required
                                    class="w-full rounded-xl border-slate-200 bg-slate-50/40 px-4 py-3 text-slate-900 outline-none transition duration-200 focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 @error('category_id') border-rose-400 @enderror"
                                >
                                    <option value="">Pilih kategori</option>

                                    @foreach($categories as $category)
                                        <option
                                            value="{{ $category->id }}"
                                            {{ old('category_id') == $category->id ? 'selected' : '' }}
                                        >
                                            {{ $category->nama_kategori }}
                                        </option>
                                    @endforeach
                                </select>

                                @error('category_id')
                                    <p class="mt-1.5 text-xs text-rose-500">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>


                            <div>
                                <label
                                    for="status"
                                    class="mb-2 flex items-center gap-1.5 text-sm font-bold text-slate-700"
                                >
                                    <svg
                                        class="h-4 w-4 text-indigo-500"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="2"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0z"
                                        />
                                    </svg>

                                    Status
                                    <span class="text-rose-500">*</span>
                                </label>

                                <select
                                    id="status"
                                    name="status"
                                    required
                                    class="w-full rounded-xl border-slate-200 bg-slate-50/40 px-4 py-3 text-slate-900 outline-none transition duration-200 focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 @error('status') border-rose-400 @enderror"
                                >
                                    <option value="Belum" {{ old('status', 'Belum') === 'Belum' ? 'selected' : '' }}>
                                        Belum
                                    </option>

                                    <option value="Proses" {{ old('status') === 'Proses' ? 'selected' : '' }}>
                                        Proses
                                    </option>

                                    <option value="Selesai" {{ old('status') === 'Selesai' ? 'selected' : '' }}>
                                        Selesai
                                    </option>
                                </select>

                                @error('status')
                                    <p class="mt-1.5 text-xs text-rose-500">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                        </div>


                        {{-- ================================================= --}}
                        {{-- PRIORITAS + DEADLINE --}}
                        {{-- ================================================= --}}
                        <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">

                            <div>
                                <label
                                    for="priority"
                                    class="mb-2 flex items-center gap-1.5 text-sm font-bold text-slate-700"
                                >
                                    <svg
                                        class="h-4 w-4 text-indigo-500"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="2"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 01-2 2zm9-13.5V9"
                                        />
                                    </svg>

                                    Prioritas
                                    <span class="text-rose-500">*</span>
                                </label>

                                <select
                                    id="priority"
                                    name="priority"
                                    required
                                    class="w-full rounded-xl border-slate-200 bg-slate-50/40 px-4 py-3 text-slate-900 outline-none transition duration-200 focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 @error('priority') border-rose-400 @enderror"
                                >
                                    <option value="Rendah" {{ old('priority') === 'Rendah' ? 'selected' : '' }}>
                                        Rendah
                                    </option>

                                    <option value="Sedang" {{ old('priority', 'Sedang') === 'Sedang' ? 'selected' : '' }}>
                                        Sedang
                                    </option>

                                    <option value="Tinggi" {{ old('priority') === 'Tinggi' ? 'selected' : '' }}>
                                        Tinggi
                                    </option>
                                </select>

                                @error('priority')
                                    <p class="mt-1.5 text-xs text-rose-500">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>


                            <div>
                                <label
                                    for="deadline"
                                    class="mb-2 flex items-center gap-1.5 text-sm font-bold text-slate-700"
                                >
                                    <svg
                                        class="h-4 w-4 text-indigo-500"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="2"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"
                                        />
                                    </svg>

                                    Deadline
                                    <span class="text-rose-500">*</span>
                                </label>

                                <input
                                    type="date"
                                    id="deadline"
                                    name="deadline"
                                    value="{{ old('deadline') }}"
                                    class="w-full rounded-xl border-slate-200 bg-slate-50/40 px-4 py-3 text-slate-900 outline-none transition duration-200 focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 @error('deadline') border-rose-400 @enderror"
                                >

                                @error('deadline')
                                    <p class="mt-1.5 text-xs text-rose-500">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                        </div>


                        {{-- ================================================= --}}
                        {{-- PENGINGAT --}}
                        {{-- ================================================= --}}
                        <div>
                            <label
                                for="reminder_days"
                                class="mb-2 flex items-center gap-1.5 text-sm font-bold text-slate-700"
                            >
                                <svg
                                    class="h-4 w-4 text-indigo-500"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6 6 0 10-12 0v3.159c0 .538-.214 1.055-.595 1.436L4 17h5"
                                    />
                                </svg>

                                Pengingat Deadline
                                <span class="text-rose-500">*</span>
                            </label>

                            <select
                                id="reminder_days"
                                name="reminder_days"
                                required
                                class="w-full rounded-xl border-slate-200 bg-slate-50/40 px-4 py-3 text-slate-900 outline-none transition duration-200 focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 @error('reminder_days') border-rose-400 @enderror"
                            >
                                <option value="7" {{ old('reminder_days', 7) == 7 ? 'selected' : '' }}>
                                    H-7 — 1 minggu sebelum deadline
                                </option>

                                <option value="3" {{ old('reminder_days') == 3 ? 'selected' : '' }}>
                                    H-3 — 3 hari sebelum deadline
                                </option>

                                <option value="2" {{ old('reminder_days') == 2 ? 'selected' : '' }}>
                                    H-2 — 2 hari sebelum deadline
                                </option>

                                <option value="1" {{ old('reminder_days') == 1 ? 'selected' : '' }}>
                                    H-1 — 1 hari sebelum deadline
                                </option>
                            </select>

                            <p class="mt-1.5 text-xs text-slate-400">
                                Pilih kapan pengingat deadline akan dikirim.
                            </p>

                            @error('reminder_days')
                                <p class="mt-1.5 text-xs text-rose-500">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                    </div>


                    {{-- ================================================= --}}
                    {{-- FOOTER --}}
                    {{-- ================================================= --}}
                    <div class="flex items-center justify-end gap-3 border-t border-slate-100 bg-slate-50/70 px-6 py-5 md:px-8">

                        <a
                            href="{{ route('tasks.index') }}"
                            class="rounded-xl px-5 py-2.5 text-sm font-semibold text-slate-500 transition-all hover:bg-slate-200/70 hover:text-slate-700"
                        >
                            Batal
                        </a>

                        <button
                            type="submit"
                            class="group inline-flex items-center gap-2 rounded-xl bg-indigo-500 px-6 py-2.5 text-sm font-bold text-white shadow-md shadow-indigo-500/20 transition-all duration-300 hover:-translate-y-0.5 hover:bg-indigo-400 hover:shadow-[0_0_25px_rgba(99,102,241,0.35)] focus:outline-none focus:ring-4 focus:ring-indigo-500/20"
                        >
                            <svg
                                class="h-4 w-4 transition-transform duration-300 group-hover:rotate-90"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2.5"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M12 4v16m8-8H4"
                                />
                            </svg>

                            Simpan Task
                        </button>

                    </div>

                </form>

            </div>

        </div>
    </div>
</x-app-layout>