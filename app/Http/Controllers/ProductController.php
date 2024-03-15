<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $model = new Product();
        return response()->json(['data' => $model->all(), 'columns' => $model->getLabelsColumnName()]);
    }

    /**
     * Display a listing of the resource.
     */
    public function list()
    {
        return view('product.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $model = new Product();
        return view('product.form', [
            'labelsColumnName' => $model->getLabelsColumnName(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $model = new Product();
            foreach ($model->getLabelsColumnName() as $columnName => $value) {
                $model->{$columnName} = $request->{$columnName};
            }

            $model->save();
            return response()->json(['message' => 'Datos registrados correctamente', 'code' => 200]);
        }  catch (\Illuminate\Database\QueryException $exception) {
            return response()->json(['message' => 'No se pudo guardar el registro. Intentalo más tarde', 'code' => 500]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $model = Product::findOrFail($id);
        return view('product.form', [
            'labelsColumnName' => $model->getLabelsColumnName(),
            'model' => $model,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $model = Product::findOrFail($id);
            foreach ($model->getLabelsColumnName() as $columnName => $value) {
                $model->{$columnName} = $request->{$columnName};
            }

            $model->save();
            return response()->json(['message' => 'Datos registrados correctamente', 'code' => 200]);
        }  catch (\Illuminate\Database\QueryException $exception) {
            return response()->json(['message' => 'No se pudo actualizar el registro. Intentalo más tarde', 'code' => 500]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $model = Product::findOrFail($id);
            $model->delete();
            return response()->json(['message' => 'Registro eliminado correctamente', 'code' => 200]);
        }  catch (\Illuminate\Database\QueryException $exception) {
            return response()->json(['message' => 'No se pudo eliminar el registro. Intentalo más tarde', 'code' => 500]);
        }
    }
}
