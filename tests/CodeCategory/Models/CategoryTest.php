<?php

namespace CodePress\CodeCategory\Tests\Model;

use CodePress\CodeCategory\tests\AbstractTestCase;
use CodePress\CodeCategory\Models\Category;
use CodePress\CodeCategory\Models\Post;
use Illuminate\Validation\Validator;
use Mockery as m;

class CategoryTest extends AbstractTestCase
{

    public function setUp()
    {
        parent::setUp();
        $this->migrate();
    }

    public function test_inject_validator_in_category_model()
    {
        $category = new Category();
        $validator = m::mock(Validator::class);
        $category->setValidator($validator);
        $this->assertEquals($category->getValidator(), $validator);
    }

    public function test_should_check_if_is_valid_when_it_is()
    {
        $category = new Category();
        $category->name = 'Category Test';
        $validator = m::mock(Validator::class);
        $validator->shouldReceive('setRules')->with(['name' => 'required|max:255']);
        $validator->shouldReceive('setData')->with(['name' => 'Category Test']);
        $validator->shouldReceive('fails')->andReturn(false);
        $category->setValidator($validator);
        $this->assertTrue($category->isValid());
    }

    public function test_if_a_category_can_be_persisted()
    {
        $category = Category::create([
            'name' => 'Category Teste',
            'acive' => true
        ]);

        $this->assertEquals('Category Teste', $category->name);

        $category = Category::all()->first();
        $this->assertEquals('Category Teste', $category->name);

    }

    public function test_if_can_assign_a_parent_to_a_category()
    {
        $parentCategory = Category::create([
            'name' => 'Category Parent', 'active' => true
        ]);

        $category = Category::create([
            'name' => 'Category Teste',
            'acive' => true
        ]);

        $category->parent()->associate($parentCategory)->save();

        $child = $parentCategory->children->first();

        $this->assertEquals('Category Teste', $child->name);

        $this->assertEquals('Category Parent', $category->parent->name);

    }

    public function test_can_add_posts_to_categories()
    {
        $category = Category::create([
            'name' => 'Category Teste',
            'acive' => true
        ]);

        $post1 = Post::create(['title' => 'meu post 1']);
        $post2 = Post::create(['title' => 'meu post 2']);

        $post1->categories()->save($category);
        $post2->categories()->save($category);

        $this->assertCount(1, Category::all());
        $this->assertEquals('Category Teste', $post1->categories->first()->name);
        $this->assertEquals('Category Teste', $post2->categories->first()->name);

        $posts = Category::find(1)->posts;

        $this->assertCount(2, $posts);

        $this->assertEquals('meu post 1', $posts[0]->title);
        $this->assertEquals('meu post 2', $posts[1]->title);

    }

}