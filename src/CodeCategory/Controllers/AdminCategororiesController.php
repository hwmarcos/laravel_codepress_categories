<?php

namespace CodePress\CodeCategory\Controllers;

use CodePress\CodeCategory\Controllers\Controller;
use CodePress\CodeCategory\Models\Category;
use CodePress\CodeCategory\Repository\CategoryRepository;
use CodePress\CodeCategory\Repository\CategoryRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Contracts\Routing\ResponseFactory;

class AdminCategororiesController extends Controller
{

    private $repository;
    private $response;

    public function __construct(ResponseFactory $response, CategoryRepositoryInterface $repository)
    {
        $this->repository = $repository;
        $this->response = $response;
    }

    public function index()
    {
        $values = $this->repository->all();

        //dd($values[2]->parent->name);

        return $this->response->view('codecategory::index', compact('values'));
    }

    public function create()
    {
        $values = $this->repository->all();
        return view('codecategory::create', compact('values'));
    }

    public function store(Request $request)
    {
        $this->repository->create($request->all());
        return redirect()->route('admin.categories.index');
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $data['active'] == !isset($data['active']) ? false : true;
        if (!isset($data['parent-id']) || (isset($data['parent_id']) && $data['parent_id'])) {
            $data['parent_id'] = null;
        }
        $this->repository->update($data, $request->id);
        return redirect()->route('admin.categories.update');

    }

}