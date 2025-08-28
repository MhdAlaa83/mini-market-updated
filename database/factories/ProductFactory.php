<?php


namespace Database\Factories;


use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;


/** @extends Factory<\App\Models\Product> */
class ProductFactory extends Factory
{
public function definition(): array
{
$name = $this->faker->words(3, true);
$categories = ['Groceries','Beverages','Snacks','Household','Personal Care'];


return [
'name' => Str::title($name),
'description' => $this->faker->paragraph(),
'category' => $this->faker->randomElement($categories),
'price' => $this->faker->randomFloat(2, 1, 500),
'stock' => $this->faker->numberBetween(0, 200),
'is_active' => $this->faker->boolean(90),
'image_url' => $this->faker->randomElement([
'https://picsum.photos/seed/'.Str::random(5).'/480/320',
null
]),
];
}
}