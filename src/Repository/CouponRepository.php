<?php

namespace App\Repository;

class CouponRepository
{
    private array $data = [
        1 => ['code' => 'VGTOC76W', 'type' => 1, 'discount' => 5],
        2 => ['code' => '4XGGOUDM', 'type' => 2, 'discount' => 5],
        3 => ['code' => '3X3GPYG4', 'type' => 1, 'discount' => 6],
        4 => ['code' => 'L43R43I8', 'type' => 1, 'discount' => 7],
        5 => ['code' => 'UJ5IX1Y5', 'type' => 2, 'discount' => 7],
        6 => ['code' => 'ISDEK437', 'type' => 1, 'discount' => 8],
        7 => ['code' => 'J13TVDTU', 'type' => 1, 'discount' => 9],
        8 => ['code' => 'GFWOP5EA', 'type' => 1, 'discount' => 10],
        9 => ['code' => 'E6E2FG8D', 'type' => 1, 'discount' => 20],
        10 => ['code' => '0MWYMK63', 'type' => 2, 'discount' => 20]
    ];

    public function existsByCode(string $code): bool
    {
        foreach ($this->data as $item) {
            if ($code === $item['code']) return true;
        }
        return false;
    }

    public function findByCode(string $code): ?array
    {
        foreach ($this->data as $item) {
            if ($code === $item['code']) return $item;
        }
        return null;
    }
}
