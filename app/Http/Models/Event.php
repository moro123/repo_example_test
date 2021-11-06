<?php 
namespace App\Http\Models;
use Illuminate\Database\Eloquent\Model;

class Event extends Model {

    /**
     * The table associated with the model 
    *
    * @var string
    */
    protected $table = 'event';

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
        'title',
        'date',
        'subtitle',
        'content',
        'image',
        'file',
        'published'
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