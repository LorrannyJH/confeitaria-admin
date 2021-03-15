<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\Http\Requests\Admin\ProductRequest;
use App\Exports\ProductExport;
use App\Imports\ProductImport;
use Maatwebsite\Excel\Facades\Excel;

class ProductController extends Controller
{
    public function index()
    {
        $data = [
            'products' => Product::paginate(5)
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

        if ($requestData['product']['unit_type'] !== 'pack') {
            $requestData['product']['pack_quantity'] = null;
        }

        $product->update($requestData['product']);
        
        return redirect()
            ->route('admin.products.index')
            ->with('msg_success', 'Produto atualizado com sucesso!');
    }

    public function destroy(Product $product)
    {
        if (count($product->orderProducts)) {
            return redirect()
                ->route('admin.products.index')
                ->with(
                    'msg_error',
                    'Não é possível deletar este produto pois ele consta em pedidos cadastrados!'
                );
        }
        
        $product->delete();

        return redirect()
            ->route('admin.products.index')
            ->with('msg_success', 'Produto deletado com sucesso!');
    }

    public function export()
    {
        return Excel::download(new ProductExport, 'products.xlsx');
    }

    public function import(Request $request)
    {
        $file = $request->files->get('file');

        try {
            Excel::import(new ProductImport, $file);
        } catch(\Exception $exception) {
            return back()->with('msg_error', 'Erro ao importar produtos!');
        }

        return back()->with('msg_success', 'Produtos importados com sucesso!');
    }
}
