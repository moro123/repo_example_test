<?php 
namespace App\Domain\Sections\Models;
use Illuminate\Database\Eloquent\Model;

class Department extends Model {

    /**
     * The table associated with the model 
    *
    * @var string
    */
    protected $table = 'page';

    /**
     * Indicates if the model should be timestamped
    *
    * @var bool
    */
    public $timestamps = true;

    /**
     * The atributes that are mass assignable
    *
    * @var array
    */
    protected $fillable = [
        'name',
    ];

    public function main_sections()
    {
        return $this->hasMany(MainSection::class);
    }


}
?>