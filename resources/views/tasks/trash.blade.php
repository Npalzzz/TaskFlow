<x-app-layout>

    <div class="max-w-7xl mx-auto px-4 py-8">

        {{-- Header --}}
        <div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

            <div>
                <div class="flex items-center gap-3">
                    <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-rose-50 text-rose-500 ring-1 ring-rose-100">
                        <svg
                            class="h-6 w-6"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M6 7h12M9.5 7V5a1.5 1.5 0 011.5-1.5h2A1.5 1.5 0 0114.5 5v2m-7 0l.6 11.4a2 2 0 002 1.9h3.8a2 2 0 002-1.9L16.5 7"
                            />
                        </svg>
                    </div>

                    <div>
                        <h1 class="text-2xl font-bold tracking-tight text-gray-800">
                            Sampah
                        </h1>

                        <p class="mt-1 text-sm text-gray-500">
                            Kelola tugas yang telah dihapus sementara.
                        </p>
                    </div>
                </div>
            </div>


            {{-- Kembali --}}
            <a
                href="{{ route('tasks.index') }}"
                class="group inline-flex items-center justify-center gap-2 rounded-2xl bg-white px-5 py-3 text-sm font-semibold text-gray-600 shadow-sm ring-1 ring-gray-200 transition-all duration-300 hover:-translate-y-0.5 hover:bg-gray-50 hover:text-indigo-600 hover:ring-indigo-200"
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

                Kembali ke Tugas
            </a>

        </div>


        {{-- Success Message --}}
        @if (session('success'))

            <div class="mb-6 flex items-start gap-3 rounded-2xl border border-emerald-100 bg-emerald-50 p-4 text-emerald-700 shadow-sm">

                <div class="mt-0.5 flex h-8 w-8 shrink-0 items-center justify-center rounded-xl bg-emerald-100">
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
                            d="M5 13l4 4L19 7"
                        />
                    </svg>
                </div>

                <div>
                    <p class="text-sm font-semibold">
                        Berhasil
                    </p>

                    <p class="mt-0.5 text-sm">
                        {{ session('success') }}
                    </p>
                </div>

            </div>

        @endif


        {{-- Trash Content --}}
        @if ($tasks->count() > 0)

            {{-- Trash Summary --}}
            <div class="mb-5 flex items-center justify-between rounded-2xl bg-white px-5 py-4 shadow-sm ring-1 ring-gray-100">

                <div class="flex items-center gap-3">

                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-rose-50 text-rose-500">
                        <svg
                            class="h-5 w-5"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M6 7h12M9.5 7V5a1.5 1.5 0 011.5-1.5h2A1.5 1.5 0 0114.5 5v2m-7 0l.6 11.4a2 2 0 002 1.9h3.8a2 2 0 002-1.9L16.5 7"
                            />
                        </svg>
                    </div>

                    <div>
                        <p class="text-sm font-semibold text-gray-800">
                            Task di Sampah
                        </p>

                        <p class="text-xs text-gray-500">
                            {{ $tasks->count() }} task sedang berada di sini
                        </p>
                    </div>

                </div>

                <div class="rounded-full bg-rose-50 px-3 py-1 text-xs font-bold text-rose-600">
                    {{ $tasks->count() }}
                </div>

            </div>


            {{-- Task List --}}
            <div class="space-y-4">

                @foreach ($tasks as $task)

                    <div class="group rounded-2xl bg-white p-5 shadow-sm ring-1 ring-gray-100 transition-all duration-300 hover:-translate-y-0.5 hover:shadow-lg hover:ring-gray-200">

                        <div class="flex flex-col gap-5 lg:flex-row lg:items-center lg:justify-between">

                            {{-- Task Information --}}
                            <div class="min-w-0 flex-1">

                                <div class="flex items-start gap-4">

                                    {{-- Trash Icon --}}
                                    <div class="hidden h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-rose-50 text-rose-500 ring-1 ring-rose-100 sm:flex">
                                        <svg
                                            class="h-5 w-5"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="1.8"
                                            viewBox="0 0 24 24"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M6 7h12M9.5 7V5a1.5 1.5 0 011.5-1.5h2A1.5 1.5 0 0114.5 5v2m-7 0l.6 11.4a2 2 0 002 1.9h3.8a2 2 0 002-1.9L16.5 7"
                                            />
                                        </svg>
                                    </div>


                                    <div class="min-w-0 flex-1">

                                        {{-- Title --}}
                                        <h2 class="truncate text-lg font-bold text-gray-800">
                                            {{ $task->judul }}
                                        </h2>


                                        {{-- Meta --}}
                                        <div class="mt-2 flex flex-wrap items-center gap-2">

                                            {{-- Category --}}
                                            @if ($task->category)

                                                <span class="inline-flex items-center gap-1.5 rounded-lg bg-indigo-50 px-2.5 py-1 text-xs font-semibold text-indigo-700 ring-1 ring-indigo-100">

                                                    <svg
                                                        class="h-3.5 w-3.5"
                                                        fill="none"
                                                        stroke="currentColor"
                                                        stroke-width="1.8"
                                                        viewBox="0 0 24 24"
                                                    >
                                                        <path
                                                            stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            d="M4 7.5A2.5 2.5 0 016.5 5h3.379a2.5 2.5 0 011.768.732l6.621 6.621a2.5 2.5 0 010 3.536l-2.379 2.379a2.5 2.5 0 01-3.536 0L5.732 11.647A2.5 2.5 0 015 9.879V7.5z"
                                                        />
                                                        <path
                                                            stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            d="M8 8h.01"
                                                        />
                                                    </svg>

                                                    {{ $task->category->nama_kategori }}

                                                </span>

                                            @endif


                                            {{-- Deleted At --}}
                                            <span class="inline-flex items-center gap-1.5 rounded-lg bg-gray-50 px-2.5 py-1 text-xs font-medium text-gray-500 ring-1 ring-gray-100">

                                                <svg
                                                    class="h-3.5 w-3.5"
                                                    fill="none"
                                                    stroke="currentColor"
                                                    stroke-width="1.8"
                                                    viewBox="0 0 24 24"
                                                >
                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        d="M12 6v6l4 2"
                                                    />
                                                    <circle
                                                        cx="12"
                                                        cy="12"
                                                        r="8.5"
                                                    />
                                                </svg>

                                                Dihapus
                                                {{ $task->deleted_at->format('d M Y, H:i') }}

                                            </span>

                                        </div>


                                        {{-- Description --}}
                                        <p class="mt-3 text-xs text-gray-400">
                                            Task ini masih dapat dipulihkan atau dihapus secara permanen.
                                        </p>

                                    </div>

                                </div>

                            </div>


                            {{-- Actions --}}
                            <div class="flex shrink-0 flex-col gap-2 sm:flex-row lg:flex-col xl:flex-row">

                                {{-- Restore --}}
                                <form
                                    action="{{ route('tasks.restore', $task->id) }}"
                                    method="POST"
                                >
                                    @csrf
                                    @method('PATCH')

                                    <button
                                        type="submit"
                                        onclick="return confirm('Pulihkan tugas ini?')"
                                        class="group inline-flex w-full items-center justify-center gap-2 rounded-xl bg-emerald-50 px-4 py-2.5 text-xs font-bold text-emerald-600 ring-1 ring-emerald-100 transition-all duration-300 hover:-translate-y-0.5 hover:bg-emerald-500 hover:text-white hover:shadow-md hover:shadow-emerald-100 sm:w-auto"
                                    >
                                        <svg
                                            class="h-4 w-4 transition-transform duration-300 group-hover:-rotate-45"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="2"
                                            viewBox="0 0 24 24"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M3 12a9 9 0 109-9c-2.21 0-4.21.8-5.78 2.12L3 8.5"
                                            />
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M3 4v4.5h4.5"
                                            />
                                        </svg>

                                        Pulihkan
                                    </button>

                                </form>


                                {{-- Permanent Delete --}}
                                <form
                                    action="{{ route('tasks.forceDelete', $task->id) }}"
                                    method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus tugas ini secara permanen? Data tidak dapat dikembalikan.');"
                                >
                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="group inline-flex w-full items-center justify-center gap-2 rounded-xl bg-rose-50 px-4 py-2.5 text-xs font-bold text-rose-600 ring-1 ring-rose-100 transition-all duration-300 hover:-translate-y-0.5 hover:bg-rose-500 hover:text-white hover:shadow-md hover:shadow-rose-100 sm:w-auto"
                                    >
                                        <svg
                                            class="h-4 w-4 transition-transform duration-300 group-hover:scale-110"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="1.8"
                                            viewBox="0 0 24 24"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M6 7h12M9.5 7V5a1.5 1.5 0 011.5-1.5h2A1.5 1.5 0 0114.5 5v2m-7 0l.6 11.4a2 2 0 002 1.9h3.8a2 2 0 002-1.9L16.5 7"
                                            />
                                        </svg>

                                        Hapus Permanen
                                    </button>

                                </form>

                            </div>

                        </div>

                    </div>

                @endforeach

            </div>

        @else

            {{-- Empty Trash --}}
            <div class="relative overflow-hidden rounded-3xl bg-white px-6 py-16 text-center shadow-sm ring-1 ring-gray-100">

                {{-- Decorative Background --}}
                <div class="absolute -left-10 -top-10 h-32 w-32 rounded-full bg-rose-50 blur-2xl"></div>
                <div class="absolute -bottom-10 -right-10 h-32 w-32 rounded-full bg-indigo-50 blur-2xl"></div>


                <div class="relative">

                    {{-- Icon --}}
                    <div class="mx-auto flex h-20 w-20 items-center justify-center rounded-3xl bg-gray-50 text-gray-400 ring-1 ring-gray-100 shadow-sm">

                        <svg
                            class="h-9 w-9"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.5"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M6 7h12M9.5 7V5a1.5 1.5 0 011.5-1.5h2A1.5 1.5 0 0114.5 5v2m-7 0l.6 11.4a2 2 0 002 1.9h3.8a2 2 0 002-1.9L16.5 7"
                            />
                        </svg>

                    </div>


                    <h2 class="mt-6 text-xl font-bold text-gray-800">
                        Sampah masih kosong
                    </h2>

                    <p class="mx-auto mt-2 max-w-md text-sm leading-6 text-gray-500">
                        Belum ada task yang dipindahkan ke sampah.
                        Task yang kamu hapus sementara akan muncul di halaman ini.
                    </p>


                    <a
                        href="{{ route('tasks.index') }}"
                        class="mt-6 inline-flex items-center gap-2 rounded-2xl bg-indigo-500 px-5 py-3 text-sm font-semibold text-white shadow-sm transition-all duration-300 hover:-translate-y-0.5 hover:bg-indigo-400 hover:shadow-[0_0_30px_rgba(99,102,241,0.25)]"
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

                        Kembali ke Task
                    </a>

                </div>

            </div>

        @endif

    </div>

</x-app-layout>