<?php

namespace Tests\Feature;

use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Tests\TestCase;

class AdvertisementTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function test_example()
    {
        $this->store_ads_success();
        $this->store_ads_failed_require_name();
        $this->store_ads_failed_max_name();
        $this->store_ads_failed_string_name();
        $this->store_ads_failed_require_description();
        $this->store_ads_failed_max_description();
        $this->store_ads_failed_string_description();
        $this->store_ads_failed_require_price();
        $this->store_ads_failed_numeric_price();
        $this->store_ads_failed_require_images();
        $this->store_ads_failed_array_images();
        $this->store_ads_failed_dupplicate_images();
    }

    public function store_ads_success()
    {
        $data = [
            'name' => "test name",
            'description' => "test description",
            'price' => 1,
            'images' => [
                "http://dotnetguru.org/wp-content/uploads/2019/08/php.jpg",
                "http://dotnetguru.org/wp-content/uploads/2019/08/php.jpg"
            ]
        ];
        $response = $this->post('api/advertisement', $data);
        $response->assertStatus(200);
    }

    public function store_ads_failed_require_name()
    {
        $data = [
            'description' => "test description",
            'price' => 1,
            'images' => [
                "http://dotnetguru.org/wp-content/uploads/2019/08/php.jpg",
                "http://dotnetguru.org/wp-content/uploads/2019/08/php.jpg"
            ]
        ];
        $response = $this->post('api/advertisement', $data);
        $response->assertStatus(200)->assertJson([
            'message' => [
                'name' => [
                    'The name field is required.'
                ],
            ]
        ]);

    }

    public function store_ads_failed_max_name()
    {
        $data = [
            'name' => Str::random(300),
            'description' => "test description",
            'price' => 1,
            'images' => [
                "http://dotnetguru.org/wp-content/uploads/2019/08/php.jpg",
                "http://dotnetguru.org/wp-content/uploads/2019/08/php.jpg"
            ]
        ];
        $response = $this->post('api/advertisement', $data);
        $response->assertStatus(200)->assertJson([
            'message' => [
                'name' => [
                    'The name must not be greater than 200 characters.'
                ],
            ]
        ]);
    }

    public function store_ads_failed_string_name()
    {
        $data = [
            'name' => Carbon::now(),
            'description' => "test description",
            'price' => 1,
            'images' => [
                "http://dotnetguru.org/wp-content/uploads/2019/08/php.jpg",
                "http://dotnetguru.org/wp-content/uploads/2019/08/php.jpg"
            ]
        ];
        $response = $this->post('api/advertisement', $data);
        $response->assertStatus(200)->assertJson([
            'message' => [
                'name' => [
                    'The name must be a string.'
                ],
            ]
        ]);
    }

    public function store_ads_failed_require_description()
    {
        $data = [
            'name' => "test name",
            'price' => 1,
            'images' => [
                "http://dotnetguru.org/wp-content/uploads/2019/08/php.jpg",
                "http://dotnetguru.org/wp-content/uploads/2019/08/php.jpg"
            ]
        ];
        $response = $this->post('api/advertisement', $data);
        $response->assertStatus(200)->assertJson([
            'message' => [
                'description' => [
                    'The description field is required.'
                ],
            ]
        ]);

    }

    public function store_ads_failed_max_description()
    {
        $data = [
            'description' => Str::random(3000),
            'name' => "test name",
            'price' => 1,
            'images' => [
                "http://dotnetguru.org/wp-content/uploads/2019/08/php.jpg",
                "http://dotnetguru.org/wp-content/uploads/2019/08/php.jpg"
            ]
        ];
        $response = $this->post('api/advertisement', $data);
        $response->assertStatus(200)->assertJson([
            'message' => [
                'description' => [
                    'The description must not be greater than 2000 characters.'
                ],
            ]
        ]);
    }

    public function store_ads_failed_string_description()
    {
        $data = [
            'description' => Carbon::now(),
            'name' => "test name",
            'price' => 1,
            'images' => [
                "http://dotnetguru.org/wp-content/uploads/2019/08/php.jpg",
                "http://dotnetguru.org/wp-content/uploads/2019/08/php.jpg"
            ]
        ];
        $response = $this->post('api/advertisement', $data);
        $response->assertStatus(200)->assertJson([
            'message' => [
                'description' => [
                    'The description must be a string.'
                ],
            ]
        ]);
    }

    public function store_ads_failed_require_price()
    {
        $data = [
            'description' => "test description",
            'name' => "test name",
            'images' => [
                "http://dotnetguru.org/wp-content/uploads/2019/08/php.jpg",
                "http://dotnetguru.org/wp-content/uploads/2019/08/php.jpg"
            ]
        ];
        $response = $this->post('api/advertisement', $data);
        $response->assertStatus(200)->assertJson([
            'message' => [
                'price' => [
                    'The price field is required.'
                ],
            ]
        ]);

    }

    public function store_ads_failed_numeric_price()
    {
        $data = [
            'description' => 'test description',
            'name' => "test name",
            'price' => Str::random(1),
            'images' => [
                "http://dotnetguru.org/wp-content/uploads/2019/08/php.jpg",
                "http://dotnetguru.org/wp-content/uploads/2019/08/php.jpg"
            ]
        ];
        $response = $this->post('api/advertisement', $data);
        $response->assertStatus(200)->assertJson([
            'message' => [
                'price' => [
                    'The price must be a number.'
                ],
            ]
        ]);
    }

    public function store_ads_failed_require_images()
    {
        $data = [
            'name' => "test name",
            'description' => "test description",
            'price' => 1,
        ];
        $response = $this->post('api/advertisement', $data);
        $response->assertStatus(200)->assertJson([
            'message' => [
                'images' => [
                    'The images field is required.'
                ],
            ]
        ]);
    }

    public function store_ads_failed_array_images()
    {
        $data = [
            'name' => "test name",
            'description' => "test description",
            'price' => 1,
            'images' => "http://dotnetguru.org/wp-content/uploads/2019/08/php.jpg",
        ];
        $response = $this->post('api/advertisement', $data);
        $response->assertStatus(200)->assertJson([
            'message' => [
                'images' => [
                    'The images must be an array.'
                ],
            ]
        ]);
    }

    public function store_ads_failed_dupplicate_images()
    {
        $data = [
            'name' => "test name",
            'description' => "test description",
            'price' => 1,
            'images' => [
                "http://dotnetguru.org/wp-content/uploads/2019/08/php.jpg",
                "http://dotnetguru.org/wp-content/uploads/2019/08/php.jpg",
                "http://dotnetguru.org/wp-content/uploads/2019/08/php.jpg"
            ],
        ];
        $response = $this->post('api/advertisement', $data);
        $response->assertStatus(200)->assertJson([
            'message' => [
                'images' => [
                    'The link is dupplicate 3 times'
                ],
            ]
        ]);
    }
}
