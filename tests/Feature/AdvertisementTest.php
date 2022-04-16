<?php

namespace Tests\Feature;

use App\Models\Advertisement;
use Carbon\Carbon;
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
        $this->store_ads_failed_duplicate_images();
        $this->list_ads_success_with_all_data();
        $this->list_ads_success_without_order_by();
        $this->list_ads_success_without_order_type();
        $this->list_ads_success_without_order_type_and_order_by();
        $this->list_ads_success_without_page();
        $this->list_ads_success_without_per_page();
        $this->list_ads_success_without_all_data();
        $this->list_ads_failed_invalid_per_page();
        $this->list_ads_failed_invalid_page();
        $this->list_ads_failed_invalid_order_by();
        $this->list_ads_failed_invalid_order_type();
    }

    public function store_ads_success()
    {
        $data = [
            'name' => "test name",
            'description' => "test description",
            'price' => 1,
            'photos' => [
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
            'photos' => [
                "http://dotnetguru.org/wp-content/uploads/2019/08/php.jpg",
                "http://dotnetguru.org/wp-content/uploads/2019/08/php.jpg"
            ]
        ];
        $response = $this->post('api/advertisement', $data);
        $response->assertStatus(500)->assertJson([
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
            'name' => Str::random(Advertisement::MAX_CHARACTERS_NAME + rand(1, 1000)),
            'description' => "test description",
            'price' => 1,
            'images' => [
                "http://dotnetguru.org/wp-content/uploads/2019/08/php.jpg",
                "http://dotnetguru.org/wp-content/uploads/2019/08/php.jpg"
            ]
        ];
        $response = $this->post('api/advertisement', $data);
        $response->assertStatus(500)->assertJson([
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
        $response->assertStatus(500)->assertJson([
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
        $response->assertStatus(500)->assertJson([
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
            'description' => Str::random(Advertisement::MAX_CHARACTERS_DESCRIPTION + rand(1, 1000)),
            'name' => "test name",
            'price' => 1,
            'images' => [
                "http://dotnetguru.org/wp-content/uploads/2019/08/php.jpg",
                "http://dotnetguru.org/wp-content/uploads/2019/08/php.jpg"
            ]
        ];
        $response = $this->post('api/advertisement', $data);
        $response->assertStatus(500)->assertJson([
            'message' => [
                'description' => [
                    'The description must not be greater than 1000 characters.'
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
        $response->assertStatus(500)->assertJson([
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
        $response->assertStatus(500)->assertJson([
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
        $response->assertStatus(500)->assertJson([
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
        $response->assertStatus(500)->assertJson([
            'message' => [
                'photos' => [
                    'The photos field is required.'
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
            'photos' => "http://dotnetguru.org/wp-content/uploads/2019/08/php.jpg",
        ];
        $response = $this->post('api/advertisement', $data);
        $response->assertStatus(500)->assertJson([
            'message' => [
                'photos' => [
                    'The photos must be an array.'
                ],
            ]
        ]);
    }

    public function store_ads_failed_duplicate_images()
    {
        $data = [
            'name' => "test name",
            'description' => "test description",
            'price' => 1,
            'photos' => [
                "http://dotnetguru.org/wp-content/uploads/2019/08/php.jpg",
                "http://dotnetguru.org/wp-content/uploads/2019/08/php.jpg",
                "http://dotnetguru.org/wp-content/uploads/2019/08/php.jpg"
            ],
        ];
        $response = $this->post('api/advertisement', $data);
        $response->assertStatus(500)->assertJson([
            'message' => [
                'photos' => [
                    'The link is duplicate 3 times'
                ],
            ]
        ]);
    }

    public function list_ads_success_with_all_data() {
        $perPage = rand(1, 1000);
        $orderByList = ['price', 'created_at'];
        $orderTypeList = ['asc', 'desc'];
        $page = rand(1, 1000);
        $index = rand(0,1);
        $response = $this->get('api/advertisement?per_page='.$perPage.'&order_by='.$orderByList[$index].'&order_type='.$orderTypeList[$index].'&page='.$page);
        $response->assertStatus(200);
    }

    public function list_ads_success_without_order_by() {
        $perPage = rand(1, 1000);
        $page = rand(1, 1000);
        $orderTypeList = ['asc', 'desc'];
        $index = rand(0,1);
        $response = $this->get('api/advertisement?per_page='.$perPage.'&order_type='.$orderTypeList[$index].'&page='.$page);
        $response->assertStatus(200);
    }

    public function list_ads_success_without_order_type() {
        $perPage = rand(1, 1000);
        $page = rand(1, 1000);
        $orderByList = ['price', 'created_at'];
        $index = rand(0,1);
        $response = $this->get('api/advertisement?per_page='.$perPage.'&order_by='.$orderByList[$index].'&page='.$page);
        $response->assertStatus(200);
    }

    public function list_ads_success_without_order_type_and_order_by() {
        $perPage = rand(1, 1000);
        $page = rand(1, 1000);
        $response = $this->get('api/advertisement?per_page='.$perPage.'&page='.$page);
        $response->assertStatus(200);
    }

    public function list_ads_success_without_page() {
        $perPage = rand(1, 1000);
        $orderByList = ['price', 'created_at'];
        $index = rand(0,1);
        $response = $this->get('api/advertisement?per_page='.$perPage.'&order_by='.$orderByList[$index]);
        $response->assertStatus(200);
    }

    public function list_ads_success_without_per_page() {
        $orderByList = ['price', 'created_at'];
        $orderTypeList = ['asc', 'desc'];
        $page = rand(1, 1000);
        $index = rand(0,1);
        $response = $this->get('api/advertisement?&order_by='.$orderByList[$index].'&order_type='.$orderTypeList[$index].'&page='.$page);
        $response->assertStatus(200);
    }

    public function list_ads_success_without_all_data() {
        $response = $this->get('api/advertisement');
        $response->assertStatus(200);
    }

    public function list_ads_failed_invalid_per_page(){
        $perPage = Str::random(2);
        $orderByList = ['price', 'created_at'];
        $orderTypeList = ['asc', 'desc'];
        $page = rand(1, 1000);
        $index = rand(0,1);
        $response = $this->get('api/advertisement?per_page='.$perPage.'&order_by='.$orderByList[$index].'&order_type='.$orderTypeList[$index].'&page='.$page);
        $response->assertStatus(500)->assertJson([
            'message' => [
                'per_page' => [
                    'The per page must be a number.'
                ],
            ]
        ]);
    }

    public function list_ads_failed_invalid_page(){
        $page = Str::random(2);
        $orderByList = ['price', 'created_at'];
        $orderTypeList = ['asc', 'desc'];
        $perPage = rand(1, 1000);
        $index = rand(0,1);
        $response = $this->get('api/advertisement?per_page='.$perPage.'&order_by='.$orderByList[$index].'&order_type='.$orderTypeList[$index].'&page='.$page);
        $response->assertStatus(500)->assertJson([
            'message' => [
                'page' => [
                    'The page must be a number.'
                ],
            ]
        ]);
    }

    public function list_ads_failed_invalid_order_by(){
        $page = rand(1, 1000);
        $order_by = Str::random(2);
        $orderTypeList = ['asc', 'desc'];
        $perPage = rand(1, 1000);
        $index = rand(0,1);
        $response = $this->get('api/advertisement?per_page='.$perPage.'&order_by='.$order_by.'&order_type='.$orderTypeList[$index].'&page='.$page);
        $response->assertStatus(500)->assertJson([
            'message' => [
                'order_by' => [
                    'The order_by is invalid'
                ],
            ]
        ]);
    }

    public function list_ads_failed_invalid_order_type(){
        $page = rand(1, 1000);
        $orderByList = ['price', 'created_at'];
        $order_type = Str::random(2);
        $perPage = rand(1, 1000);
        $index = rand(0,1);
        $response = $this->get('api/advertisement?per_page='.$perPage.'&order_by='.$orderByList[$index].'&order_type='.$order_type.'&page='.$page);
        $response->assertStatus(500)->assertJson([
            'message' => [
                'order_type' => [
                    'The order_type is invalid'
                ],
            ]
        ]);
    }


}
