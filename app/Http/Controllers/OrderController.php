<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Client;
use App\Models\Product;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $model = new Order();
        return response()->json(['data' => $model->all(), 'columns' => $model->getLabelsColumnName()]);
    }

    public function list()
    {
        return view('order.index');       
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $model = new Order();
        $clients = json_decode(json_encode(Client::all()));
        $products = json_decode(json_encode(Product::all()));
        $optionsForSelectorInClients = array_map(fn($client) => ['id' => $client->id, 'name' => $client->name], $clients);
        $optionsForSelectorInProducts = array_map(fn($product) => ['id' => $product->id, 'name' => $product->description], $products);
        return view('order.form', [
            'labelsColumnName' => $model->getLabelsColumnName(),
            'optionsForSelector' => $model::RANGES_TO_STATE,
            'clients' => $optionsForSelectorInClients,
            'products' => $optionsForSelectorInProducts,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $model = new Order();
            foreach ($model->getLabelsColumnName() as $columnName => $value) {
                $model->{$columnName} = $request->{$columnName};
            }
            $model->code_transaction = 0;
            $model->client_id =  $request->client['id'];
            $model->client_name =  $request->client['name'];
            $model->product_id = $request->product['id'];
            $model->product_name = $request->product['name'];
            $model->created_at = date('Y-m-d H:i:s');
            $model->save();

            $model->code_transaction  = $model->getCode();
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
        $model = Order::findOrFail($id);
        $clients = json_decode(json_encode(Client::all()));
        $products = json_decode(json_encode(Product::all()));
        $optionsForSelectorInClients = array_map(fn($client) => ['id' => $client->id, 'name' => $client->name], $clients);
        $optionsForSelectorInProducts = array_map(fn($product) => ['id' => $product->id, 'name' => $product->description], $products);
        return view('order.form', [
            'labelsColumnName' => $model->getLabelsColumnName(),
            'optionsForSelector' => $model::RANGES_TO_STATE,
            'clients' => $optionsForSelectorInClients,
            'products' => $optionsForSelectorInProducts,
            'model' =>$model
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $model = Order::findOrFail($id);
            foreach ($model->getLabelsColumnName() as $columnName => $value) {
                $model->{$columnName} = $request->{$columnName};
            }

            $model->code_transaction = $model->getCode();
            $model->client_id = $request->client['id'];
            $model->client_name = $request->client['name'];
            $model->product_id = $request->product['id'];
            $model->product_name = $request->product['name'];
            $model->save();
            return response()->json(['message' => 'Datos registrados correctamente', 'code' => 200]);
        }  catch (\Illuminate\Database\QueryException $exception) {
            return response()->json(['message' => 'No se pudo guardar el registro. Intentalo más tarde', 'code' => $exception->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $model = Order::findOrFail($id);
            $model->delete();
            return response()->json(['message' => 'Registro eliminado correctamente', 'code' => 200]);
        }  catch (\Illuminate\Database\QueryException $exception) {
            return response()->json(['message' => 'No se pudo eliminar el registro. Intentalo más tarde', 'code' => 500]);
        }
    }
}
