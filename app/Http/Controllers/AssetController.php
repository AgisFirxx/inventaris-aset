<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\Category;
use Illuminate\Http\Request;

class AssetController extends Controller
{
    public function index(Request $request)
{
    $query = Asset::with('category');

    if ($request->filled('search')) {
        $query->where(function ($q) use ($request) {
            $q->where('nama_aset', 'like', '%' . $request->search . '%')
              ->orWhere('kode_aset', 'like', '%' . $request->search . '%');
        });
    }

    if ($request->filled('status')) {
        $query->where('status', $request->status);
    }

    if ($request->filled('category_id')) {
        $query->where('category_id', $request->category_id);
    }

    $assets = $query->latest()->paginate(10)->withQueryString();
    $categories = Category::all();

    return view('assets.index', compact('assets', 'categories'));
}

    public function create()
    {
        $categories = Category::all();
        return view('assets.create', compact('categories'));
    }

    public function show(Asset $asset)
    {
        $loans = $asset->loans()->with('user')->latest()->get();
        return view('assets.show', compact('asset', 'loans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_aset' => 'required|string|unique:assets,kode_aset',
            'nama_aset' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'kondisi' => 'required|string',
            'lokasi' => 'nullable|string',
        ]);

        Asset::create($request->all());

        return redirect()->route('assets.index')->with('success', 'Aset berhasil ditambahkan.');
    }

    public function edit(Asset $asset)
    {
        $categories = Category::all();
        return view('assets.edit', compact('asset', 'categories'));
    }

    public function update(Request $request, Asset $asset)
    {
        $request->validate([
            'kode_aset' => 'required|string|unique:assets,kode_aset,' . $asset->id,
            'nama_aset' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'kondisi' => 'required|string',
            'lokasi' => 'nullable|string',
        ]);

        $asset->update($request->all());

        return redirect()->route('assets.index')->with('success', 'Aset berhasil diperbarui.');
    }

    public function destroy(Asset $asset)
    {
        $asset->delete();
        return redirect()->route('assets.index')->with('success', 'Aset berhasil dihapus.');
    }
}