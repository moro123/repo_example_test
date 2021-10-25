<?php 
namespace App\Domain\Sections\Models;
use Illuminate\Database\Eloquent\Model;

class Section extends Model {

    /**
     * The table associated with the model 
    *
    * @var string
    */
    protected $table = 'section';

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
        'header',
        'title',
        'subtitle',
        'description',
        'image',
        'video',
        'date',
        'main_section_id',
        'section_id',
        'name',
        'legend',
        'link'
    ];

    public function images()
    {
        return $this->hasMany(Images::class);
    }

    public function folders()
    {
        return $this->hasMany(Folder::class);
    }

    public function profiles()
    {
        return $this->hasMany(Profile::class);
    }

    public function childrenSections()
    {
        return $this->hasMany('App\Domain\Sections\Models\Section');
    }

    public function allChildrenSections()
    {
        return $this->childrenSections()->with('allChildrenSections');
    }

    public function parentSection()
    {
        return $this->belongsTo('App\Domain\Sections\Models\Section','section_id','id');
    }

    public function allParentSections()
    {
        return $this->parentSection()->with('allParentSections');
    }

    
	public function delete(){
		$status = \DB::transaction(function()
		{
			try {
			   unlink( $this->image );
			   unlink( $this->video );
			} catch(\Exception $e) {
			}
	
			return parent::delete();
		});
	
		return $status;
	}

}
?>