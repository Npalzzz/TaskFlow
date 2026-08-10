<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between gap-4">
            <div>
                <p class="text-sm font-medium text-indigo-600">
                    TaskFlow
                </p>

                <h2 class="mt-1 text-2xl font-bold text-gray-900">
                    Dashboard
                </h2>
            </div>

            <a
                href="{{ route('tasks.create') }}"
                class="hidden items-center gap-2 rounded-xl bg-indigo-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-indigo-700 sm:inline-flex"
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
                        d="M12 4.5v15m7.5-7.5h-15"
                    />
                </svg>

                Tambah Tugas
            </a>
        </div>
    </x-slot>

    @php
        $totalTasks = $totalTasks ?? 0;
        $completedTasks = $completedTasks ?? 0;
        $dueSoonCount = $dueSoonCount ?? 0;
        $tasks = $tasks ?? collect();

        // Hanya tampilkan maksimal 5 task di dashboard.
        // Semua task tetap bisa dilihat melalui halaman tasks.index.
        $recentTasks = $tasks->take(5);

        $categoryStyles = [
            'Sekolah' => [
                'bar' => 'bg-indigo-500',
                'badge' => 'bg-indigo-50 text-indigo-700',
            ],
            'Proyek' => [
                'bar' => 'bg-violet-500',
                'badge' => 'bg-violet-50 text-violet-700',
            ],
            'Pribadi' => [
                'bar' => 'bg-teal-500',
                'badge' => 'bg-teal-50 text-teal-700',
            ],
        ];

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
    @endphp

    <div class="min-h-screen bg-gray-50 py-8">
        <div class="mx-auto max-w-7xl space-y-6 px-6">

            {{-- Sapaan pengguna --}}
            <div class="relative overflow-hidden rounded-2xl bg-gradient-to-br from-indigo-600 via-indigo-600 to-violet-700 p-6 text-white shadow-sm md:p-8">
                <div class="relative z-10 flex flex-col justify-between gap-6 md:flex-row md:items-center">
                    <div>
                        <p class="text-sm font-medium text-indigo-100">
                            Selamat datang kembali
                        </p>

                        <h1 class="mt-2 text-3xl font-bold tracking-tight md:text-4xl">
                            Halo, {{ Auth::user()->name }}!
                        </h1>

                        <p class="mt-3 max-w-2xl text-sm text-indigo-100 md:text-base">
                            Kelola tugas sekolah, proyek, dan aktivitas pribadi dengan lebih teratur.
                        </p>

                        <a
                            href="{{ route('tasks.create') }}"
                            class="mt-5 inline-flex items-center gap-2 rounded-xl bg-white px-4 py-2.5 text-sm font-semibold text-indigo-700 transition hover:bg-indigo-50 sm:hidden"
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
                                    d="M12 4.5v15m7.5-7.5h-15"
                                />
                            </svg>

                            Tambah Tugas
                        </a>
                    </div>

                    <div class="flex h-16 w-16 shrink-0 items-center justify-center rounded-2xl bg-white/15 text-4xl backdrop-blur-sm">
                        📚
                    </div>
                </div>

                <div class="absolute -right-10 -top-16 h-52 w-52 rounded-full bg-white/10"></div>
                <div class="absolute -bottom-24 right-24 h-48 w-48 rounded-full bg-violet-400/20"></div>
            </div>

            {{-- Peringatan deadline --}}
            @if ($dueSoonCount > 0)
                <div class="flex items-center gap-3 rounded-2xl border border-rose-100 bg-rose-50 px-5 py-4 text-rose-700 shadow-sm">
                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-rose-100 text-rose-600">
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
                                d="M12 9v3.75m0 3.75h.007M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                            />
                        </svg>
                    </div>

                    <div>
                        <p class="font-semibold">
                            Perlu perhatian
                        </p>

                        <p class="text-sm text-rose-600">
                            Kamu punya {{ $dueSoonCount }} tugas yang mendekati deadline.
                        </p>
                    </div>
                </div>
            @else
                <div class="flex items-center gap-3 rounded-2xl border border-emerald-100 bg-emerald-50 px-5 py-4 text-emerald-700 shadow-sm">
                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-emerald-100 text-emerald-600">
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

                    <div>
                        <p class="font-semibold">
                            Semua aman
                        </p>

                        <p class="text-sm text-emerald-600">
                            Tidak ada deadline mendesak untuk saat ini.
                        </p>
                    </div>
                </div>
            @endif

            {{-- Statistik --}}
            <div class="grid grid-cols-1 gap-5 md:grid-cols-3">

                {{-- Total tugas --}}
                <div class="group rounded-2xl border border-gray-100 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-md">
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <p class="text-sm font-medium text-gray-500">
                                Total Tugas
                            </p>

                            <p class="mt-2 text-3xl font-bold text-gray-900">
                                {{ $totalTasks }}
                            </p>

                            <p class="mt-2 text-xs text-gray-400">
                                Semua tugasmu
                            </p>
                        </div>

                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-indigo-50 text-indigo-600 transition group-hover:bg-indigo-600 group-hover:text-white">
                            <svg
                                class="h-6 w-6"
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
                    </div>
                </div>

                {{-- Tugas selesai --}}
                <div class="group rounded-2xl border border-gray-100 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-md">
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <p class="text-sm font-medium text-gray-500">
                                Sudah Selesai
                            </p>

                            <p class="mt-2 text-3xl font-bold text-gray-900">
                                {{ $completedTasks }}
                            </p>

                            <p class="mt-2 text-xs text-gray-400">
                                Tugas yang selesai
                            </p>
                        </div>

                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600 transition group-hover:bg-emerald-600 group-hover:text-white">
                            <svg
                                class="h-6 w-6"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M9 12.75l2.25 2.25L15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                                />
                            </svg>
                        </div>
                    </div>
                </div>

                {{-- Deadline --}}
                <div class="group rounded-2xl border border-gray-100 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-md">
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <p class="text-sm font-medium text-gray-500">
                                Deadline H-1
                            </p>

                            <p class="mt-2 text-3xl font-bold text-gray-900">
                                {{ $dueSoonCount }}
                            </p>

                            <p class="mt-2 text-xs text-gray-400">
                                Tugas yang mendesak
                            </p>
                        </div>

                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-rose-50 text-rose-600 transition group-hover:bg-rose-600 group-hover:text-white">
                            <svg
                                class="h-6 w-6"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M12 6v6l4 2M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                                />
                            </svg>
                        </div>
                    </div>
                </div>

            </div>

            {{-- Daftar beberapa task terbaru --}}
            <div class="overflow-hidden rounded-2xl border border-gray-100 bg-white shadow-sm">

                {{-- Header daftar --}}
                <div class="flex flex-col gap-4 border-b border-gray-100 px-6 py-5 sm:flex-row sm:items-center sm:justify-between">
                    <div class="flex items-center gap-3">
                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-indigo-50 text-indigo-600">
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
                            <h3 class="font-semibold text-gray-900">
                                Task Terbaru
                            </h3>

                            <p class="text-xs text-gray-400">
                                Menampilkan maksimal 5 task terbaru
                            </p>
                        </div>

                        <span class="rounded-full bg-gray-100 px-2.5 py-1 text-xs font-medium text-gray-500">
                            {{ $totalTasks }}
                        </span>
                    </div>

                    <div class="flex flex-wrap items-center gap-2">
                        <a
                            href="{{ route('tasks.index') }}"
                            class="inline-flex items-center gap-1.5 rounded-lg border border-indigo-200 bg-indigo-50 px-3 py-2 text-sm font-medium text-indigo-700 transition hover:bg-indigo-100"
                        >
                            Lihat semua task

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
                                    d="M9 5l7 7-7 7"
                                />
                            </svg>
                        </a>

                        <a
                            href="{{ route('tasks.create') }}"
                            class="inline-flex items-center gap-1.5 rounded-lg bg-indigo-600 px-3 py-2 text-sm font-medium text-white transition hover:bg-indigo-700"
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
                                    d="M12 4.5v15m7.5-7.5h-15"
                                />
                            </svg>

                            Tambah task
                        </a>
                    </div>
                </div>

                {{-- Isi daftar task --}}
                @forelse ($recentTasks as $task)
                    @php
                        $categoryName = $task->category?->nama_kategori ?? 'Tanpa kategori';

                        $cat = $categoryStyles[$categoryName] ?? [
                            'bar' => 'bg-gray-300',
                            'badge' => 'bg-gray-50 text-gray-600',
                        ];

                        $prio = $priorityStyles[$task->priority] ?? null;

                        $isDone = $task->status === 'Selesai';
                    @endphp

                    <div class="group flex items-center gap-4 border-b border-gray-50 px-6 py-4 transition last:border-0 hover:bg-gray-50/70">

                        {{-- Garis kategori --}}
                        <span class="w-1.5 self-stretch rounded-full {{ $cat['bar'] }}"></span>

                        {{-- Informasi task --}}
                        <div class="min-w-0 flex-1">
                            <a
                                href="{{ route('tasks.show', $task) }}"
                                class="block truncate font-medium text-gray-900 transition hover:text-indigo-600 {{ $isDone ? 'line-through text-gray-400' : '' }}"
                            >
                                {{ $task->judul }}
                            </a>

                            <span class="mt-1 inline-block rounded-full px-2 py-0.5 text-xs font-medium {{ $cat['badge'] }}">
                                {{ $categoryName }}
                            </span>
                        </div>

                        {{-- Detail task --}}
                        <div class="flex shrink-0 items-center gap-2">

                            {{-- Prioritas --}}
                            @if ($prio)
                                <span class="inline-flex items-center gap-1.5 rounded-full px-2.5 py-1 text-xs font-medium {{ $prio['text'] }} {{ $prio['bg'] }}">
                                    <span class="h-1.5 w-1.5 rounded-full {{ $prio['dot'] }}"></span>

                                    {{ ucfirst(strtolower($task->priority)) }}
                                </span>
                            @endif

                            {{-- Deadline --}}
                            <span class="hidden text-xs text-gray-400 sm:inline">
                                @if ($task->deadline)
                                    {{ \Carbon\Carbon::parse($task->deadline)->translatedFormat('d M') }}
                                @else
                                    Tanpa deadline
                                @endif
                            </span>

                            {{-- Status --}}
                            @if ($isDone)
                                <span class="hidden rounded-full bg-emerald-50 px-2.5 py-1 text-xs font-medium text-emerald-700 sm:inline-flex">
                                    Selesai
                                </span>
                            @endif

                            {{-- Detail --}}
                            <a
                                href="{{ route('tasks.show', $task) }}"
                                class="text-xs font-medium text-indigo-600 transition hover:text-indigo-800"
                            >
                                Detail
                            </a>
                        </div>
                    </div>

                @empty
                    {{-- Tampilan jika belum ada task --}}
                    <div class="flex flex-col items-center justify-center px-6 py-16 text-center">
                        <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-indigo-50 text-indigo-500">
                            <svg
                                class="h-7 w-7"
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

                        <p class="mt-4 font-medium text-gray-900">
                            Belum ada tugas
                        </p>

                        <p class="mt-1 text-sm text-gray-400">
                            Yuk tambahkan tugas pertamamu supaya tidak kelewat deadline.
                        </p>

                        <a
                            href="{{ route('tasks.create') }}"
                            class="mt-4 inline-flex items-center gap-1.5 rounded-lg bg-indigo-600 px-4 py-2 text-sm font-medium text-white transition hover:bg-indigo-700"
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
                                    d="M12 4.5v15m7.5-7.5h-15"
                                />
                            </svg>

                            Tambah Tugas Baru
                        </a>
                    </div>
                @endforelse

                {{-- Tombol lihat semua di bagian bawah --}}
                @if ($tasks->count() > 5)
                    <div class="border-t border-gray-100 bg-gray-50 px-6 py-4 text-center">
                        <a
                            href="{{ route('tasks.index') }}"
                            class="inline-flex items-center gap-2 text-sm font-semibold text-indigo-600 transition hover:text-indigo-800"
                        >
                            Lihat semua {{ $tasks->count() }} task

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
                                    d="M9 5l7 7-7 7"
                                />
                            </svg>
                        </a>
                    </div>
                @endif

            </div>

            {{-- Informasi bawah --}}
            <div class="rounded-2xl border border-indigo-100 bg-indigo-50 px-6 py-4">
                <div class="flex items-start gap-3">
                    <div class="mt-0.5 text-indigo-600">
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
                        <p class="text-sm font-medium text-indigo-900">
                            Tips mengelola tugas
                        </p>

                        <p class="mt-1 text-sm text-indigo-700">
                            Gunakan prioritas dan deadline agar semua tugas lebih mudah dipantau.
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>