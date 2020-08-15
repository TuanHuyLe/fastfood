<?php

namespace App\Http\Controllers;

use App\Components\MenuRecursive;
use App\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    private $menuRecursive;
    private $menu;

    public function __construct(MenuRecursive $menuRecursive, Menu $menu)
    {
        $this->menuRecursive = $menuRecursive;
        $this->menu = $menu;
    }

    public function index()
    {
        $menus = $this->menu->paginate(10);
        return view('admin.menu.index', compact('menus'));
    }

    public function create()
    {
        $optionSelect = $this->menuRecursive->menuRecursiveAdd();
        return view('admin.menu.add', compact('optionSelect'));
    }

    public function store(Request $request)
    {
        $this->menu->create([
            'name' => $request->name,
            'parent_id' => $request->parent_id,
            'slug' => str_slug($request->name)
        ]);
        return redirect()->route('menus.index');
    }

    public function delete($id)
    {
        $this->menu->find($id)->delete();
        return redirect()->route('menus.index');
    }

    public function edit($id)
    {
        $menu = $this->menu->find($id);
        $htmlOption = $this->menuRecursive->menuRecursiveEdit($menu->parent_id);
        return view('admin.menu.edit', compact('menu', 'htmlOption'));
    }

    public function update($id, Request $request)
    {
        $this->menu->find($id)->update([
            'name' => $request->name,
            'parent_id' => $request->parent_id,
            'slug' => str_slug($request->name)
        ]);
        return redirect()->route('menus.index');
    }
}
