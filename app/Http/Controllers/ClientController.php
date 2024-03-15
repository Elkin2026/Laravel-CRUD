<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $model = new Client();
        return response()->json(['data' => $model->all(), 'columns' => $model->getLabelsColumnName()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $model = new Client();
        return view('client.client_form', [
            'labelsColumnName' => $model->getLabelsColumnName(),
            'optionsForSelector' => $model::RANGES_TO_IDENTIFICATION_TYPE,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $model = new Client();
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
       
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $model = Client::findOrFail($id);
        return view('client.client_form', [
            'labelsColumnName' => $model->getLabelsColumnName(),
            'model' => $model,
            'optionsForSelector' => $model::RANGES_TO_IDENTIFICATION_TYPE,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $model = Client::findOrFail($id);
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
        $model = Client::findOrFail($id);
        $model->delete();
    }
}
