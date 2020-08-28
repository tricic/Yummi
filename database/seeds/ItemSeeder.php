<?php

use App\Models\Category;
use App\Models\ItemParent;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $category = Category::where('name', 'Pizza')->firstOrFail();
        $pizzas = [
            [
                'name' => 'Margherita',
                'description' => 'Tomato sauce, mozzarella, and oregano',
                'image' => 'https://www.carusopizza.cz/180-home_default/margherita.jpg',
                'category_id' => $category->id
            ],
            [
                'name' => 'Quattro Stagioni',
                'description' => 'Tomato sauce, mozzarella, mushrooms, ham, artichokes, olives, and oregano',
                'image' => 'https://www.carusopizza.cz/430-home_default/salami.jpg',
                'category_id' => $category->id
            ],
            [
                'name' => 'Napoli',
                'description' => 'Tomato sauce, mozzarella, oregano, anchovies',
                'image' => 'https://www.carusopizza.cz/452-home_default/caruso.jpg',
                'category_id' => $category->id
            ],
            [
                'name' => 'Mediterranea',
                'description' => 'Tomato sauce, buffalo mozzarella, cherry tomatoes and pepper',
                'image' => 'https://www.carusopizza.cz/401-home_default/mediterranea.jpg',
                'category_id' => $category->id
            ],
            [
                'name' => 'Capricciosa',
                'description' => 'Tomato sauce, mozzarella, ham, artichokes, mushrooms, and olives',
                'image' => 'https://www.carusopizza.cz/462-home_default/salsiccia.jpg',
                'category_id' => $category->id
            ],
            [
                'name' => 'Vegetariana',
                'description' => 'Tomato sauce, mozzarella and a various vegetable',
                'image' => 'https://www.carusopizza.cz/201-home_default/peperoni.jpg',
                'category_id' => $category->id
            ],
            [
                'name' => 'Fontana',
                'description' => 'Tomato sauce, mozzarella, gorgonzola cheese, radicchio, and parmesan',
                'image' => 'https://www.carusopizza.cz/516-home_default/caruso.jpg',
                'category_id' => $category->id
            ],
            [
                'name' => 'Pizza tartufata',
                'description' => 'Mozzarella, truffle cream, and porcini mushrooms',
                'image' => 'https://www.carusopizza.cz/515-home_default/salami.jpg',
                'category_id' => $category->id
            ],
            [
                'name' => 'Tricolore',
                'description' => 'Mozzarella, bresaola, and parmesan flakes',
                'image' => 'https://www.carusopizza.cz/220-home_default/tonno-cipolla.jpg',
                'category_id' => $category->id
            ],
            [
                'name' => 'Funghi',
                'description' => 'Tomato sauce, mozzarella, mushrooms, parsley and olive oil',
                'image' => 'https://www.carusopizza.cz/388-home_default/funghi.jpg',
                'category_id' => $category->id
            ],
        ];

        foreach ($pizzas as $pizza)
        {
            $itemParent = ItemParent::create($pizza);

            $itemParent->items()->create([
                'size' => 'small',
                'price' => Arr::random([5, 6])
            ]);

            $itemParent->items()->create([
                'size' => 'medium',
                'price' => Arr::random([8, 9])
            ]);

            $itemParent->items()->create([
                'size' => 'large',
                'price' => Arr::random([11, 12])
            ]);
        }
    }
}
