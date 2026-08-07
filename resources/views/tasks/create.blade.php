<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800">
            Tambah Task
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto py-8">

        <div class="bg-white rounded-xl shadow p-6">

            <form action="{{ route('tasks.store') }}" method="POST">

                @csrf

                <div class="mb-5">
                    <label class="block font-semibold mb-2">
                        Judul Task
                    </label>

                    <input
                        type="text"
                        name="judul"
                        class="w-full border rounded-lg p-3"
                        required>
                </div>

                <div class="mb-5">
                    <label class="block font-semibold mb-2">
                        Deskripsi
                    </label>

                    <textarea
                        name="deskripsi"
                        rows="4"
                        class="w-full border rounded-lg p-3"></textarea>
                </div>

                <div class="mb-5">
                    <label class="block font-semibold mb-2">
                        Kategori
                    </label>

                    <select
                        name="category_id"
                        class="w-full border rounded-lg p-3">

                        @foreach($categories as $category)

                            <option value="{{ $category->id }}">
                                {{ $category->nama_kategori }}
                            </option>

                        @endforeach

                    </select>
                </div>

                <div class="grid grid-cols-2 gap-6">

                    <div>
                        <label class="block font-semibold mb-2">
                            Prioritas
                        </label>

                        <select
                            name="priority"
                            class="w-full border rounded-lg p-3">

                            <option>Rendah</option>
                            <option selected>Sedang</option>
                            <option>Tinggi</option>

                        </select>
                    </div>

                    <div>
                        <label class="block font-semibold mb-2">
                            Deadline
                        </label>

                        <input
                            type="date"
                            name="deadline"
                            class="w-full border rounded-lg p-3">
                    </div>

                </div>

                <div class="mt-6">

                    <label class="block font-semibold mb-2">
                        Status
                    </label>

                    <select
                        name="status"
                        class="w-full border rounded-lg p-3">

                        <option selected>Belum</option>
                        <option>Proses</option>
                        <option>Selesai</option>

                    </select>

                </div>

                <div class="mt-8 flex justify-end">

                    <button
                        class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-lg">

                        Simpan Task

                    </button>

                </div>

            </form>

        </div>

    </div>

</x-app-layout>