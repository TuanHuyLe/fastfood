<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use App\Components\Recursive;

class CategoryController extends Controller
{

    private $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function index()
    {
        $data = $this->category->latest()->paginate(5);
        return view('admin.category.index', compact('data'));
    }

    public function create()
    {
        $htmlOption = $this->getCategory('');
        return view('admin.category.add', compact('htmlOption'));
    }

    public function store(Request $request)
    {
        $this->category->create([
            'name' => $request->name,
            'parent_id' => $request->parent_id,
            'slug' => str_slug($request->name)
        ]);
        return redirect()->route('categories.index');
    }

    public function getCategory($pid)
    {
        $data = $this->category->all();
        $recursive = new Recursive($data);
        return $recursive->timcon($pid);
    }

    public function edit($id)
    {
        $data = $this->category->find($id);
        $htmlOption = $this->getCategory($data->parent_id);
        return view('admin.category.edit', compact('data', 'htmlOption'));
    }

    public function update($id, Request $request)
    {
        $this->category->find($id)->update([
            'name' => $request->name,
            'parent_id' => $request->parent_id,
            'slug' => str_slug($request->name)
        ]);
        return redirect()->route('categories.index');
    }

    public function delete($id)
    {
        $this->category->find($id)->delete();
        return redirect()->route('categories.index');
    }
}
