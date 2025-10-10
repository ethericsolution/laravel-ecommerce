<?php

namespace Database\Factories;

use App\Models\Banner;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;
use Spatie\MediaLibrary\MediaCollections\Exceptions\UnreachableUrl;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Banner>
 */
class BannerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'       => $this->faker->sentence(3),
            'link'       => $this->faker->optional()->url(),
            'location'   => 'slider',
            'is_active'  => $this->faker->boolean(),
            'is_new_tab' => $this->faker->boolean(),
        ];
    }


    public function configure(): BannerFactory
    {
        return $this->afterCreating(function (Banner $banner) {
            try {
                $banner
                    ->addMediaFromUrl('https://picsum.photos/360/120?grayscale')
                    ->usingName(Str::uuid())
                    ->usingFileName(Str::uuid() . '.jpg')
                    ->preservingOriginal()
                    ->toMediaCollection();
            } catch (UnreachableUrl $exception) {
                return;
            }
        });
    }
}
