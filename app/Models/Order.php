<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Order extends Model
{
    use HasFactory;

    const RANGES_TO_STATE = [
        'new' => 'Nuevo',
        'in_process' => 'En proceso',
        'shipped' => 'Despachado',
        'finished' => 'Finalizado',
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'orders';

    public $timestamps = false;

    public function getLabelsColumnName() : array
    {
        return [
            'code_transaction' => 'Código de pedido',
            'date_of_request' => 'Fecha de solicitud',
            'date_of_delivery' => 'Fecha de entrega',
            'created_at' => 'Fecha de creación',
            'client_id' => 'ID del cliente',
            'product_id' => 'ID producto',
            'product_name' => 'Nombre producto',
            'client_name' => 'Nombre del cliente',
            'quantity_request_by_client' => 'Cantidad solicitada por el cliente',
            'state' => 'Estado del pedido',
        ];
    }

    public function product(): HasOne
    {
        return $this->hasOne(Product::class, 'foreign_key', 'local_key');
    }

    public function client(): HasOne
    {
        return $this->hasOne(Client::class, 'foreign_key', 'local_key');
    }
    
    protected static function boot()
    {
        parent::boot();
        static::retrieved(function ($model) {
            $model->state = self::RANGES_TO_STATE[$model->state];
        });
    }

    public function getCode() : string
    {
        $prefixCode = "Co&tex-";
        return $prefixCode . str_pad($this->id, 6, '0', STR_PAD_LEFT);
    }
}
