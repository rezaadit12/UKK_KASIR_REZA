<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BaseController extends Controller
{
    protected $model;
    protected $view;
    public function index()
    {
        $items = $this->model::all();
        return view("module.{$this->view}.index", compact("items"));
    }

    public function create()
    {
        return view("module.{$this->view}.create");
    }

    public function edit($id)
    {
        $item = $this->model::findOrFail($id);
        return view("module.{$this->view}.update", compact("item"));
    }
}
