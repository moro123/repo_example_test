<?php 
namespace App\Http\Models;
use Illuminate\Database\Eloquent\Model;

class Post extends Model {

    /**
     * The table associated with the model 
    *
    * @var string
    */
    protected $table = 'post';

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
        'users_id',
        'title',
        'subtitle',
        'meta_title',
        'content',
        'published',
        'posted_at',
        'created_at',
        'updated_at'
    ];

    public function contacts()
    {
        return $this->hasMany(Contact::class, 'event_id', );
    }

    public function delete(){
		$status = \DB::transaction(function()
		{
			try {
			   unlink( $this->image );
               unlink( $this->file );
			} catch(\Exception $e) {
			}
	
            
			return parent::delete();
		});
	
		return $status;
	}


}
?>