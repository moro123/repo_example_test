<?php 
namespace App\Domain\Sections\Models;
use Illuminate\Database\Eloquent\Model;

class Department extends Model {

    /**
     * The table associated with the model 
    *
    * @var string
    */
    protected $table = 'profiles';

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
        'title',
        'image',
        'description',
        'section_id'
    ];

    public function social_media()
    {
        return $this->hasMany(SocialMedia::class);
    }


}
?>