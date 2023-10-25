<?php
use App\Contracts\OrderContract;
use App\Repositories\OrderRepository;

protected $repositories = [
    CategoryContract::class         =>          CategoryRepository::class,
    AttributeContract::class        =>          AttributeRepository::class,
    BrandContract::class            =>          BrandRepository::class,
    ProductContract::class          =>          ProductRepository::class,
    OrderContract::class            =>          OrderRepository::class,
];