<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    const RANGES_TO_IDENTIFICATION_TYPE = [
        'CC' => 'Cédula de ciudadania',
        'NIT' => 'Número de indentificacíon tributaria',
        'RUT' => 'Registro único tributario',
    ];
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'clients';
    public $timestamps = false;

    public function getLabelsColumnName() : array
    {
        return [
            'identification_type' => 'Tipo de identificación',
            'identification_number' => 'Número de identificación' ,
            'name' => 'Nombre' ,
            'email' => 'Correo electrónico' ,
            'address' => 'Dirección' ,
            'phone_number' => 'Número de teléfono' ,
            'contact_name' => 'Nombre de contacto' ,
        ];
    }
}
