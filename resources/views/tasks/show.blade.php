<x-app-layout>

    <x-slot name="header">

        <div class="flex items-center gap-3">

            <a
                href="{{ route('dashboard') }}"
                class="text-gray-400 transition hover:text-indigo-700"
            >
                ←
            </a>

            <h2 class="text-2xl font-semibold leading-tight text-gray-800">
                Detail Tugas
            </h2>

        </div>

    </x-slot>


    @php
        $categoryName = $task->category?->nama_kategori ?? 'Tanpa kategori';

        /*
        |--------------------------------------------------------------------------
        | Category Style
        |--------------------------------------------------------------------------
        | Warna kategori dibuat tetap berada di keluarga deep indigo agar
        | konsisten dengan identitas visual TaskFlow.
        */

        $categoryStyles = [
            'Sekolah' => [
                'bar' => 'bg-gradient-to-r from-slate-950 via-indigo-950 to-indigo-800',
                'badge' => 'bg-indigo-50 text-indigo-800 ring-1 ring-indigo-100',
            ],

            'Proyek' => [
                'bar' => 'bg-gradient-to-r from-slate-950 via-indigo-900 to-violet-800',
                'badge' => 'bg-indigo-50 text-indigo-800 ring-1 ring-indigo-100',
            ],

            'Pribadi' => [
                'bar' => 'bg-gradient-to-r from-slate-950 via-indigo-950 to-indigo-700',
                'badge' => 'bg-indigo-50 text-indigo-800 ring-1 ring-indigo-100',
            ],
        ];


        /*
        |--------------------------------------------------------------------------
        | Priority Style
        |--------------------------------------------------------------------------
        | Warna semantic tetap dipertahankan agar prioritas mudah dibedakan.
        */

        $priorityStyles = [
            'Rendah' => [
                'dot' => 'bg-emerald-500',
                'text' => 'text-emerald-700',
                'bg' => 'bg-emerald-50',
            ],

            'Sedang' => [
                'dot' => 'bg-amber-500',
                'text' => 'text-amber-700',
                'bg' => 'bg-amber-50',
            ],

            'Tinggi' => [
                'dot' => 'bg-rose-500',
                'text' => 'text-rose-700',
                'bg' => 'bg-rose-50',
            ],
        ];


        $category = $categoryStyles[$categoryName] ?? [
            'bar' => 'bg-gradient-to-r from-slate-950 via-indigo-950 to-indigo-800',
            'badge' => 'bg-indigo-50 text-indigo-800 ring-1 ring-indigo-100',
        ];


        $priority = $priorityStyles[$task->priority] ?? null;

        $isDone = $task->status === 'Selesai';
    @endphp


    {{-- ========================================================= --}}
    {{-- MAIN --}}
    {{-- ========================================================= --}}

    <div class="min-h-screen bg-gradient-to-br from-slate-50 via-gray-50 to-indigo-50/30 py-8">

        <div class="mx-auto max-w-4xl px-6">


            {{-- ================================================= --}}
            {{-- SUCCESS MESSAGE --}}
            {{-- ================================================= --}}

            @if (session('success'))

                <div class="mb-6 flex items-center gap-3 rounded-2xl border border-emerald-100 bg-emerald-50 px-5 py-4 text-emerald-700 shadow-sm">

                    <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-emerald-100 text-emerald-600">

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
                                d="M5 13l4 4L19 7"
                            />
                        </svg>

                    </div>

                    <p class="text-sm font-medium">
                        {{ session('success') }}
                    </p>

                </div>

            @endif


            {{-- ================================================= --}}
            {{-- TASK CARD --}}
            {{-- ================================================= --}}

            <div class="overflow-hidden rounded-3xl border border-gray-100 bg-white shadow-sm">


                {{-- ================================================= --}}
                {{-- NAVY / DEEP INDIGO ACCENT BAR --}}
                {{-- ================================================= --}}

                <div class="h-2 {{ $category['bar'] }}"></div>


                <div class="p-6 md:p-8">


                    {{-- ================================================= --}}
                    {{-- HEADER DETAIL --}}
                    {{-- ================================================= --}}

                    <div class="flex flex-col gap-5 md:flex-row md:items-start md:justify-between">


                        {{-- TASK TITLE --}}

                        <div class="min-w-0">

                            <span
                                class="inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold {{ $category['badge'] }}"
                            >
                                {{ $categoryName }}
                            </span>


                            <h1 class="mt-3 text-3xl font-bold tracking-tight text-slate-950">
                                {{ $task->judul }}
                            </h1>


                            {{-- STATUS --}}

                            @if ($isDone)

                                <span class="mt-3 inline-flex items-center gap-2 rounded-full bg-emerald-50 px-3 py-1 text-sm font-semibold text-emerald-700 ring-1 ring-emerald-100">

                                    <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>

                                    Tugas selesai

                                </span>

                            @else

                                <span class="mt-3 inline-flex items-center gap-2 rounded-full bg-amber-50 px-3 py-1 text-sm font-semibold text-amber-700 ring-1 ring-amber-100">

                                    <span class="h-1.5 w-1.5 rounded-full bg-amber-500"></span>

                                    Belum selesai

                                </span>

                            @endif

                        </div>


                        {{-- ================================================= --}}
                        {{-- ACTION BUTTONS --}}
                        {{-- ================================================= --}}

                        <div class="flex shrink-0 items-center gap-2">


                            {{-- EDIT --}}

                            <a
                                href="{{ route('tasks.edit', $task) }}"
                                class="inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-slate-950 via-indigo-950 to-indigo-800 px-4 py-2.5 text-sm font-semibold text-white shadow-md shadow-indigo-950/20 transition duration-200 hover:-translate-y-0.5 hover:from-slate-900 hover:via-indigo-900 hover:to-indigo-700 hover:shadow-lg focus:outline-none focus:ring-4 focus:ring-indigo-500/20"
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

                                Edit

                            </a>


                            {{-- DELETE --}}

                            <form
                                method="POST"
                                action="{{ route('tasks.destroy', $task) }}"
                                onsubmit="return confirm('Hapus tugas ini?');"
                            >

                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="inline-flex items-center gap-2 rounded-xl border border-rose-100 bg-rose-50 px-4 py-2.5 text-sm font-semibold text-rose-600 transition duration-200 hover:-translate-y-0.5 hover:bg-rose-100 focus:outline-none focus:ring-4 focus:ring-rose-500/10"
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

                                    Hapus

                                </button>

                            </form>

                        </div>

                    </div>


                    {{-- ================================================= --}}
                    {{-- TASK INFORMATION --}}
                    {{-- ================================================= --}}

                    <div class="mt-8 grid grid-cols-1 gap-4 sm:grid-cols-3">


                        {{-- PRIORITAS --}}

                        <div class="rounded-2xl border border-indigo-100 bg-gradient-to-br from-slate-50 via-white to-indigo-50/60 p-4">

                            <p class="text-xs font-semibold uppercase tracking-wide text-gray-400">
                                Prioritas
                            </p>

                            @if ($priority)

                                <div class="mt-2 inline-flex items-center gap-2 text-sm font-semibold {{ $priority['text'] }}">

                                    <span class="h-2 w-2 rounded-full {{ $priority['dot'] }}"></span>

                                    {{ ucfirst(strtolower($task->priority)) }}

                                </div>

                            @else

                                <p class="mt-2 text-sm font-semibold text-gray-700">
                                    Tidak ada
                                </p>

                            @endif

                        </div>


                        {{-- STATUS --}}

                        <div class="rounded-2xl border border-indigo-100 bg-gradient-to-br from-slate-50 via-white to-indigo-50/60 p-4">

                            <p class="text-xs font-semibold uppercase tracking-wide text-gray-400">
                                Status
                            </p>

                            <p class="mt-2 text-sm font-semibold text-slate-800">
                                {{ $task->status ?? 'Belum ditentukan' }}
                            </p>

                        </div>


                        {{-- DEADLINE --}}

                        <div class="rounded-2xl border border-indigo-100 bg-gradient-to-br from-slate-50 via-white to-indigo-50/60 p-4">

                            <p class="text-xs font-semibold uppercase tracking-wide text-gray-400">
                                Deadline
                            </p>

                            <p class="mt-2 text-sm font-semibold text-slate-800">

                                @if ($task->deadline)

                                    {{ \Carbon\Carbon::parse($task->deadline)->translatedFormat('d F Y') }}

                                @else

                                    Tanpa deadline

                                @endif

                            </p>

                        </div>

                    </div>


                    {{-- ================================================= --}}
                    {{-- DESKRIPSI --}}
                    {{-- ================================================= --}}

                    <div class="mt-8 border-t border-gray-100 pt-6">

                        <div class="flex items-center gap-3">

                            <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-indigo-50 text-indigo-700">

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
                                        d="M4 6.75A2.25 2.25 0 016.25 4.5h11.5A2.25 2.25 0 0120 6.75v10.5a2.25 2.25 0 01-2.25 2.25H6.25A2.25 2.25 0 014 17.25V6.75z"
                                    />

                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M8 9h8M8 13h5"
                                    />
                                </svg>

                            </div>

                            <h2 class="text-lg font-semibold text-slate-950">
                                Deskripsi Tugas
                            </h2>

                        </div>


                        @if (!empty($task->deskripsi))

                            <div class="mt-4 rounded-2xl border border-gray-100 bg-slate-50/70 p-5 text-gray-600 leading-relaxed whitespace-pre-line">
                                {{ $task->deskripsi }}
                            </div>

                        @else

                            <p class="mt-4 rounded-2xl bg-gray-50 p-5 text-gray-400">
                                Belum ada deskripsi untuk tugas ini.
                            </p>

                        @endif

                    </div>


                    {{-- ================================================= --}}
                    {{-- TIMESTAMP --}}
                    {{-- ================================================= --}}

                    <div class="mt-8 grid grid-cols-1 gap-4 border-t border-gray-100 pt-6 sm:grid-cols-2">

                        <div class="rounded-2xl bg-slate-50/70 p-4">

                            <p class="text-xs font-semibold uppercase tracking-wide text-gray-400">
                                Dibuat pada
                            </p>

                            <p class="mt-1 text-sm font-medium text-gray-600">
                                {{ $task->created_at?->translatedFormat('d F Y, H:i') ?? '-' }}
                            </p>

                        </div>


                        <div class="rounded-2xl bg-slate-50/70 p-4">

                            <p class="text-xs font-semibold uppercase tracking-wide text-gray-400">
                                Terakhir diperbarui
                            </p>

                            <p class="mt-1 text-sm font-medium text-gray-600">
                                {{ $task->updated_at?->translatedFormat('d F Y, H:i') ?? '-' }}
                            </p>

                        </div>

                    </div>


                    {{-- ================================================= --}}
                    {{-- BACK TO DASHBOARD --}}
                    {{-- ================================================= --}}

                    <div class="mt-8 border-t border-gray-100 pt-6">

                        <a
                            href="{{ route('dashboard') }}"
                            class="inline-flex items-center gap-2 text-sm font-semibold text-indigo-800 transition hover:text-indigo-950"
                        >

                            <span class="transition-transform duration-200 group-hover:-translate-x-0.5">
                                ←
                            </span>

                            Kembali ke dashboard

                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>

