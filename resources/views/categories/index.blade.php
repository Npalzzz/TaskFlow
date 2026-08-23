<x-app-layout>

    <div class="min-h-screen bg-gray-50">

        <div class="mx-auto max-w-5xl px-6 py-8">

            {{-- ========================================================= --}}
            {{-- TOP NAVIGATION --}}
            {{-- ========================================================= --}}

            <div class="flex items-center justify-between">

                <a
                    href="{{ route('dashboard') }}"
                    class="inline-flex items-center gap-2 rounded-xl bg-white px-4 py-2.5 text-sm font-semibold text-gray-600 shadow-sm ring-1 ring-gray-100 transition hover:bg-gray-50 hover:text-indigo-600"
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
                            d="M15 19l-7-7 7-7"
                        />
                    </svg>

                    Dashboard

                </a>

            </div>


            {{-- ========================================================= --}}
            {{-- HERO --}}
            {{-- ========================================================= --}}

            <section
    class="relative mt-6 overflow-hidden rounded-3xl bg-gradient-to-br from-slate-950 via-slate-900 to-indigo-950 p-6 text-white shadow-sm md:p-8"
>

                <div class="relative z-10 flex flex-col justify-between gap-6 sm:flex-row sm:items-center">

                    <div>

                       <p class="text-sm font-medium uppercase tracking-wider text-indigo-300">
    TaskFlow
</p>

<h1 class="mt-2 text-3xl font-bold tracking-tight text-white">
    Kelola Kategori
</h1>

<p class="mt-2 max-w-xl text-sm leading-6 text-slate-300 md:text-base">
    Atur kategori tugas agar semua pekerjaanmu lebih terorganisir.
</p>

                    </div>


                    {{-- Icon --}}
                    <div
                        class="flex h-16 w-16 shrink-0 items-center justify-center rounded-2xl bg-white/15 text-3xl backdrop-blur-sm"
                    >
                        🗂️
                    </div>

                </div>


                {{-- Decorative circles --}}
                <div
    class="absolute -right-10 -top-16 h-52 w-52 rounded-full bg-indigo-500/10"
></div>

<div
    class="absolute -bottom-24 right-24 h-48 w-48 rounded-full bg-violet-500/10"
></div>

            </section>


            {{-- ========================================================= --}}
            {{-- SUCCESS MESSAGE --}}
            {{-- ========================================================= --}}

            @if (session('success'))

                <div
                    class="mt-6 flex items-center gap-3 rounded-2xl border border-emerald-100 bg-emerald-50 px-5 py-4 text-emerald-700 shadow-sm"
                >

                    <div
                        class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-emerald-100 text-emerald-600"
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
                                d="M5 13l4 4L19 7"
                            />
                        </svg>

                    </div>

                    <p class="text-sm font-medium">
                        {{ session('success') }}
                    </p>

                </div>

            @endif


            {{-- ========================================================= --}}
            {{-- VALIDATION ERROR --}}
            {{-- ========================================================= --}}

            @if ($errors->any())

                <div
                    class="mt-6 rounded-2xl border border-rose-100 bg-rose-50 px-5 py-4 text-rose-700 shadow-sm"
                >

                    <p class="text-sm font-semibold">
                        Terjadi kesalahan:
                    </p>

                    <ul class="mt-2 list-inside list-disc text-sm">

                        @foreach ($errors->all() as $error)

                            <li>
                                {{ $error }}
                            </li>

                        @endforeach

                    </ul>

                </div>

            @endif


            {{-- ========================================================= --}}
            {{-- ADD CATEGORY --}}
            {{-- ========================================================= --}}

            <section
                class="mt-6 overflow-hidden rounded-2xl border border-gray-100 bg-white shadow-sm"
            >

                <div class="border-b border-gray-100 px-6 py-5">

                    <div class="flex items-center gap-3">

                        <div
                            class="flex h-10 w-10 items-center justify-center rounded-xl bg-indigo-50 text-indigo-600"
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

                        </div>

                        <div>

                            <h2 class="font-semibold text-gray-900">
                                Tambah Kategori
                            </h2>

                            <p class="text-xs text-gray-400">
                                Buat kategori baru untuk mengelompokkan tugas.
                            </p>

                        </div>

                    </div>

                </div>


                <div class="px-6 py-6">

                    <form
                        action="{{ route('categories.store') }}"
                        method="POST"
                        class="flex flex-col gap-3 sm:flex-row"
                    >

                        @csrf

                        <input
                            type="text"
                            name="nama_kategori"
                            value="{{ old('nama_kategori') }}"
                            placeholder="Contoh: Sekolah, Proyek, Pribadi..."
                            class="flex-1 rounded-xl border-gray-200 px-4 py-3 text-sm shadow-sm outline-none transition focus:border-indigo-500 focus:ring-indigo-500"
                        >

                        <button
                            type="submit"
                            class="inline-flex items-center justify-center gap-2 rounded-xl bg-indigo-600 px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-indigo-700 hover:shadow-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
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

                            Tambah Kategori

                        </button>

                    </form>

                </div>

            </section>


            {{-- ========================================================= --}}
            {{-- CATEGORY SUMMARY --}}
            {{-- ========================================================= --}}

            <div class="mt-7 flex flex-col justify-between gap-4 sm:flex-row sm:items-end">

                <div>

                    <p class="text-sm font-medium text-indigo-600">
                        Organisasi tugas
                    </p>

                    <h2 class="mt-1 text-xl font-bold tracking-tight text-gray-900">
                        Semua Kategori
                    </h2>

                    <p class="mt-1 text-sm text-gray-500">
                        Berikut adalah kategori yang tersedia dan kamu buat di TaskFlow.
                    </p>

                </div>


                <div
                    class="inline-flex w-fit items-center gap-2 rounded-full bg-white px-4 py-2 text-sm font-medium text-gray-600 shadow-sm ring-1 ring-gray-100"
                >

                    <span class="h-2 w-2 rounded-full bg-indigo-500"></span>

                    {{ $categories->count() }} kategori

                </div>

            </div>


            {{-- ========================================================= --}}
            {{-- CATEGORY LIST --}}
            {{-- ========================================================= --}}

            <section
                class="mt-5 overflow-hidden rounded-2xl border border-gray-100 bg-white shadow-sm"
            >

                {{-- Header --}}
                <div
                    class="flex items-center justify-between border-b border-gray-100 px-6 py-5"
                >

                    <div class="flex items-center gap-3">

                        <div
                            class="flex h-10 w-10 items-center justify-center rounded-xl bg-indigo-50 text-indigo-600"
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

                        </div>

                        <div>

                            <h3 class="font-semibold text-gray-900">
                                Daftar Kategori
                            </h3>

                            <p class="text-xs text-gray-400">
                                Kelola kategori yang tersedia
                            </p>

                        </div>

                    </div>


                    <span
                        class="hidden rounded-full bg-gray-100 px-3 py-1 text-xs font-medium text-gray-500 sm:inline-block"
                    >
                        {{ $categories->count() }} data
                    </span>

                </div>


                {{-- ===================================================== --}}
                {{-- CATEGORY ITEMS --}}
                {{-- ===================================================== --}}

                @forelse ($categories as $category)

                    <div
                        class="group border-b border-gray-50 px-6 py-5 transition duration-200 last:border-0 hover:bg-indigo-50/30"
                    >

                        <div
                            class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between"
                        >

                            {{-- Category information --}}
                            <div class="flex min-w-0 items-center gap-4">

                                <div
                                    class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-indigo-50 font-bold text-indigo-600 transition group-hover:bg-indigo-100"
                                >
                                    {{ strtoupper(substr($category->nama_kategori, 0, 1)) }}
                                </div>


                                <div class="min-w-0">

                                    <h4 class="truncate font-semibold text-gray-900">
                                        {{ $category->nama_kategori }}
                                    </h4>

                                    <p class="mt-1 text-xs text-gray-400">
                                        Kategori #{{ $category->id }}
                                    </p>

                                </div>

                            </div>


                            {{-- Actions --}}
                            <div class="flex items-center gap-2">

                                {{-- Edit --}}
                                <a
                                    href="{{ route('categories.edit', $category) }}"
                                    title="Edit kategori"
                                    class="inline-flex h-9 items-center gap-2 rounded-lg bg-amber-50 px-3 text-xs font-semibold text-amber-600 transition hover:bg-amber-100"
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


                                {{-- Delete --}}
                                <form
                                    action="{{ route('categories.destroy', $category) }}"
                                    method="POST"
                                    onsubmit="return confirm('Kategori ini memiliki ' + {{ $category->tasks_count }} + ' task.\n\nMenghapus kategori juga akan menghapus seluruh task di dalamnya.\n\nApakah kamu yakin ingin menghapus kategori ini?');"
                                >

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        title="Hapus kategori"
                                        class="inline-flex h-9 items-center gap-2 rounded-lg bg-rose-50 px-3 text-xs font-semibold text-rose-600 transition hover:bg-rose-100"
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

                    </div>

                @empty

                    {{-- Empty state --}}
                    <div
                        class="flex flex-col items-center justify-center px-6 py-16 text-center"
                    >

                        <div
                            class="flex h-16 w-16 items-center justify-center rounded-2xl bg-indigo-50 text-indigo-500"
                        >

                            <svg
                                class="h-8 w-8"
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

                        </div>

                        <h3 class="mt-5 font-semibold text-gray-900">
                            Belum ada kategori
                        </h3>

                        <p class="mt-1 max-w-sm text-sm text-gray-400">
                            Tambahkan kategori pertama untuk mulai mengelompokkan tugasmu.
                        </p>

                    </div>

                @endforelse

            </section>


            {{-- ========================================================= --}}
            {{-- INFORMATION --}}
            {{-- ========================================================= --}}

            <section
                class="mt-6 rounded-2xl border border-indigo-100 bg-indigo-50 px-6 py-5"
            >

                <div class="flex items-start gap-3">

                    <div
                        class="mt-0.5 flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-white text-indigo-600 shadow-sm"
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
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                            />
                        </svg>

                    </div>

                    <div>

                        <p class="text-sm font-semibold text-indigo-900">
                            Tips kategori
                        </p>

                        <p class="mt-1 text-sm leading-6 text-indigo-700">
                            Gunakan kategori yang jelas seperti Sekolah, Proyek, dan Pribadi agar tugas lebih mudah dikelola.
                        </p>

                    </div>

                </div>

            </section>

        </div>

    </div>

</x-app-layout>