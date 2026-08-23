<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Edit Kategori - TaskFlow</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 text-gray-900">

<div class="min-h-screen py-10">

    <div class="mx-auto max-w-3xl px-6">

        {{-- ========================================================= --}}
        {{-- TOP NAVIGATION --}}
        {{-- ========================================================= --}}

        <div class="mb-6">

            <a
                href="{{ route('categories.index') }}"
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

                Kembali ke Kategori

            </a>

        </div>


        {{-- ========================================================= --}}
        {{-- HEADER --}}
        {{-- ========================================================= --}}

        <div
            class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-slate-950 via-slate-900 to-indigo-950 p-6 text-white shadow-xl shadow-indigo-950/10 md:p-8"
        >

            <div
                class="relative z-10 flex flex-col gap-6 sm:flex-row sm:items-center sm:justify-between"
            >

                {{-- Text --}}

                <div>

                    <p class="text-sm font-medium uppercase tracking-wider text-indigo-300">
                        Pengaturan kategori
                    </p>

                    <h1 class="mt-2 text-3xl font-bold tracking-tight text-white">
                        Edit Kategori
                    </h1>

                    <p class="mt-2 max-w-xl text-sm leading-6 text-slate-300 md:text-base">
                        Ubah nama kategori sesuai kebutuhanmu agar tugas tetap terorganisir.
                    </p>

                </div>


                {{-- Icon --}}

                <div
                    class="flex h-16 w-16 shrink-0 items-center justify-center rounded-2xl bg-indigo-500/20 text-3xl backdrop-blur-sm ring-1 ring-white/10"
                >
                    ✏️
                </div>

            </div>


            {{-- Decorative circles --}}

            <div
                class="absolute -right-10 -top-16 h-52 w-52 rounded-full bg-indigo-500/10"
            ></div>

            <div
                class="absolute -bottom-24 right-24 h-48 w-48 rounded-full bg-violet-500/10"
            ></div>

            <div
                class="absolute -left-20 bottom-[-100px] h-44 w-44 rounded-full bg-indigo-400/5"
            ></div>

        </div>


        {{-- ========================================================= --}}
        {{-- CARD --}}
        {{-- ========================================================= --}}

        <div
            class="mt-6 overflow-hidden rounded-3xl border border-gray-100 bg-white shadow-sm"
        >

            {{-- ===================================================== --}}
            {{-- CARD HEADER --}}
            {{-- ===================================================== --}}

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
                                d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13l-3.68 1.105 1.105-3.68a4.5 4.5 0 011.13-1.897l9.622-9.622z"
                            />

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M19.5 7.125L16.875 4.5"
                            />
                        </svg>

                    </div>


                    <div>

                        <h2 class="font-semibold text-gray-900">
                            Informasi Kategori
                        </h2>

                        <p class="text-xs text-gray-400">
                            Perbarui nama kategori yang digunakan untuk mengelompokkan tugas.
                        </p>

                    </div>

                </div>

            </div>


            {{-- ===================================================== --}}
            {{-- FORM --}}
            {{-- ===================================================== --}}

            <form
                action="{{ route('categories.update', $category) }}"
                method="POST"
                class="px-6 py-6"
            >

                @csrf
                @method('PUT')


                {{-- ================================================= --}}
                {{-- NAMA KATEGORI --}}
                {{-- ================================================= --}}

                <div>

                    <label
                        for="nama_kategori"
                        class="block text-sm font-medium text-gray-700"
                    >
                        Nama Kategori
                    </label>

                    <p class="mt-1 text-xs text-gray-400">
                        Gunakan nama yang singkat dan mudah dikenali.
                    </p>


                    <input
                        type="text"
                        id="nama_kategori"
                        name="nama_kategori"
                        value="{{ old('nama_kategori', $category->nama_kategori) }}"
                        required
                        maxlength="255"
                        autofocus
                        autocomplete="off"
                        class="mt-3 block w-full rounded-xl border-gray-200 px-4 py-3 text-sm shadow-sm outline-none transition placeholder:text-gray-400 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100"
                    >


                    @error('nama_kategori')

                        <div class="mt-2 flex items-center gap-2">

                            <svg
                                class="h-4 w-4 shrink-0 text-rose-500"
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

                            <p class="text-sm text-rose-600">
                                {{ $message }}
                            </p>

                        </div>

                    @enderror

                </div>


                {{-- ================================================= --}}
                {{-- CATEGORY PREVIEW --}}
                {{-- ================================================= --}}

                <div class="mt-6 rounded-2xl border border-indigo-100 bg-indigo-50/70 p-4">

                    <div class="flex items-start gap-3">

                        <div
                            class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-white text-indigo-600 shadow-sm"
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

                            <p class="text-sm font-semibold text-indigo-950">
                                Kategori saat ini
                            </p>

                            <p class="mt-1 text-sm text-indigo-700">
                                Kamu sedang mengubah kategori
                                <span class="font-semibold">
                                    "{{ $category->nama_kategori }}"
                                </span>.
                            </p>

                        </div>

                    </div>

                </div>


                {{-- ================================================= --}}
                {{-- BUTTONS --}}
                {{-- ================================================= --}}

                <div class="mt-6 flex flex-col-reverse gap-3 sm:flex-row sm:items-center sm:justify-end">

                    {{-- Batal --}}

                    <a
                        href="{{ route('categories.index') }}"
                        class="inline-flex items-center justify-center gap-2 rounded-xl bg-gray-100 px-5 py-3 text-sm font-semibold text-gray-600 transition hover:bg-gray-200 hover:text-gray-700"
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
                                d="M6 18L18 6M6 6l12 12"
                            />
                        </svg>

                        Batal

                    </a>


                    {{-- Simpan --}}

                    <button
                        type="submit"
                        class="inline-flex items-center justify-center gap-2 rounded-xl bg-indigo-600 px-5 py-3 text-sm font-semibold text-white shadow-sm shadow-indigo-500/20 transition hover:-translate-y-0.5 hover:bg-indigo-700 hover:shadow-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
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
                                d="M5 13l4 4L19 7"
                            />
                        </svg>

                        Simpan Perubahan

                    </button>

                </div>

            </form>

        </div>


        {{-- ========================================================= --}}
        {{-- INFORMATION --}}
        {{-- ========================================================= --}}

        <div
            class="mt-6 rounded-2xl border border-indigo-100 bg-indigo-50/70 px-5 py-4"
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

                    <p class="text-sm font-semibold text-indigo-950">
                        Tips kategori
                    </p>

                    <p class="mt-1 text-sm leading-6 text-indigo-700">
                        Gunakan nama kategori yang jelas seperti Sekolah, Proyek, atau Pribadi agar tugas lebih mudah ditemukan dan dikelola.
                    </p>

                </div>

            </div>

        </div>

    </div>

</div>

</body>

</html>

