<x-app-layout>

    <x-slot name="header">
        <div></div>
    </x-slot>

    @php

        $totalTasks = $totalTasks ?? 0;
        $completedTasks = $completedTasks ?? 0;
        $dueSoonCount = $dueSoonCount ?? 0;

        $tasks = $tasks ?? collect();
        $priorityTasks = $priorityTasks ?? collect();

        $categories = $categories ?? collect();

        $search = $search ?? '';
        $sort = $sort ?? 'latest';
        $category = $category ?? '';

    @endphp


    {{-- ========================================================= --}}
    {{-- LAYOUT --}}
    {{-- ========================================================= --}}

    <div class="min-h-screen bg-slate-50">

        <div class="flex w-full">


            {{-- ================================================= --}}
            {{-- SIDEBAR --}}
            {{-- ================================================= --}}

            <aside class="hidden w-64 shrink-0 p-6 lg:block lg:p-8">

                <div
                    class="sticky top-6 flex h-[calc(100vh-3rem)] flex-col overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm"
                >

                    {{-- LOGO --}}

                    <div class="flex h-20 items-center border-b border-gray-100 px-6">

                        <div>

                            <h1 class="text-xl font-bold tracking-tight text-slate-900">
                                Task<span class="text-indigo-600">Flow</span>
                            </h1>

                            <p class="text-xs text-slate-400">
                                Kelola Tugas Sekolah Tanpa Ribet!
                            </p>

                        </div>

                    </div>


                    {{-- MENU --}}

                    <nav class="flex-1 space-y-1 px-4 py-6">


                        {{-- Dashboard --}}

                        <a
                            href="{{ route('dashboard') }}"
                            class="flex items-center gap-3 rounded-xl bg-indigo-50 px-4 py-3 text-sm font-semibold text-indigo-700"
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
                                    d="M3 12l9-9 9 9M5 10v10a1 1 0 001 1h4v-6h4v6h4a1 1 0 001-1V10"
                                />

                            </svg>

                            Dashboard

                        </a>


                        {{-- Tugas --}}

                        <a
                            href="{{ route('tasks.index') }}"
                            class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium text-gray-600 transition hover:bg-gray-50 hover:text-indigo-600"
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
                                    d="M9 12h6m-6 4h6M9 8h1m5 12H7a2 2 0 01-2-2V6a2 2 0 012-2h5.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V18a2 2 0 01-2 2z"
                                />

                            </svg>

                            Tugas

                        </a>


                        {{-- Tambah --}}

                        <a
                            href="{{ route('tasks.create') }}"
                            class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium text-gray-600 transition hover:bg-gray-50 hover:text-indigo-600"
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

                            Tambah Tugas

                        </a>


                        {{-- Kategori --}}

                        <a
                            href="{{ route('categories.index') }}"
                            class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium text-gray-600 transition hover:bg-gray-50 hover:text-indigo-600"
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
                                    d="M4 7h16M4 12h16M4 17h16"
                                />

                            </svg>

                            Kategori

                        </a>


                        {{-- Profil --}}

                        <a
                            href="{{ route('profile.edit') }}"
                            class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium text-gray-600 transition hover:bg-gray-50 hover:text-indigo-600"
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
                                    d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.5 20.25a7.5 7.5 0 0115 0"
                                />

                            </svg>

                            Profil

                        </a>

                    </nav>


                    {{-- USER --}}

                    <div class="border-t border-gray-100 p-4">

                        <div class="mb-3 flex items-center gap-3 px-2">

                            <div
                                class="flex h-10 w-10 items-center justify-center rounded-full bg-indigo-100 font-semibold text-indigo-600"
                            >

                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}

                            </div>


                            <div class="min-w-0">

                                <p class="truncate text-sm font-semibold text-gray-900">
                                    {{ Auth::user()->name }}
                                </p>

                                <p class="truncate text-xs text-gray-400">
                                    {{ Auth::user()->email }}
                                </p>

                            </div>

                        </div>


                        <form
                            method="POST"
                            action="{{ route('logout') }}"
                        >

                            @csrf

                            <button
                                type="submit"
                                class="flex w-full items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium text-gray-500 transition hover:bg-rose-50 hover:text-rose-600"
                            >

                                Keluar

                            </button>

                        </form>

                    </div>

                </div>

            </aside>


            {{-- ================================================= --}}
            {{-- CONTENT --}}
            {{-- ================================================= --}}

            <main class="min-w-0 flex-1">

                <div class="p-6 lg:p-8">


                    {{-- ================================================= --}}
                    {{-- WELCOME --}}
                    {{-- ================================================= --}}

                    <div
                        class="relative overflow-hidden rounded-2xl bg-gradient-to-br from-indigo-600 via-indigo-600 to-violet-700 p-6 text-white shadow-sm md:p-8"
                    >

                        <div class="relative z-10">

                            <p class="text-sm font-medium text-indigo-100">
                                Selamat datang kembali
                            </p>

                            <h1 class="mt-2 text-3xl font-bold md:text-4xl">
                                Halo, {{ Auth::user()->name }}!
                            </h1>

                            <p class="mt-3 max-w-2xl text-sm text-indigo-100 md:text-base">
                                Kelola tugas sekolah, proyek, dan aktivitas pribadi dengan lebih teratur.
                            </p>

                        </div>


                        <div
                            class="absolute -right-10 -top-16 h-52 w-52 rounded-full bg-white/10"
                        ></div>

                        <div
                            class="absolute -bottom-24 right-24 h-48 w-48 rounded-full bg-violet-400/20"
                        ></div>

                    </div>


                    {{-- ================================================= --}}
                    {{-- DEADLINE ALERT --}}
                    {{-- ================================================= --}}

                    @if ($dueSoonCount > 0)

                        <div
                            class="mt-6 flex items-center gap-3 rounded-2xl border border-rose-100 bg-rose-50 px-5 py-4 text-rose-700"
                        >

                            <div
                                class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-rose-100"
                            >
                                ⚠️
                            </div>

                            <div>

                                <p class="font-semibold">
                                    Ada tugas yang mendekati deadline!
                                </p>

                                <p class="text-sm text-rose-600">
                                    {{ $dueSoonCount }} tugas memiliki deadline dalam 7 hari ke depan.
                                </p>

                            </div>

                        </div>

                    @else

                        <div
                            class="mt-6 flex items-center gap-3 rounded-2xl border border-emerald-100 bg-emerald-50 px-5 py-4 text-emerald-600"
                        >

                            <div
                                class="flex h-10 w-10 items-center justify-center rounded-xl bg-emerald-100"
                            >
                                ✓
                            </div>

                            <div>

                                <p class="font-semibold">
                                    Semua aman
                                </p>

                                <p class="text-sm text-emerald-700">
                                    Tidak ada deadline dalam 7 hari ke depan.
                                </p>

                            </div>

                        </div>

                    @endif


                    {{-- ================================================= --}}
                    {{-- STATISTICS --}}
                    {{-- ================================================= --}}

                    <div class="mt-6 grid grid-cols-1 gap-5 md:grid-cols-3">


                        {{-- Total --}}

                        <div
                            class="group rounded-2xl border border-gray-100 bg-white p-6 shadow-sm transition duration-200 hover:-translate-y-1 hover:border-indigo-100 hover:shadow-lg"
                        >

                            <p class="text-sm font-medium text-gray-500 transition group-hover:text-indigo-600">
                                Total Tugas
                            </p>

                            <p class="mt-2 text-3xl font-bold text-gray-900 transition group-hover:text-indigo-600">
                                {{ $totalTasks }}
                            </p>

                            <p class="mt-2 text-xs text-gray-400">
                                Semua tugasmu
                            </p>

                        </div>


                        {{-- Completed --}}

                        <div
                            class="group rounded-2xl border border-gray-100 bg-white p-6 shadow-sm transition duration-200 hover:-translate-y-1 hover:border-emerald-100 hover:shadow-lg"
                        >

                            <p class="text-sm font-medium text-gray-500 transition group-hover:text-emerald-600">
                                Sudah Selesai
                            </p>

                            <p class="mt-2 text-3xl font-bold text-gray-900 transition group-hover:text-emerald-600">
                                {{ $completedTasks }}
                            </p>

                            <p class="mt-2 text-xs text-gray-400">
                                Tugas yang selesai
                            </p>

                        </div>


                        {{-- Deadline --}}

                        <div
                            class="group rounded-2xl border border-gray-100 bg-white p-6 shadow-sm transition duration-200 hover:-translate-y-1 hover:border-rose-100 hover:shadow-lg"
                        >

                            <p class="text-sm font-medium text-gray-500 transition group-hover:text-rose-600">
                                Deadline H-7
                            </p>

                            <p class="mt-2 text-3xl font-bold text-gray-900 transition group-hover:text-rose-600">
                                {{ $dueSoonCount }}
                            </p>

                            <p class="mt-2 text-xs text-gray-400">
                                Perlu segera dikerjakan
                            </p>

                        </div>

                    </div>


                    {{-- ================================================= --}}
                    {{-- PRIORITY DEADLINE --}}
                    {{-- ================================================= --}}

                    @if ($priorityTasks->count() > 0)

                        <div
                            class="mt-6 overflow-hidden rounded-2xl border border-rose-100 bg-white shadow-sm"
                        >

                            <div
                                class="border-b border-rose-100 bg-rose-50 px-6 py-5"
                            >

                                <div class="flex items-center gap-3">

                                    <div
                                        class="flex h-10 w-10 items-center justify-center rounded-xl bg-rose-100 text-rose-600"
                                    >
                                        ⏰
                                    </div>

                                    <div>

                                        <h3 class="font-semibold text-gray-900">
                                            Prioritas Deadline
                                        </h3>

                                        <p class="text-xs text-gray-500">
                                            Tugas dengan deadline maksimal 7 hari ke depan
                                        </p>

                                    </div>

                                </div>

                            </div>


                            @foreach ($priorityTasks as $task)

                                @php

                                    $deadline = \Carbon\Carbon::parse($task->deadline);

                                    $daysLeft = now()->startOfDay()->diffInDays(
                                        $deadline->startOfDay(),
                                        false
                                    );

                                @endphp


                                <div
                                    class="flex items-center gap-4 border-b border-gray-50 px-6 py-4 last:border-0 hover:bg-gray-50"
                                >

                                    <div class="min-w-0 flex-1">

                                        <a
                                            href="{{ route('tasks.show', $task) }}"
                                            class="block truncate font-medium text-gray-900 hover:text-indigo-600"
                                        >

                                            {{ $task->judul }}

                                        </a>

                                        <p class="mt-1 text-xs text-gray-400">

                                            Deadline:
                                            {{ $deadline->translatedFormat('d F Y') }}

                                        </p>

                                    </div>


                                    @if ($daysLeft == 0)

                                        <span
                                            class="rounded-full bg-rose-100 px-3 py-1 text-xs font-semibold text-rose-700"
                                        >
                                            Hari ini
                                        </span>

                                    @elseif ($daysLeft == 1)

                                        <span
                                            class="rounded-full bg-orange-100 px-3 py-1 text-xs font-semibold text-orange-700"
                                        >
                                            Besok
                                        </span>

                                    @else

                                        <span
                                            class="rounded-full bg-amber-50 px-3 py-1 text-xs font-semibold text-amber-700"
                                        >
                                            H-{{ $daysLeft }}
                                        </span>

                                    @endif


                                    <a
                                        href="{{ route('tasks.show', $task) }}"
                                        class="text-xs font-medium text-indigo-600 hover:text-indigo-800"
                                    >
                                        Detail
                                    </a>

                                </div>

                            @endforeach

                        </div>

                    @endif


                    {{-- ================================================= --}}
                    {{-- TASK LIST --}}
                    {{-- ================================================= --}}

                    <div
                        class="mt-6 overflow-hidden rounded-2xl border border-gray-100 bg-white shadow-sm"
                    >


                        {{-- HEADER --}}

                        <div class="border-b border-gray-100 px-6 py-5">

                            <div
                                class="flex flex-col gap-5 lg:flex-row lg:items-center lg:justify-between"
                            >


                                {{-- TITLE --}}

                                <div class="flex items-center gap-3">

                                    <div
                                        class="flex h-10 w-10 items-center justify-center rounded-xl bg-indigo-50 text-indigo-600"
                                    >
                                        📋
                                    </div>

                                    <div>

                                        <div class="flex items-center gap-2">

                                            <h3 class="font-semibold text-gray-900">

                                                {{ $search || $category
                                                    ? 'Hasil Filter'
                                                    : 'Daftar Tugas' }}

                                            </h3>

                                            @if (!$search && !$category)

                                                <span
                                                    class="rounded-full bg-gray-100 px-2 py-1 text-xs font-medium text-gray-500"
                                                >
                                                    {{ $totalTasks }}
                                                </span>

                                            @endif

                                        </div>


                                        <p class="text-xs text-gray-400">

                                            @if ($search && $category)

                                                Hasil pencarian
                                                "{{ $search }}"
                                                pada kategori terpilih

                                            @elseif ($search)

                                                Hasil untuk
                                                "{{ $search }}"

                                            @elseif ($category)

                                                Tugas berdasarkan kategori

                                            @else

                                                Kelola dan pantau tugasmu

                                            @endif

                                        </p>

                                    </div>

                                </div>


                                {{-- FILTER AREA --}}

                                <div
                                    class="flex w-full flex-col gap-2 lg:w-auto"
                                >


                                    <div
                                        class="flex w-full flex-col gap-2 sm:flex-row"
                                    >


                                        {{-- SEARCH --}}

                                        <form
                                            action="{{ route('dashboard') }}"
                                            method="GET"
                                            class="flex min-w-0 flex-1"
                                        >

                                            {{-- Pertahankan sorting --}}

                                            <input
                                                type="hidden"
                                                name="sort"
                                                value="{{ $sort }}"
                                            >


                                            {{-- Pertahankan kategori --}}

                                            @if ($category)

                                                <input
                                                    type="hidden"
                                                    name="category"
                                                    value="{{ $category }}"
                                                >

                                            @endif


                                            <div class="relative w-full">

                                                <input
                                                    type="text"
                                                    name="search"
                                                    value="{{ $search }}"
                                                    placeholder="Cari task..."
                                                    class="w-full rounded-xl border border-gray-200 bg-gray-50 py-2.5 pl-10 pr-4 text-sm outline-none focus:border-indigo-400 focus:bg-white focus:ring-2 focus:ring-indigo-100"
                                                >


                                                <svg
                                                    class="absolute left-3 top-1/2 h-5 w-5 -translate-y-1/2 text-gray-400"
                                                    fill="none"
                                                    stroke="currentColor"
                                                    stroke-width="2"
                                                    viewBox="0 0 24 24"
                                                >

                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        d="m21 21-4.35-4.35m2.35-5.65a8 8 0 11-16 0 8 8 0 0116 0z"
                                                    />

                                                </svg>

                                            </div>


                                            <button
                                                type="submit"
                                                class="ml-2 rounded-xl bg-indigo-600 px-4 py-2 text-sm font-medium text-white transition hover:bg-indigo-700"
                                            >
                                                Cari
                                            </button>

                                        </form>


                                        {{-- SORTING --}}

                                        <form
                                            action="{{ route('dashboard') }}"
                                            method="GET"
                                        >

                                            {{-- Pertahankan search --}}

                                            @if ($search)

                                                <input
                                                    type="hidden"
                                                    name="search"
                                                    value="{{ $search }}"
                                                >

                                            @endif


                                            {{-- Pertahankan kategori --}}

                                            @if ($category)

                                                <input
                                                    type="hidden"
                                                    name="category"
                                                    value="{{ $category }}"
                                                >

                                            @endif


                                            <select
                                                name="sort"
                                                onchange="this.form.submit()"
                                                class="w-full rounded-xl border border-gray-200 bg-white pl-4 pr-10 py-2.5 text-sm font-medium text-gray-600 outline-none transition focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100 sm:w-auto"
                                            >

                                                <option
                                                    value="latest"
                                                    {{ $sort === 'latest' ? 'selected' : '' }}
                                                >
                                                    🆕 Task Terbaru
                                                </option>

                                                <option
                                                    value="deadline"
                                                    {{ $sort === 'deadline' ? 'selected' : '' }}
                                                >
                                                    ⏰ Deadline Terdekat
                                                </option>

                                            </select>

                                        </form>


                                        {{-- KATEGORI --}}

                                        <form
                                            action="{{ route('dashboard') }}"
                                            method="GET"
                                        >

                                            {{-- Pertahankan search --}}

                                            @if ($search)

                                                <input
                                                    type="hidden"
                                                    name="search"
                                                    value="{{ $search }}"
                                                >

                                            @endif


                                            {{-- Pertahankan sorting --}}

                                            <input
                                                type="hidden"
                                                name="sort"
                                                value="{{ $sort }}"
                                            >


                                            <select
                                                name="category"
                                                onchange="this.form.submit()"
                                                class="w-full rounded-xl border border-gray-200 bg-white pl-4 pr-10 py-2.5 text-sm font-medium text-gray-600 outline-none transition focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100 sm:w-auto"
                                            >

                                                <option value="">
                                                    📂 Semua Kategori
                                                </option>


                                                @foreach ($categories as $cat)

                                                    <option
                                                        value="{{ $cat->id }}"
                                                        {{ (string) $category === (string) $cat->id ? 'selected' : '' }}
                                                    >

                                                        📁 {{ $cat->nama_kategori }}

                                                    </option>

                                                @endforeach

                                            </select>

                                        </form>


                                        {{-- RESET --}}

                                        @if ($search || $category)

                                            <a
                                                href="{{ route('dashboard', ['sort' => $sort]) }}"
                                                class="rounded-xl border border-gray-200 bg-white px-4 py-2.5 text-center text-sm font-medium text-gray-600 transition hover:bg-gray-50 hover:text-rose-600"
                                            >

                                                Reset

                                            </a>

                                        @endif

                                    </div>

                                </div>

                            </div>

                        </div>


                        {{-- ================================================= --}}
                        {{-- TASK --}}
                        {{-- ================================================= --}}

                        @forelse ($tasks as $task)

                            @php

                                $categoryName =
                                    $task->category?->nama_kategori
                                    ?? 'Tanpa kategori';

                                $isDone =
                                    $task->status === 'Selesai';

                            @endphp


                            <div
                                class="group flex items-center gap-4 border-b border-gray-50 px-6 py-4 last:border-0 transition hover:bg-gray-50/70"
                            >


                                {{-- BAR --}}

                                <span
                                    class="w-1.5 self-stretch rounded-full bg-indigo-500"
                                ></span>


                                {{-- INFO --}}

                                <div class="min-w-0 flex-1">

                                    <a
                                        href="{{ route('tasks.show', $task) }}"
                                        class="block truncate font-medium transition
                                        {{ $isDone
                                            ? 'text-gray-400 line-through'
                                            : 'text-gray-900 hover:text-indigo-600' }}"
                                    >

                                        {{ $task->judul }}

                                    </a>


                                    <span
                                        class="mt-1 inline-block rounded-full bg-indigo-50 px-2 py-0.5 text-xs font-medium text-indigo-700"
                                    >

                                        {{ $categoryName }}

                                    </span>

                                </div>


                                {{-- META --}}

                                <div class="flex shrink-0 items-center gap-3">


                                    {{-- PRIORITY --}}

                                    @if ($task->priority)

                                        @php

                                            $priorityClass = match ($task->priority) {

                                                'Rendah'
                                                    => 'bg-emerald-50 text-emerald-700',

                                                'Sedang'
                                                    => 'bg-amber-50 text-amber-700',

                                                'Tinggi'
                                                    => 'bg-rose-50 text-rose-700',

                                                default
                                                    => 'bg-gray-50 text-gray-600',

                                            };

                                        @endphp


                                        <span
                                            class="hidden rounded-full px-2.5 py-1 text-xs font-medium sm:inline-flex {{ $priorityClass }}"
                                        >

                                            {{ $task->priority }}

                                        </span>

                                    @endif


                                    {{-- DEADLINE --}}

                                    @if ($task->deadline)

                                        <span
                                            class="hidden text-xs text-gray-400 md:inline"
                                        >

                                            {{ \Carbon\Carbon::parse($task->deadline)->translatedFormat('d M') }}

                                        </span>

                                    @else

                                        <span
                                            class="hidden text-xs text-gray-400 md:inline"
                                        >

                                            Tanpa deadline

                                        </span>

                                    @endif


                                    {{-- STATUS --}}

                                    @if ($isDone)

                                        <span
                                            class="hidden rounded-full bg-emerald-50 px-2.5 py-1 text-xs font-medium text-emerald-700 lg:inline-flex"
                                        >

                                            Selesai

                                        </span>

                                    @endif


                                    {{-- DETAIL --}}

                                    <a
                                        href="{{ route('tasks.show', $task) }}"
                                        class="text-xs font-medium text-indigo-600 transition hover:text-indigo-800"
                                    >

                                        Detail

                                    </a>

                                </div>

                            </div>


                        @empty


                            {{-- EMPTY --}}

                            <div class="px-6 py-16 text-center">

                                <div
                                    class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-gray-100 text-gray-400"
                                >
                                    🔎
                                </div>


                                <p class="mt-4 font-medium text-gray-900">

                                    @if ($search || $category)

                                        Task tidak ditemukan

                                    @else

                                        Belum ada tugas

                                    @endif

                                </p>


                                <p class="mt-1 text-sm text-gray-400">

                                    @if ($search && $category)

                                        Tidak ada task yang cocok dengan
                                        "{{ $search }}"
                                        pada kategori tersebut.

                                    @elseif ($search)

                                        Tidak ada task yang cocok dengan
                                        "{{ $search }}".

                                    @elseif ($category)

                                        Tidak ada task pada kategori tersebut.

                                    @else

                                        Yuk tambahkan tugas pertamamu.

                                    @endif

                                </p>


                                @if ($search || $category)

                                    <a
                                        href="{{ route('dashboard', ['sort' => $sort]) }}"
                                        class="mt-4 inline-flex rounded-lg bg-indigo-600 px-4 py-2 text-sm font-medium text-white transition hover:bg-indigo-700"
                                    >

                                        Reset Filter

                                    </a>

                                @else

                                    <a
                                        href="{{ route('tasks.create') }}"
                                        class="mt-4 inline-flex rounded-lg bg-indigo-600 px-4 py-2 text-sm font-medium text-white transition hover:bg-indigo-700"
                                    >

                                        + Tambah Tugas

                                    </a>

                                @endif

                            </div>

                        @endforelse


                        {{-- FOOTER --}}

                        @if (!$search && !$category && $totalTasks > 5)

                            <div
                                class="border-t border-gray-100 px-6 py-4 text-center"
                            >

                                <a
                                    href="{{ route('tasks.index') }}"
                                    class="text-sm font-medium text-indigo-600 hover:text-indigo-800"
                                >

                                    Lihat semua {{ $totalTasks }} tugas →

                                </a>

                            </div>

                        @endif

                    </div>


                    {{-- ================================================= --}}
                    {{-- TIPS --}}
                    {{-- ================================================= --}}

                    <div
                        class="mt-6 rounded-2xl border border-indigo-100 bg-indigo-50 px-6 py-4"
                    >

                        <p class="text-sm font-medium text-indigo-900">
                            💡 Tips mengelola tugas
                        </p>

                        <p class="mt-1 text-sm text-indigo-700">
                            Gunakan prioritas, kategori, dan deadline untuk menentukan tugas mana yang harus dikerjakan terlebih dahulu.
                        </p>

                    </div>


                </div>

            </main>

        </div>

    </div>

</x-app-layout>