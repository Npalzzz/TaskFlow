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

    <div class="mx-auto max-w-2xl px-6">

        {{-- Kembali --}}
        <a
            href="{{ route('categories.index') }}"
            class="inline-flex items-center gap-2 text-sm font-medium text-gray-500 transition hover:text-indigo-600"
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


        {{-- Card --}}
        <div class="mt-6 overflow-hidden rounded-2xl border border-gray-100 bg-white shadow-sm">

            {{-- Header --}}
            <div class="border-b border-gray-100 px-6 py-6">

                <p class="text-sm font-medium text-indigo-600">
                    TaskFlow
                </p>

                <h1 class="mt-1 text-2xl font-bold text-gray-900">
                    Edit Kategori
                </h1>

                <p class="mt-1 text-sm text-gray-500">
                    Ubah nama kategori sesuai kebutuhanmu.
                </p>

            </div>


            {{-- Form --}}
            <form
                action="{{ route('categories.update', $category) }}"
                method="POST"
                class="px-6 py-6"
            >

                @csrf
                @method('PUT')


                <div>

                    <label
                        for="nama_kategori"
                        class="block text-sm font-medium text-gray-700"
                    >
                        Nama Kategori
                    </label>

                    <input
                        type="text"
                        id="nama_kategori"
                        name="nama_kategori"
                        value="{{ old('nama_kategori', $category->nama_kategori) }}"
                        required
                        maxlength="255"
                        class="mt-2 w-full rounded-xl border-gray-200 px-4 py-3 text-sm shadow-sm outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100"
                    >

                    @error('nama_kategori')
                        <p class="mt-2 text-sm text-rose-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- Tombol --}}
                <div class="mt-6 flex items-center justify-end gap-3">

                    <a
                        href="{{ route('categories.index') }}"
                        class="rounded-xl bg-gray-100 px-4 py-2.5 text-sm font-semibold text-gray-600 transition hover:bg-gray-200"
                    >
                        Batal
                    </a>

                    <button
                        type="submit"
                        class="rounded-xl bg-indigo-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-indigo-700"
                    >
                        Simpan Perubahan
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

</body>
</html>