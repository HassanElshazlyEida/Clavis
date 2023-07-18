<?php 


namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class BaseController extends Controller
{
    protected $model;
    protected $resource;
    protected $collection;

    public function index()
    {
        $items = $this->model::all();
        return $this->resource::collection($items);
    }

    public function show($id)
    {
        $item = $this->model::findOrFail($id);
        return new $this->resource($item);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate($this->getValidationRules());
        
        $item = $this->model::create($validatedData);

        return new $this->resource($item);
    }

    public function update(Request $request, $id)
    {
        $item = $this->model::findOrFail($id);

        $validatedData = $request->validate($this->getValidationRules($id));

        $item->update($validatedData);

        return new $this->resource($item);
    }

    public function destroy($id)
    {
        $item = $this->model::findOrFail($id);
        $item->delete();

        return response()->json(['message' => __('Item deleted')]);
    }

    protected function getValidationRules($id = null)
    {
        return [];
    }
}