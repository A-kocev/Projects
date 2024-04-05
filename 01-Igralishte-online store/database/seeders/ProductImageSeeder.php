<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Support\Arr;
use App\Models\ProductImage;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $images = [
            'https://i.pinimg.com/736x/9a/78/14/9a7814568074f1268ea0dc4a289bea5e--vintage-party-dresses-party-dresses-for-women.jpg',
            'https://s3.eu-west-2.amazonaws.com/grpl-mylearning/resources/m-and-s-fashion-2/1950_newlookdress.jpg',
            'https://i.pinimg.com/originals/de/78/cd/de78cda1e824978fc37ca3390f40395b.jpg',
            'https://i.pinimg.com/originals/1d/06/5b/1d065be7bf405801cab5724dbab1e223.png',
            'https://turkopt.com/image/data/vendors-photo/275/bt-96065_0.jpg',
        ];
        $products = Product::all()->pluck('id');
        foreach ($products as $product) {
            ProductImage::create([
                'image_url' => Arr::random($images),
                'product_id' => $product
            ]);
        }
    }
}
