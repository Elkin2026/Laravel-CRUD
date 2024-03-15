<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'products';

    public $timestamps = false;

    public function getLabelsColumnName() : array
    {
        return [
            'code' => 'Código del producto' ,
            'description' => 'Descripción' ,
            'size' => 'Talla' ,
            'color' => 'Color' ,
        ];
    }
}
