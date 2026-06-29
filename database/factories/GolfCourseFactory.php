<?php

namespace Database\Factories;

use App\Enums\En\JapanesePrefecture as EnPrefecture;
use App\Enums\En\UsState as EnUsState;
use App\Enums\Ja\JapanesePrefecture as JaPrefecture;
use App\Enums\Ja\UsState as JaUsState;
use App\Models\GolfCourse;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<GolfCourse>
 */
class GolfCourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $locale = $this->faker->randomElement(['ja', 'en']);

        $jaFaker = \Faker\Factory::create('ja_JP');
        $enFaker = \Faker\Factory::create('en_US');

        if ($locale === 'ja') {
            $course_name = $jaFaker->company();
            $web = $jaFaker->url(); // → https://www.example.jp
            $phone = $jaFaker->phoneNumber(); // → 090-1234-5678
            $address = $jaFaker->address(); // → 東京都新宿区西新宿1-1-1
            $form_email = $jaFaker->email(); // → taro@example.com
            $remarks = $jaFaker->text(5000);
            $allRegions = array_merge(
                array_column(JaPrefecture::cases(), 'value'),
                array_column(JaUsState::cases(), 'value')
            );
        } else {
            $course_name = $enFaker->company();
            $web = $enFaker->url(); // → https://www.example.com
            $phone = $enFaker->phoneNumber(); // → 555-123-4567
            $address = $enFaker->address(); // → 東京都新宿区西新宿1-1-1
            $form_email = $enFaker->email(); // → → john@example.com
            $remarks = $enFaker->text(5000);
            $allRegions = array_merge(
                array_column(EnPrefecture::cases(), 'value'),
                array_column(EnUsState::cases(), 'value')
            );
        }

        return [
            'locale' => $locale,
            'country_code' => $this->faker->randomElement(['JP', 'US']),
            'state_prefecture' => $this->faker->randomElement($allRegions),
            'course_name' => $course_name,
            'kinds' => $this->faker->numberBetween(1, 1000),
            'web' => $web,
            'phone' => $phone,
            'address' => $address,
            'indoor' => $this->faker->boolean(),
            'outdoor' => $this->faker->boolean(),
            'short_course' => $this->faker->boolean(),
            'long_course' => $this->faker->boolean(),
            'lat' => $this->faker->latitude(),
            'lng' => $this->faker->longitude(),
            'form_email' => $form_email,
            'reservation' => $this->faker->text(255),
            'reservation_method' => $this->faker->text(255),
            'remarks' => $remarks,
            'image1' => null,
            'image2' => null,
            'image3' => null,
        ];
    }
}
