<?php 
namespace App\Http\Models;
use Illuminate\Database\Eloquent\Model;

class Front extends Model {

    /**
     * The table associated with the model 
    *
    * @var string
    */
    protected $table = 'front';

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
        'header',
        'image',
    ];

    public function delete(){
		$status = \DB::transaction(function()
		{
			try {
			   unlink( $this->image );
			} catch(\Exception $e) {
			}
			return parent::delete();
		});
	
		return $status;
	}


}
?>