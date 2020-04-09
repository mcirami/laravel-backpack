<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;

class Lesson extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'lessons';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    // protected $guarded = ['id'];
    protected $fillable = ['title', 'og_image', 'description', 'member_link', 'free_link', 'share_link', 'files', 'categories', 'upgrade_link', 'notation', 'keyboard'];
    // protected $hidden = [];
    // protected $dates = [];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

	public function categories() {
		return $this->belongsToMany('App\Models\Category');
	}

	/*public function category_lesson() {
		return $this->belongsTo('App\Models\LessonCategory', 'category_id');
	}*/

	/*
	|--------------------------------------------------------------------------
	| SCOPES
	|--------------------------------------------------------------------------
	*/

    /*
    |--------------------------------------------------------------------------
    | ACCESORS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */

	public function setOGImageAttribute($value) {

		$attribute_name = "og_image";
		$disk = "uploads";
		$destination_path = "lesson-images";

		// if the image was erased
		if ($value==null) {
			// delete the image from disk
			\Storage::disk($disk)->delete($this->{$attribute_name});

			// set null in the database column
			$this->attributes[$attribute_name] = null;
		}

		// if a base64 was sent, store it in the db
		if (starts_with($value, 'data:image'))
		{
			// 0. Make the image
			$image = \Image::make($value);
			// 1. Generate a filename.
			$filename = md5($value.time()).'.jpg';
			// 2. Store the image on disk.
			\Storage::disk($disk)->put($destination_path.'/'.$filename, $image->stream());
			// 3. Save the path to the database
			$this->attributes[$attribute_name] = $filename;
		}
	}

	public function setFilesAttribute($value) {
		$attribute_name = "files";
		$disk = "uploads";
		$destination_path = "lesson-files";

		$this->uploadMultipleFilesToDisk($value, $attribute_name, $disk, $destination_path);
	}

	protected $casts = [
		'files' => 'array',
		'categories' => 'array'
	];
}
