<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('id', 'desc')->get();
        $total = Product::count();
        return view('admin.product.home', compact(['products', 'total']));
    }

    public function create()
    {
        return view('admin.product.create');
    }


    public function save(Request $request)
    {
        $validation = $request->validate([
            'judul' => 'required',
            'kategory' => 'required',
            'harga' => 'required',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            $fileName = time() . '.' . $request->photo->extension();
            $request->photo->storeAs('photos', $fileName, 'public');
            $validation['photo'] = 'photos/' . $fileName;
        }

        $product = Product::create($validation);

        if ($product){
            session()->flash('success', 'Produk berhasil ditambahkan');
            return redirect(route('admin/products'));
        } else {
            session()->flash('error', 'Terjadi kesalahan');
            return redirect(route('admin.products/create'));
        }
    }

    public function edit($id)
    {
        $products = Product::findOrFail($id);
        return view('admin.product.update', compact('products'));
    }

    public function delete($id)
    {
        $products = Product::findOrFail($id)->delete();
        if ($products) {
            session()->flash('success', 'Product Deleted Successfully');
            return redirect(route('admin/products'));
        } else {
            session()->flash('error', 'Product Not Delete successfully');
            return redirect(route('admin/products'));
        }
    }

    public function update(Request $request, $id)
    {
        $products = Product::findOrFail($id);

        $request->validate([
            'judul' => 'required',
            'kategory' => 'required',
            'harga' => 'required',
            'photo' => 'nullable',
        ]);

        $data = $request->only(['judul', 'kategory', 'harga']);

        if ($request->hasFile('photo')) {
            // Hapus foto lama jika ada
            if ($products->photo) {
                Storage::disk('public')->delete($products->photo);
            }
            $fileName = time() . '.' . $request->photo->extension();
            $request->photo->storeAs('photos', $fileName, 'public');
            $data['photo'] = 'photos/' . $fileName;
        }

        $products->update($data);

        if ($products) {
            session()->flash('success', 'Product Update Successfully');
            return redirect(route('admin/products'));
        } else {
            session()->flash('error', 'Some problem occure');
            return redirect(route('admin/products/update'));
        }
    }
}
