<?php
/**
 * Created by PhpStorm.
 * User: helder
 * Date: 10/07/2016
 * Time: 23:12
 */

namespace CodePress\CodeCategory\Tests\Controllers;

use CodePress\CodeCategory\Repository\CategoryRepositoryEloquent;
use CodePress\CodeCategory\Models\Category;
use CodePress\CodeCategory\tests\AbstractTestCase;
use CodePress\CodeCategory\Controllers\Controller;
use CodePress\CodeCategory\Controllers\AdminCategororiesController;
use Illuminate\Routing\ResponseFactory;
use Mockery as m;

class AdminCategoriesControllersTest extends AbstractTestCase
{

    public function test_should_extends_from_controller()
    {
        $repo = m::mock(CategoryRepositoryEloquent::class);
        $responseFactory = m::mock(ResponseFactory::class);
        $controller = new AdminCategororiesController($responseFactory, $repo);

        $this->assertInstanceOf(Controller::class, $controller);
    }

    public function test_controller_should_run_index_method_and_return_right_arguments()
    {
        $repo = m::mock(CategoryRepositoryEloquent::class);
        $responseFactory = m::mock(ResponseFactory::class);
        $controller = new AdminCategororiesController($responseFactory, $repo);
        $html = m::mock();
        $categoriesResult = ['Cat1', 'Cat2', 'Cat3'];
        $repo->shouldReceive('all')->andReturn($categoriesResult);
        $responseFactory->shouldReceive('view')
            ->with('codecategory::index', ['values' => $categoriesResult])
            ->andReturn($html);
        $this->assertEquals($controller->index(), $html);
    }

}