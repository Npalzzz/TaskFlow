<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Kategori</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">

<div class="container mx-auto mt-10 max-w-3xl">

    <h1 class="text-3xl font-bold mb-6">
        Kelola Kategori
    </h1>

    @if(session('success'))
        <div class="bg-green-500 text-white p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('categories.store') }}" method="POST" class="mb-6">
        @csrf

        <input
            type="text"
            name="nama_kategori"
            placeholder="Masukkan nama kategori..."
            class="border p-2 rounded w-full"
        >

        <button
            class="bg-blue-600 text-white px-4 py-2 rounded mt-3">
            Tambah Kategori
        </button>

    </form>

    <table class="w-full bg-white rounded shadow">

        <thead class="bg-gray-200">

            <tr>
                <th class="p-3 text-left">ID</th>
                <th class="p-3 text-left">Nama Kategori</th>
                <th class="p-3 text-center">Aksi</th>
            </tr>

        </thead>

        <tbody>

        @forelse($categories as $category)

            <tr class="border-t">

                <td class="p-3">
                    {{ $category->id }}
                </td>

                <td class="p-3">
                    {{ $category->nama_kategori }}
                </td>

                <td class="p-3 text-center">

                    <form
                        action="{{ route('categories.destroy', $category) }}"
                        method="POST">

                        @csrf
                        @method('DELETE')

                        <button
                            class="bg-red-600 text-white px-3 py-1 rounded">

                            Hapus

                        </button>

                    </form>

                </td>

            </tr>

        @empty

            <tr>

                <td colspan="3" class="text-center p-5">

                    Belum ada kategori.

                </td>

            </tr>

        @endforelse

        </tbody>

    </table>

</div>

</body>
</html>