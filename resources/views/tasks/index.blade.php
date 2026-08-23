<x-app-layout>

    @php
        $tasks = $tasks ?? collect();

        // Penambahan kategori yang terlihat di gambar agar tidak fallback ke abu-abu
        $categoryStyles = [
            'Sekolah' => 'bg-indigo-50 text-indigo-700 border border-indigo-100',
            'Proyek' => 'bg-violet-50 text-violet-700 border border-violet-100',
            'Pribadi' => 'bg-teal-50 text-teal-700 border border-teal-100',
            'PKL (Praktik Kerja Lapangan)' => 'bg-sky-50 text-sky-700 border border-sky-100',
            'Nganu' => 'bg-slate-50 text-slate-700 border border-slate-200',
        ];

        $priorityStyles = [
            'Rendah' => [
                'dot' => 'bg-emerald-500 shadow-[0_0_4px_#10b981]',
                'text' => 'text-emerald-700',
                'bg' => 'bg-emerald-50 border border-emerald-100',
            ],
            'Sedang' => [
                'dot' => 'bg-amber-500 shadow-[0_0_4px_#f59e0b]',
                'text' => 'text-amber-700',
                'bg' => 'bg-amber-50 border border-amber-100',
            ],
            'Tinggi' => [
                'dot' => 'bg-rose-500 shadow-[0_0_4px_#f43f5e]',
                'text' => 'text-rose-700',
                'bg' => 'bg-rose-50 border border-rose-100',
            ],
        ];
    @endphp


    <div class="min-h-screen bg-slate-50/50 py-8">

        <div class="mx-auto max-w-7xl space-y-8 px-6">


            {{-- ===================================================== --}}
            {{-- NAVIGASI --}}
            {{-- ===================================================== --}}

            <div class="flex items-center justify-between gap-4">

                {{-- Kembali ke Dashboard --}}
                <a
                    href="{{ route('dashboard') }}"
                    class="group inline-flex items-center gap-2 rounded-xl bg-white px-4 py-2.5 text-sm font-semibold text-gray-600 shadow-sm ring-1 ring-gray-200 transition-all duration-300 hover:bg-gray-50 hover:text-indigo-600 hover:ring-indigo-200"
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
                            d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"
                        />
                    </svg>

                    Dashboard

                </a>


             {{-- Tambah Task --}}
<a
    href="{{ route('tasks.create') }}"
    class="group inline-flex items-center gap-2 rounded-2xl bg-indigo-500 px-5 py-3 text-sm font-semibold text-white shadow-sm transition-all duration-300 hover:-translate-y-0.5 hover:bg-indigo-400 hover:shadow-[0_0_30px_rgba(99,102,241,0.35)]"
>
    <svg
        class="h-4 w-4 transition-transform duration-300 group-hover:rotate-90"
        fill="none"
        stroke="currentColor"
        stroke-width="2"
        viewBox="0 0 24 24"
    >
        <path
            stroke-linecap="round"
            stroke-linejoin="round"
            d="M12 4.5v15m7.5-7.5h-15"
        />
    </svg>

    Tambah Task
</a>

            </div>


{{-- ===================================================== --}}
{{-- HEADER HALAMAN --}}
{{-- ===================================================== --}}

<div class="relative overflow-hidden rounded-[2rem] bg-slate-900 p-8 shadow-2xl shadow-indigo-900/20 md:p-10">

    {{-- Glow kanan atas --}}
    <div class="absolute -right-24 -top-24 h-64 w-64 rounded-full bg-indigo-500/40 blur-[80px] transition-opacity duration-500 hover:opacity-70"></div>

    {{-- Glow kiri bawah --}}
    <div class="absolute -bottom-24 -left-24 h-64 w-64 rounded-full bg-violet-600/30 blur-[80px]"></div>

    {{-- Glow tengah --}}
    <div class="absolute left-1/2 top-1/2 h-40 w-40 -translate-x-1/2 -translate-y-1/2 rounded-full bg-indigo-500/10 blur-[70px]"></div>


    <div class="relative z-10 flex flex-col justify-between gap-6 md:flex-row md:items-center">

        <div>

            <p class="text-xs font-bold uppercase tracking-widest text-indigo-400">
                Task Management
            </p>

            <h1 class="mt-2 text-3xl font-extrabold tracking-tight text-white md:text-4xl">
                Daftar Task
            </h1>

            <p class="mt-4 max-w-xl text-sm leading-relaxed text-slate-400 md:text-base">
                Pantau, edit, dan kelola seluruh tugasmu agar pekerjaan tetap teratur dan tidak ada deadline yang terlewat.
            </p>

        </div>


        {{-- Icon --}}
        <div class="hidden shrink-0 md:flex">

            <div class="flex h-20 w-20 items-center justify-center rounded-3xl border border-white/10 bg-white/5 text-4xl shadow-inner backdrop-blur-md">
                📋
            </div>

        </div>

    </div>

</div>


            {{-- ===================================================== --}}
            {{-- PESAN SUKSES --}}
            {{-- ===================================================== --}}

            @if (session('success'))

                <div class="animate-fade-in-down flex items-center gap-3 rounded-2xl border border-emerald-200 bg-emerald-50 px-5 py-4 text-emerald-800 shadow-sm">

                    <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-emerald-500 text-white shadow-sm shadow-emerald-200">

                        <svg
                            class="h-5 w-5"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2.5"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M5 13l4 4L19 7"
                            />
                        </svg>

                    </div>

                    <p class="text-sm font-semibold">
                        {{ session('success') }}
                    </p>

                </div>

            @endif


            {{-- ===================================================== --}}
            {{-- RINGKASAN --}}
            {{-- ===================================================== --}}

            <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-end">

                <div>

                    <h3 class="text-xl font-bold text-gray-900">
                        Semua Tugas
                    </h3>

                    <p class="mt-1 text-sm text-gray-500">
                        Berikut daftar tugas yang tersimpan di TaskFlow.
                    </p>

                </div>


                <div class="inline-flex w-fit items-center gap-2.5 rounded-full bg-white px-4 py-2 text-sm font-semibold text-gray-700 shadow-sm ring-1 ring-gray-200">

                    <span class="relative flex h-2.5 w-2.5">
                        <span class="absolute inline-flex h-full w-full animate-ping rounded-full bg-indigo-400 opacity-75"></span>
                        <span class="relative inline-flex h-2.5 w-2.5 rounded-full bg-indigo-500"></span>
                    </span>

                    {{ $tasks->count() }} task

                </div>

            </div>


            {{-- ===================================================== --}}
            {{-- DAFTAR TASK --}}
            {{-- ===================================================== --}}

            <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">


                {{-- Header daftar --}}
                <div class="flex items-center justify-between border-b border-gray-100 bg-gray-50/50 px-6 py-5">

                    <div class="flex items-center gap-4">

                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-white text-indigo-600 shadow-sm ring-1 ring-gray-200">

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
                                    d="M9 12h6m-6 4h6M9 8h1m5 12H7a2 2 0 01-2-2V6a2 2 0 012-2h5.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V18a2 2 0 01-2 2z"
                                />
                            </svg>

                        </div>


                        <div>

                            <h3 class="font-bold text-gray-800">
                                Daftar Tugas
                            </h3>

                            <p class="text-xs font-medium text-gray-500">
                                Kelola tugas yang sedang berjalan
                            </p>

                        </div>

                    </div>


                    <span class="hidden rounded-full bg-white px-3 py-1.5 text-xs font-bold text-gray-500 shadow-sm ring-1 ring-gray-200 sm:inline-block">
                        {{ $tasks->count() }} data
                    </span>

                </div>


                {{-- ================================================= --}}
                {{-- LOOP TASK --}}
                {{-- ================================================= --}}

                <div class="divide-y divide-gray-100">
                    @forelse ($tasks as $task)

                        @php
                            $categoryName = $task->category?->nama_kategori ?? 'Tanpa kategori';

                            $categoryClass = $categoryStyles[$categoryName]
                                ?? 'bg-gray-50 text-gray-600 border border-gray-200';

                            $priority = $priorityStyles[$task->priority] ?? [
                                'dot' => 'bg-gray-400',
                                'text' => 'text-gray-600',
                                'bg' => 'bg-gray-50 border border-gray-200',
                            ];

                            $isDone = strtolower($task->status ?? '') === 'selesai';

                            $statusClass = $isDone
                                ? 'bg-emerald-50 text-emerald-700 border-emerald-200'
                                : 'bg-amber-50 text-amber-700 border-amber-200';
                        @endphp


                        {{-- ================================================= --}}
                        {{-- DESKTOP --}}
                        {{-- ================================================= --}}

                        <div class="group hidden px-6 py-5 transition-all duration-300 hover:-translate-y-0.5 hover:bg-indigo-50/30 hover:shadow-[0_4px_20px_-10px_rgba(79,70,229,0.15)] md:block">

                            <div class="flex items-center gap-5">


                                {{-- Nomor --}}
                                <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-gray-50 text-sm font-bold text-gray-400 ring-1 ring-inset ring-gray-200 transition-colors group-hover:bg-white group-hover:text-indigo-500 group-hover:ring-indigo-100">
                                    #{{ $task->id }}
                                </div>


                                {{-- Judul & Badges --}}
                                <div class="min-w-0 flex-1">

                                    <a
                                        href="{{ route('tasks.show', $task) }}"
                                        class="block truncate text-base font-bold text-gray-800 transition-colors hover:text-indigo-600"
                                    >
                                        {{ $task->judul }}
                                    </a>


                                    <div class="mt-2.5 flex flex-wrap items-center gap-2">

                                        {{-- Kategori --}}
                                        <span class="rounded-lg px-2.5 py-1 text-[11px] font-bold tracking-wide uppercase {{ $categoryClass }}">
                                            {{ $categoryName }}
                                        </span>


                                        {{-- Prioritas --}}
                                        <span class="inline-flex items-center gap-1.5 rounded-lg px-2.5 py-1 text-[11px] font-bold tracking-wide uppercase {{ $priority['text'] }} {{ $priority['bg'] }}">

                                            <span class="h-1.5 w-1.5 rounded-full {{ $priority['dot'] }}"></span>

                                            {{ $task->priority ?? 'Tanpa prioritas' }}

                                        </span>

                                    </div>

                                </div>


                                {{-- Status --}}
                                <div class="w-32 shrink-0">

                                    <p class="mb-1.5 text-[10px] font-bold uppercase tracking-wider text-gray-400">
                                        Status
                                    </p>

                                    <span class="inline-flex items-center rounded-lg border px-2.5 py-1 text-[11px] font-bold tracking-wide uppercase {{ $statusClass }}">
                                        @if($isDone)
                                            <svg class="mr-1 h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                        @else
                                            <svg class="mr-1 h-3 w-3 animate-spin-slow" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        @endif
                                        {{ $task->status ?? 'Belum' }}
                                    </span>

                                </div>


                                {{-- Deadline --}}
                                <div class="w-36 shrink-0">

                                    <p class="mb-1.5 text-[10px] font-bold uppercase tracking-wider text-gray-400">
                                        Deadline
                                    </p>

                                    <div class="flex items-center gap-1.5 text-sm font-semibold text-gray-700">
                                        <svg class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        @if ($task->deadline)
                                            {{ \Carbon\Carbon::parse($task->deadline)->translatedFormat('d M Y') }}
                                        @else
                                            <span class="text-gray-400 italic">Tidak ada</span>
                                        @endif
                                    </div>

                                </div>


                                {{-- Aksi --}}
                                <div class="flex shrink-0 items-center gap-2 opacity-100 transition-opacity md:opacity-60 md:group-hover:opacity-100">

                                    {{-- Lihat --}}
                                    <a
                                        href="{{ route('tasks.show', $task) }}"
                                        title="Lihat detail"
                                        class="inline-flex h-9 w-9 items-center justify-center rounded-xl bg-indigo-50 text-indigo-600 transition-all duration-300 hover:scale-110 hover:bg-indigo-600 hover:text-white hover:shadow-md hover:shadow-indigo-200"
                                    >

                                        <svg
                                            class="h-4 w-4"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="2"
                                            viewBox="0 0 24 24"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M2.25 12s3.75-6 9.75-6 9.75 6 9.75 6-3.75 6-9.75 6-9.75-6-9.75-6z"
                                            />
                                            <circle cx="12" cy="12" r="2.5" />
                                        </svg>

                                    </a>


                                    {{-- Edit --}}
                                    <a
                                        href="{{ route('tasks.edit', $task) }}"
                                        title="Edit task"
                                        class="inline-flex h-9 w-9 items-center justify-center rounded-xl bg-amber-50 text-amber-600 transition-all duration-300 hover:scale-110 hover:bg-amber-500 hover:text-white hover:shadow-md hover:shadow-amber-200"
                                    >

                                        <svg
                                            class="h-4 w-4"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="2"
                                            viewBox="0 0 24 24"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13l-3.68 1.105 1.105-3.68a4.5 4.5 0 011.13-1.897l9.622-9.622z"
                                            />
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M19.5 7.125L16.875 4.5"
                                            />
                                        </svg>

                                    </a>


                                    {{-- Hapus --}}
                                    <form
                                        action="{{ route('tasks.destroy', $task) }}"
                                        method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus task ini?')"
                                    >

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            title="Hapus task"
                                            class="inline-flex h-9 w-9 items-center justify-center rounded-xl bg-rose-50 text-rose-600 transition-all duration-300 hover:scale-110 hover:bg-rose-500 hover:text-white hover:shadow-md hover:shadow-rose-200"
                                        >

                                            <svg
                                                class="h-4 w-4"
                                                fill="none"
                                                stroke="currentColor"
                                                stroke-width="2"
                                                viewBox="0 0 24 24"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    d="M6 7h12M9.5 7V5a1.5 1.5 0 011.5-1.5h2A1.5 1.5 0 0114.5 5v2m-7 0l.6 11.4a2 2 0 002 1.9h3.8a2 2 0 002-1.9L16.5 7"
                                                />
                                            </svg>

                                        </button>

                                    </form>

                                </div>

                            </div>

                        </div>


                        {{-- ================================================= --}}
                        {{-- MOBILE --}}
                        {{-- ================================================= --}}

                        <div class="px-5 py-5 transition-colors hover:bg-gray-50/50 md:hidden">

                            <div class="flex items-start gap-4">

                                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-gray-50 text-xs font-bold text-gray-500 ring-1 ring-inset ring-gray-200">
                                    #{{ $task->id }}
                                </div>


                                <div class="min-w-0 flex-1">

                                    <a
                                        href="{{ route('tasks.show', $task) }}"
                                        class="block font-bold text-gray-900 transition-colors hover:text-indigo-600"
                                    >
                                        {{ $task->judul }}
                                    </a>


                                    <div class="mt-2.5 flex flex-wrap gap-2">

                                        <span class="rounded-lg px-2.5 py-1 text-[10px] font-bold uppercase tracking-wide {{ $categoryClass }}">
                                            {{ $categoryName }}
                                        </span>


                                        <span class="inline-flex items-center gap-1.5 rounded-lg px-2.5 py-1 text-[10px] font-bold uppercase tracking-wide {{ $priority['text'] }} {{ $priority['bg'] }}">

                                            <span class="h-1.5 w-1.5 rounded-full {{ $priority['dot'] }}"></span>

                                            {{ $task->priority ?? 'Tanpa prioritas' }}

                                        </span>

                                    </div>

                                </div>

                            </div>


                            <div class="mt-5 grid grid-cols-2 gap-3 rounded-xl bg-white p-3 ring-1 ring-inset ring-gray-100 shadow-sm">

                                <div>

                                    <p class="text-[10px] font-bold uppercase tracking-wider text-gray-400">
                                        Status
                                    </p>

                                    <span class="mt-1.5 inline-flex items-center rounded-lg border px-2.5 py-1 text-[10px] font-bold uppercase tracking-wide {{ $statusClass }}">
                                        {{ $task->status ?? 'Belum' }}
                                    </span>

                                </div>


                                <div>

                                    <p class="text-[10px] font-bold uppercase tracking-wider text-gray-400">
                                        Deadline
                                    </p>

                                    <div class="mt-1.5 flex items-center gap-1 text-sm font-semibold text-gray-700">
                                        @if ($task->deadline)
                                            {{ \Carbon\Carbon::parse($task->deadline)->translatedFormat('d M Y') }}
                                        @else
                                            <span class="text-gray-400 italic">Tanpa deadline</span>
                                        @endif
                                    </div>

                                </div>

                            </div>


                            <div class="mt-4 flex gap-2">

                                <a
                                    href="{{ route('tasks.show', $task) }}"
                                    class="flex-1 rounded-xl bg-indigo-50 px-3 py-2.5 text-center text-xs font-bold text-indigo-600 transition-colors hover:bg-indigo-100"
                                >
                                    Detail
                                </a>


                                <a
                                    href="{{ route('tasks.edit', $task) }}"
                                    class="rounded-xl bg-amber-50 px-4 py-2.5 text-xs font-bold text-amber-600 transition-colors hover:bg-amber-100"
                                >
                                    Edit
                                </a>


                                <form
                                    action="{{ route('tasks.destroy', $task) }}"
                                    method="POST"
                                    class="inline-block"
                                    onsubmit="return confirm('Yakin ingin menghapus task ini?')"
                                >

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="rounded-xl bg-rose-50 px-4 py-2.5 text-xs font-bold text-rose-600 transition-colors hover:bg-rose-100"
                                    >
                                        Hapus
                                    </button>

                                </form>

                            </div>

                        </div>

                    @empty

                        {{-- ================================================= --}}
                        {{-- EMPTY STATE --}}
                        {{-- ================================================= --}}

                        <div class="flex flex-col items-center justify-center px-6 py-20 text-center">

                            <div class="relative flex h-20 w-20 items-center justify-center rounded-3xl bg-indigo-50 text-indigo-500 ring-1 ring-inset ring-indigo-100">
                                
                                <div class="absolute -right-1 -top-1 flex h-6 w-6 items-center justify-center rounded-full bg-indigo-600 text-white shadow-sm">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"></path></svg>
                                </div>

                                <svg
                                    class="h-10 w-10"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="1.5"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M9 12h6m-6 4h6M9 8h1m5 12H7a2 2 0 01-2-2V6a2 2 0 012-2h5.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V18a2 2 0 01-2 2z"
                                    />
                                </svg>

                            </div>


                            <h3 class="mt-6 text-lg font-bold text-gray-900">
                                Belum ada task yang tercatat
                            </h3>


                            <p class="mt-2 max-w-sm text-sm text-gray-500">
                                Mulai produktivitasmu sekarang. Tambahkan daftar kegiatan, tugas proyek, atau deadline penting di sini.
                            </p>


                            <a
                                href="{{ route('tasks.create') }}"
                                class="mt-8 inline-flex items-center gap-2 rounded-xl bg-indigo-600 px-5 py-3 text-sm font-semibold text-white shadow-md shadow-indigo-200 transition-all hover:-translate-y-0.5 hover:bg-indigo-700 hover:shadow-lg hover:shadow-indigo-300"
                            >

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
                                        d="M12 4.5v15m7.5-7.5h-15"
                                    />
                                </svg>

                                Buat Task Pertama

                            </a>

                        </div>

                    @endforelse
                </div>

            </div>


            {{-- ===================================================== --}}
            {{-- INFORMASI BAWAH --}}
            {{-- ===================================================== --}}

            <div class="rounded-2xl border border-indigo-100 bg-gradient-to-r from-indigo-50 to-white px-6 py-5 shadow-sm">

                <div class="flex items-start gap-4">

                    <div class="mt-0.5 flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-indigo-100 text-indigo-600">

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
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                            />
                        </svg>

                    </div>


                    <div>

                        <p class="font-bold text-indigo-900">
                            Tips produktivitas
                        </p>

                        <p class="mt-1 text-sm font-medium text-indigo-700/80">
                            Kelompokkan tugas berdasarkan kategori dan selesaikan yang berprioritas <span class="font-bold text-rose-500">Tinggi</span> terlebih dahulu agar beban kerjamu lebih ringan.
                        </p>

                    </div>

                </div>

            </div>


        </div>

    </div>

</x-app-layout>