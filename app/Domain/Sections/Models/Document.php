<?php 
    namespace App\Domain\Sections\Models;
    use Illuminate\Database\Eloquent\Model;

    class Document extends Model {

      /**
      * The table associated with the model 
      *
      * @var string
      */
      protected $table = 'documents';

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
        'link'
      ];

      public function delete(){
        $status = \DB::transaction(function()
        {
          try {
            unlink( $this->link );
          } catch(\Exception $e) {
          }

          return parent::delete();
        });
      
        return $status;
      }
}
?>