<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Destination;


/**
 * Class ErratumDivision
 * @package App\Models
 * @version November 27, 2021, 2:06 pm JST
 *
 * @property string $name
 */
class ErratumDivision extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'erratum_divisions';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'name'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required'
    ];

    public function destination(){
        return $this -> hasOne(Destination::class);
    } 
    
}
