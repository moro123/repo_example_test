<?php 
namespace App\Domain\Sections\Models;
use Illuminate\Database\Eloquent\Model;

class MainSection extends Model {

    /**
     * The table associated with the model 
    *
    * @var string
    */
    protected $table = 'main_section';

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
        'page_id'
    ];

    public function sections()
    {
        return $this->hasMany(Section::class);
    }


}
?>