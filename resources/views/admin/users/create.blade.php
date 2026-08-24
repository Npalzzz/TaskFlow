<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <p class="text-sm font-semibold text-indigo-600">
                    TaskFlow Admin
                </p>

                <h2 class="mt-1 text-2xl font-bold tracking-tight text-gray-900">
                    Tambah Pengguna
                </h2>

                <p class="mt-1 text-sm text-gray-500">
                    Tambahkan akun admin atau pengguna baru ke TaskFlow.
                </p>
            </div>

            <a
                href="{{ url('/admin/users') }}"
                class="inline-flex w-fit items-center gap-2 rounded-xl border border-gray-200 bg-white px-4 py-2.5 text-sm font-medium text-gray-600 shadow-sm transition hover:border-indigo-200 hover:bg-indigo-50 hover:text-indigo-700"
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

                Kembali
            </a>
        </div>
    </x-slot>

    <div class="min-h-screen bg-gray-50 py-8">
        <div class="mx-auto w-full max-w-4xl px-4 sm:px-6 lg:px-8">

           {{-- Banner --}}
<div class="relative mb-6 overflow-hidden rounded-3xl bg-gradient-to-br from-gray-900 via-slate-900 to-indigo-950 px-6 py-7 text-white shadow-sm sm:px-8">
    <div class="relative z-10 flex items-center gap-4">
        <div class="flex h-16 w-16 shrink-0 items-center justify-center rounded-2xl bg-white/10 text-3xl backdrop-blur-sm border border-white/5">
            +
        </div>

        <div>
            <p class="text-sm font-medium text-indigo-200">
                Akun baru TaskFlow
            </p>

            <h1 class="mt-1 text-2xl font-bold">
                Tambah Pengguna
            </h1>

            <p class="mt-1 text-sm text-indigo-200/80">
                Isi informasi akun dengan lengkap dan benar.
            </p>
        </div>
    </div>

    <!-- Dekorasi Lingkaran -->
    <div class="absolute -right-16 -top-20 h-56 w-56 rounded-full bg-white/5"></div>
    <div class="absolute -bottom-28 right-20 h-48 w-48 rounded-full bg-indigo-500/10"></div>
</div>
            {{-- Error umum --}}
            @if ($errors->any())
                <div class="mb-6 rounded-2xl border border-rose-100 bg-rose-50 px-5 py-4 text-rose-700 shadow-sm">
                    <div class="flex items-start gap-3">
                        <svg
                            class="mt-0.5 h-5 w-5 shrink-0"
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

                        <div>
                            <p class="font-semibold">
                                Data belum dapat disimpan
                            </p>

                            <ul class="mt-1 list-inside list-disc text-sm">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif

            {{-- Form --}}
            <div class="overflow-hidden rounded-3xl border border-gray-100 bg-white shadow-sm">

                {{-- Header form --}}
                <div class="border-b border-gray-100 px-6 py-6 sm:px-8">
                    <div class="flex items-start gap-4">
                        <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-indigo-50 text-indigo-600">
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
                            <h3 class="text-lg font-bold text-gray-900">
                                Informasi Akun
                            </h3>

                            <p class="mt-1 text-sm text-gray-500">
                                Lengkapi data berikut untuk membuat pengguna baru.
                            </p>
                        </div>
                    </div>
                </div>

                <form
                    method="POST"
                    action="{{ route('admin.users.store') }}"
                >
                    @csrf

                    <div class="space-y-6 px-6 py-7 sm:px-8">

                        {{-- Nama --}}
                        <div>
                            <label
                                for="name"
                                class="mb-2 block text-sm font-semibold text-gray-700"
                            >
                                Nama Lengkap
                            </label>

                            <input
                                type="text"
                                id="name"
                                name="name"
                                value="{{ old('name') }}"
                                required
                                autofocus
                                autocomplete="name"
                                placeholder="Masukkan nama lengkap pengguna"
                                class="block w-full rounded-xl border-gray-200 bg-gray-50 px-4 py-3 text-sm text-gray-900 placeholder-gray-400 shadow-sm transition focus:border-indigo-500 focus:bg-white focus:ring-indigo-500 @error('name') border-rose-300 focus:border-rose-500 focus:ring-rose-500 @enderror"
                            >

                            @error('name')
                                <p class="mt-2 text-sm text-rose-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- Email --}}
                        <div>
                            <label
                                for="email"
                                class="mb-2 block text-sm font-semibold text-gray-700"
                            >
                                Alamat Email
                            </label>

                            <input
                                type="email"
                                id="email"
                                name="email"
                                value="{{ old('email') }}"
                                required
                                autocomplete="email"
                                placeholder="contoh@email.com"
                                class="block w-full rounded-xl border-gray-200 bg-gray-50 px-4 py-3 text-sm text-gray-900 placeholder-gray-400 shadow-sm transition focus:border-indigo-500 focus:bg-white focus:ring-indigo-500 @error('email') border-rose-300 focus:border-rose-500 focus:ring-rose-500 @enderror"
                            >

                            @error('email')
                                <p class="mt-2 text-sm text-rose-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- Role --}}
                        <div>
                            <label
                                for="role"
                                class="mb-2 block text-sm font-semibold text-gray-700"
                            >
                                Role Pengguna
                            </label>

                            <div class="relative">
                                <select
                                    id="role"
                                    name="role"
                                    required
                                    class="block w-full appearance-none rounded-xl border-gray-200 bg-gray-50 px-4 py-3 text-sm text-gray-900 shadow-sm transition focus:border-indigo-500 focus:bg-white focus:ring-indigo-500 @error('role') border-rose-300 focus:border-rose-500 focus:ring-rose-500 @enderror"
                                >
                                    <option value="">
                                        Pilih role pengguna
                                    </option>

                                    <option
                                        value="user"
                                        {{ old('role') === 'user' ? 'selected' : '' }}
                                    >
                                        User — dapat mengelola task sendiri
                                    </option>

                                    <option
                                        value="admin"
                                        {{ old('role') === 'admin' ? 'selected' : '' }}
                                    >
                                        Admin — dapat mengelola pengguna
                                    </option>
                                </select>

                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-400">
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
                                            d="M6 9l6 6 6-6"
                                        />
                                    </svg>
                                </div>
                            </div>

                            <p class="mt-2 text-xs text-gray-400">
                                Role menentukan hak akses pengguna di TaskFlow.
                            </p>

                            @error('role')
                                <p class="mt-2 text-sm text-rose-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- Password --}}
                        <div>
                            <label
                                for="password"
                                class="mb-2 block text-sm font-semibold text-gray-700"
                            >
                                Password
                            </label>

                            <input
                                type="password"
                                id="password"
                                name="password"
                                required
                                autocomplete="new-password"
                                placeholder="Masukkan password"
                                class="block w-full rounded-xl border-gray-200 bg-gray-50 px-4 py-3 text-sm text-gray-900 placeholder-gray-400 shadow-sm transition focus:border-indigo-500 focus:bg-white focus:ring-indigo-500 @error('password') border-rose-300 focus:border-rose-500 focus:ring-rose-500 @enderror"
                            >

                            <p class="mt-2 text-xs text-gray-400">
                                Gunakan password yang mudah diingat tetapi sulit ditebak.
                            </p>

                            @error('password')
                                <p class="mt-2 text-sm text-rose-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- Konfirmasi password --}}
                        <div>
                            <label
                                for="password_confirmation"
                                class="mb-2 block text-sm font-semibold text-gray-700"
                            >
                                Konfirmasi Password
                            </label>

                            <input
                                type="password"
                                id="password_confirmation"
                                name="password_confirmation"
                                required
                                autocomplete="new-password"
                                placeholder="Ulangi password"
                                class="block w-full rounded-xl border-gray-200 bg-gray-50 px-4 py-3 text-sm text-gray-900 placeholder-gray-400 shadow-sm transition focus:border-indigo-500 focus:bg-white focus:ring-indigo-500"
                            >

                            <p class="mt-2 text-xs text-gray-400">
                                Masukkan password yang sama seperti sebelumnya.
                            </p>
                        </div>

                    </div>

                    {{-- Footer --}}
                    <div class="flex flex-col-reverse gap-3 border-t border-gray-100 bg-gray-50 px-6 py-5 sm:flex-row sm:items-center sm:justify-between sm:px-8">
                        <a
                            href="{{ url('/admin/users') }}"
                            class="inline-flex items-center justify-center rounded-xl px-4 py-2.5 text-sm font-semibold text-gray-500 transition hover:bg-gray-100 hover:text-gray-700"
                        >
                            Batal
                        </a>

                        <button
                            type="submit"
                            class="inline-flex items-center justify-center gap-2 rounded-xl bg-indigo-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-indigo-700 hover:shadow-md"
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

                            Tambah Pengguna
                        </button>
                    </div>
                </form>
            </div>

            {{-- Informasi tambahan --}}
            <div class="rounded-2xl border border-indigo-100 bg-indigo-50 px-5 py-4 sm:px-6">
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
                        <p class="text-sm font-semibold text-indigo-900">
                            Catatan pembuatan akun
                        </p>

                        <p class="mt-1 text-sm leading-6 text-indigo-700">
                            Pastikan email belum digunakan dan role yang dipilih sudah sesuai dengan kebutuhan pengguna.
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>