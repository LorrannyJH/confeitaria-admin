<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\Http\Requests\Admin\ProductRequest;

class ProductController extends Controller
{
    public function index()
    {
        $data = [
            'products' => Product::all()
        ];
        return view('admin.products.index', compact('data'));
    }

    public function create()
    {
        return view('admin.products.create');
    }

    public function store(ProductRequest $request)
    {
        $nameFile = null;
    
        if ($request->hasFile('product.photo') && $request->file('product.photo')->isValid()) {
            
            $name = uniqid(date('HisYmd'));
            $extension = $request->product['photo']->extension();
            $nameFile = "{$name}.{$extension}";
            $upload = $request->product['photo']->storeAs('products', $nameFile);

            if (!$upload) {
                return redirect()
                    ->back()
                    ->with('msg_error', 'Falha ao fazer upload')
                    ->withInput();
            }
 
        }

        $requestData = $request->all();
        $requestData['product']['photo'] = 'products/' . $nameFile;
        Product::create($requestData['product']);
        
        return redirect()
            ->route('admin.products.index')
            ->with('msg_success', 'Produto cadastrado com sucesso!');
    }

    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    public function update(ProductRequest $request, Product $product)
    {
        $nameFile = null;

        if ($request->hasFile('product.photo') && $request->file('product.photo')->isValid()) {
            
            $name = uniqid(date('HisYmd'));
            $extension = $request->product['photo']->extension();
            $nameFile = "{$name}.{$extension}";
            $upload = $request->product['photo']->storeAs('products', $nameFile);

            if (!$upload) {
                return redirect()
                    ->back()
                    ->with('msg_error', 'Falha ao fazer upload')
                    ->withInput();
            }
 
        }

        $requestData = $request->all();

        if ($nameFile != null) {
            $requestData['product']['photo'] = 'products/' . $nameFile;
        } else {
            $requestData['product']['photo'] = $product->photo;
        }

        $product->update($requestData['product']);
        
        return redirect()
            ->route('admin.products.index')
            ->with('msg_success', 'Produto atualizado com sucesso!');
    }

    public function destroy(Product $product)
    {
        
        $product->delete();

        return redirect()
            ->route('admin.products.index')
            ->with('msg_success', 'Produto deletado com sucesso!');
    }
}
