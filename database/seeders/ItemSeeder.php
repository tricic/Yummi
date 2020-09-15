<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\ItemParent;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class ItemSeeder extends Seeder
{
    public function run(): void
    {
        $this->seedPizza();
        $this->seedDrinks();
    }

    public function seedPizza(): void
    {
        $pizza_category = Category::where('name', 'Pizza')->firstOrFail();

        $pizzas = [
            [
                'name' => 'Margherita',
                'description' => 'Tomato sauce, mozzarella, and oregano',
                'image' => 'https://www.carusopizza.cz/180-home_default/margherita.jpg',
                'category_id' => $pizza_category->id
            ],
            [
                'name' => 'Quattro Stagioni',
                'description' => 'Tomato sauce, mozzarella, mushrooms, ham, artichokes, olives, and oregano',
                'image' => 'https://www.carusopizza.cz/430-home_default/salami.jpg',
                'category_id' => $pizza_category->id
            ],
            [
                'name' => 'Napoli',
                'description' => 'Tomato sauce, mozzarella, oregano, anchovies',
                'image' => 'https://www.carusopizza.cz/452-home_default/caruso.jpg',
                'category_id' => $pizza_category->id
            ],
            [
                'name' => 'Mediterranea',
                'description' => 'Tomato sauce, buffalo mozzarella, cherry tomatoes and pepper',
                'image' => 'https://www.carusopizza.cz/401-home_default/mediterranea.jpg',
                'category_id' => $pizza_category->id
            ],
            [
                'name' => 'Capricciosa',
                'description' => 'Tomato sauce, mozzarella, ham, artichokes, mushrooms, and olives',
                'image' => 'https://www.carusopizza.cz/462-home_default/salsiccia.jpg',
                'category_id' => $pizza_category->id
            ],
            [
                'name' => 'Vegetariana',
                'description' => 'Tomato sauce, mozzarella and a various vegetable',
                'image' => 'https://www.carusopizza.cz/201-home_default/peperoni.jpg',
                'category_id' => $pizza_category->id
            ],
            [
                'name' => 'Fontana',
                'description' => 'Tomato sauce, mozzarella, gorgonzola cheese, radicchio, and parmesan',
                'image' => 'https://www.carusopizza.cz/516-home_default/caruso.jpg',
                'category_id' => $pizza_category->id
            ],
            [
                'name' => 'Pizza tartufata',
                'description' => 'Mozzarella, truffle cream, and porcini mushrooms',
                'image' => 'https://www.carusopizza.cz/515-home_default/salami.jpg',
                'category_id' => $pizza_category->id
            ],
            [
                'name' => 'Tricolore',
                'description' => 'Mozzarella, bresaola, and parmesan flakes',
                'image' => 'https://www.carusopizza.cz/220-home_default/tonno-cipolla.jpg',
                'category_id' => $pizza_category->id
            ],
            [
                'name' => 'Funghi',
                'description' => 'Tomato sauce, mozzarella, mushrooms, parsley and olive oil',
                'image' => 'https://www.carusopizza.cz/388-home_default/funghi.jpg',
                'category_id' => $pizza_category->id
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

    public function seedDrinks(): void
    {
        $drinks_category = Category::where('name', 'Drinks')->firstOrFail();

        $drinks = [
            [
                'name' => 'Coca-Cola',
                'description' => "Carbonated soft drink",
                'image' => 'https://www.carusopizza.cz/484-home_default/coca-cola-can-033l.jpg',
                'category_id' => $drinks_category->id
            ],
            [
                'name' => 'Coca-Cola Zero',
                'description' => "Carbonated soft drink",
                'image' => 'https://www.carusopizza.cz/485-home_default/coca-cola-zero-can-033l.jpg',
                'category_id' => $drinks_category->id
            ],
            [
                'name' => 'Fanta',
                'description' => "Carbonated soft drink",
                'image' => 'https://www.carusopizza.cz/486-home_default/fanta-can-033l.jpg',
                'category_id' => $drinks_category->id
            ],
            [
                'name' => 'Sprite',
                'description' => "Carbonated soft drink",
                'image' => 'https://www.carusopizza.cz/489-home_default/sprite-can-033l.jpg',
                'category_id' => $drinks_category->id
            ]
        ];

        foreach ($drinks as $drink)
        {
            $itemParent = ItemParent::create($drink);

            $itemParent->items()->create([
                'size' => '1.75l',
                'price' => 2.5
            ]);

            $itemParent->items()->create([
                'size' => '0.5l',
                'price' => 1.5
            ]);

            $itemParent->items()->create([
                'size' => '0.33l',
                'price' => 1
            ]);
        }
    }
}
