<?php 
namespace App\Domain\Sections\Models;
use Illuminate\Database\Eloquent\Model;

class Folder extends Model {

    /**
     * The table associated with the model 
    *
    * @var string
    */
    protected $table = 'folder';

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
        'section_id'
    ];

    public function documents()
    {
        return $this->hasMany(Document::class);
    }


    public function delete(){
		$status = \DB::transaction(function()
		{
            $this->documents->delete();
			return parent::delete();
		});
	
		return $status;
	}


}
?>