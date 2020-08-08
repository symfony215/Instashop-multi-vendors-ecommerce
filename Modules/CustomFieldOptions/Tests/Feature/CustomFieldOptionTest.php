<?php

namespace Modules\CustomFieldOptions\Tests\Feature;

use Tests\TestCase;
use Modules\Stores\Entities\Store;
use Modules\Products\Entities\Product;
use Modules\Categories\Entities\Category;
use Modules\CustomFields\Entities\CustomField;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Astrotomic\Translatable\Validation\RuleFactory;
use Modules\CustomFieldOptions\Entities\CustomFieldOption;

class CustomFieldOptionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_list_custom_field_options()
    {
        $this->withoutExceptionHandling();

        $this->actingAsAdmin();

        $store = factory(Store::class)->create([
            'owner_id' => 1,
            'domain' => 'facebook',
        ]);

        $category = factory(Category::class)->create(['store_id' => 1]);

        $product = factory(Product::class)->create([
            'category_id' => 1,
            'store_id' => 1,
        ]);

        $custom_field = factory(CustomField::class)->create([
            'category_id' => 1,
            'name' => 'cutom_test',
            'store_id' => 1,
        ]);


        factory(CustomFieldOption::class)->create([
            'name' => 'CustomFieldTestName',
            'product_id' => $product->id,
            'custom_field_id' => $custom_field->id,
        ]);

        $response = $this->get(route('dashboard.custom_field_options.index'));

        $response->assertSuccessful();

        $response->assertSee('CustomFieldTestName');
    }

    /* @test */
    public function it_can_display_custom_field_option_details()
    {
        $this->withoutExceptionHandling();

        $this->actingAsAdmin();

        $store = factory(Store::class)->create([
            'owner_id' => 1,
            'domain' => 'facebook',
        ]);

        $category = factory(Category::class)->create(['store_id' => 1]);

        $product = factory(Product::class)->create([
            'category_id' => 1,
            'store_id' => 1,
        ]);

        $custom_field = factory(CustomField::class)->create([
            'category_id' => 1,
            'name' => 'cutom_test',
            'store_id' => 1,
        ]);


        $custom_field_option =factory(CustomFieldOption::class)->create([
            'name' => 'CustomFieldTestName',
            'product_id' => $product->id,
            'custom_field_id' => $custom_field->id,
        ]);

        $response = $this->get(route('dashboard.custom_field_options.show', $custom_field_option));

        $response->assertSuccessful();

        $response->assertSee(e($custom_field_option->name));
    }

//    /** @test */
//    public function it_can_create_a_new_custom_field()
//    {
//        $this->withoutExceptionHandling();
//
//        $this->actingAsAdmin();
//
//        $this->assertEquals(0, CustomField::count());
//
//        $store = factory(Store::class)->create([
//            'owner_id' => 1,
//            'domain' => 'facebook',
//        ]);
//
//        $category = factory(Category::class)->create(['store_id' => 1]);
//
//        $response = $this->post(
//            route('dashboard.custom_field_options.store'),
//            RuleFactory::make(
//                [
//                    '%name%' => 'custom_fieldName',
//                    'category_id' => $category->id,
//                    'store_id' => $store->id,
//                    'code' => 'cysnfnfyy',
//                    'old_price' => 110.2,
//                    'price' => 11.2,
//                    'weight' => 1,
//                    'stock' => 1,
//                    '%description%' => 'it is desc helloDomaind.com',
//                    '%meta_description%' => 'it is meta_desc helloDomaind.com',
//                ]
//            )
//        );
//
//        $response->assertRedirect();
//
//        $this->assertEquals(1, CustomField::count());
//    }
//
//    /** @test */
//    public function it_can_display_custom_field_create_form()
//    {
//        $this->actingAsAdmin();
//
//        $response = $this->get(route('dashboard.custom_field_options.create'));
//
//        $response->assertSuccessful();
//
//        $response->assertSee(trans('custom_field_options::custom_field_options.actions.create'));
//    }
//
//    /** @test */
//    public function it_can_display_custom_field_edit_form()
//    {
//        $this->actingAsAdmin();
//
//        $custom_field = factory(CustomField::class)->create();
//
//        $response = $this->get(route('dashboard.custom_field_options.edit', $custom_field));
//
//        $response->assertSuccessful();
//
//        $response->assertSee(trans('custom_field_options::custom_field_options.actions.edit'));
//    }
//
//    /** @test */
//    public function it_can_update_custom_field()
//    {
//        $this->actingAsAdmin();
//
//        $this->assertEquals(0, CustomField::count());
//
//        $custom_field = factory(CustomField::class)->create();
//
//        $response = $this->put(
//            route('dashboard.custom_field_options.update', $custom_field),
//            RuleFactory::make(
//                [
//                    '%name%' => 'customFieldName2',
//                    'category_id' => 1,
//                    'store_id' => 1,
//                    'code' => 'cysyy',
//                    'old_price' => '110.2',
//                    'price' => '11.2',
//                    'weight' => '1',
//                    'stock' => '1',
//                    '%description%' => 'it is desc helloDomaind.com',
//                    '%meta_description%' => 'it is meta_desc helloDomaind.com',
//                ]
//            )
//        );
//
//        $custom_field->refresh();
//
//        $response->assertRedirect();
//
//        $this->assertEquals($custom_field->name, 'customFieldName2');
//    }
//
//    /** @test */
//    public function it_can_delete_custom_field()
//    {
//        $this->withoutExceptionHandling();
//
//        $this->actingAsAdmin();
//
//        $custom_field = factory(CustomField::class)->create();
//
//        $this->assertEquals(CustomField::count(), 1);
//
//        $response = $this->delete(route('dashboard.custom_field_options.destroy', $custom_field));
//
//        $response->assertRedirect();
//
//        $this->assertEquals(CustomField::count(), 0);
//    }
}
