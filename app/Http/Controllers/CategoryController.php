<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();

        $categories = Category::where('user_id', $user->id)
            ->withCount('tasks')
            ->orderBy('nama_kategori', 'asc')
            ->get();

        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
        ]);

        Category::create([
            'user_id' => Auth::id(),
            'nama_kategori' => $request->nama_kategori,
        ]);

        return redirect()
            ->route('categories.index')
            ->with('success', 'Kategori berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        // Pastikan kategori milik user yang sedang login.
        abort_unless(
            $category->user_id === Auth::id(),
            403
        );

        return view('categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        // Jangan izinkan user mengedit kategori milik user lain.
        abort_unless(
            $category->user_id === Auth::id(),
            403
        );

        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        // Pastikan kategori milik user yang sedang login.
        abort_unless(
            $category->user_id === Auth::id(),
            403
        );

        $request->validate([
            'nama_kategori' => 'required|string|max:255',
        ]);

        $category->update([
            'nama_kategori' => $request->nama_kategori,
        ]);

        return redirect()
            ->route('categories.index')
            ->with('success', 'Kategori berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        // Jangan izinkan user menghapus kategori milik user lain.
        abort_unless(
            $category->user_id === Auth::id(),
            403
        );

        $category->delete();

        return redirect()
            ->route('categories.index')
            ->with('success', 'Kategori berhasil dihapus.');
    }
}