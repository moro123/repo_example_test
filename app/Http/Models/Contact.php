<?php 
namespace App\Http\Models;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model {

    /**
     * The table associated with the model 
    *
    * @var string
    */
    protected $table = 'contact';

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
        'name',
        'phone',
        'email',
        'notice_id',
        'event_id'
    ];

    // public function delete(){
	// 	$status = \DB::transaction(function()
	// 	{
	// 		try {
	// 		   unlink( $this->image );
	// 		} catch(\Exception $e) {
	// 		}
	
    //         $this->social_media()->delete();
	// 		return parent::delete();
	// 	});
	
	// 	return $status;
	// }


}
?>