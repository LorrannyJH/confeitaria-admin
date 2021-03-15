<?php

namespace App\Imports;

use App\Product;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Product([
            'name' => $row['nome'],
            'price' => $row['valor'] / 100,
            'description' => $row['descricao'],
            'unit_type' => $row['unidade'],
            'pack_quantity' => $row['quantidade_pacote'] ?? null
        ]);
    }
}
