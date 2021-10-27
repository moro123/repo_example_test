<?php 
namespace App\Domain\Sections\Models;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model {

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
    public $timestamps = false;

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

    public function delete(){
		$status = \DB::transaction(function()
		{
			try {
			   unlink( $this->image );
			} catch(\Exception $e) {
			}
	
            $this->social_media()->delete();
			return parent::delete();
		});
	
		return $status;
	}


}
?>