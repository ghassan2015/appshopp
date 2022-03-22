<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class bookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' =>[ 'ar'=>$this->faker->name,'en'=>$this->faker->name],
            'user_id'=>1,
            'qty'=>$this->faker->numberBetween(1,200),
            'image'=>$this->faker->imageUrl(800,600),
            'book_lang'=>$this->faker->randomElement(['ar','en']),
            'description'=>['ar'=>$this->faker->text,'en'=>$this->faker->text],
            'author_name'=>$this->faker->name,
            'type_book'=>$this->faker->numberBetween(5,6),
            'annulment_no'=>$this->faker->numberBetween(1,30),
            'years_publish'=>$this->faker->year,
            'size_paper_cd'=>$this->faker->numberBetween(5,7),
            'color_paper_cd'=>$this->faker->numberBetween(9,11),
            'side_print_cd'=>$this->faker->numberBetween(16,17),
            'cover_cd'=>$this->faker->numberBetween(19,20),
            'status_using_book_cd'=>$this->faker->numberBetween(22,23),
            'side_cover_cd'=>$this->faker->numberBetween(25,26),
            'status_publish_cd'=>$this->faker->numberBetween(28,30),
            'version_type_book_cd'=>$this->faker->numberBetween(32,34),
            'status_cd'=>$this->faker->numberBetween(2,3),
            'color_print_cd'=>$this->faker->numberBetween(13,14)
        ];

    }
}
