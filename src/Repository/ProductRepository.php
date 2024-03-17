<?php

namespace App\Repository;

class ProductRepository
{
    private array $data = [
        1 => ['name' => 'Iphone', 'price' => 10000],
        2 => ['name' => 'Headphones', 'price' => 2000],
        3 => ['name' => 'Case', 'price' => 1000]
    ];

    public function existsById(int $id): bool
    {
        return array_key_exists($id, $this->data);
    }

    public function findPriceById(int $id): int
    {
        return $this->data[$id]['price'];
    }
}
