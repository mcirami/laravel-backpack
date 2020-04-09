<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\LessonRequest as StoreRequest;
use App\Http\Requests\LessonRequest as UpdateRequest;

class LessonCrudController extends CrudController
{
    public function setup()
    {

        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\Lesson');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/lesson');
        $this->crud->setEntityNameStrings('lesson', 'lessons');

        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */

        $this->crud->setFromDb();

        // ------ CRUD FIELDS
        // $this->crud->addField($options, 'update/create/both');
        // $this->crud->addFields($array_of_arrays, 'update/create/both');
        // $this->crud->removeField('name', 'update/create/both');
        // $this->crud->removeFields($array_of_names, 'update/create/both');

	    // upload image
	    $this->crud->addField([
	        'label' => "OG Image",
			'name' => "og_image",
			'type' => 'image',
			'upload' => true,
			'crop' => false, // set to true to allow cropping, false to disable
			'aspect_ratio' => 0, // ommit or set to 0 to allow any aspect ratio
			'prefix' => 'uploads/lesson-images/', // in case you only store the filename in the database, this text will be prepended to the database value
			'save_path_to_database' => true
	    ]);

	    // Upload file
	    $this->crud->addField([
			    'name' => 'files',
			    'label' => 'File(s)',
			    'type' => 'upload_multiple',
			    'upload' => true,
			    'prefix' => 'uploads/lesson-images/',
			    'save_path_to_database' => true,
			    //'disk' => 'uploads', // if you store files in the /public folder, please ommit this; if you store them in /storage or S3, please specify it;
	    ]);

	    // Lesson categories
	    $this->crud->addField([
			 'label' => 'Categories',
			 'name' => 'categories',
			 'type' => 'select2_multiple',
			 'entity' => 'categories',
			 'attribute' => 'name',
			 'model' => "App\Models\Category",
			 'pivot' => true,
	    ]);

	    // Add upgrade link to
	    $this->crud->addField([
		    'name' => 'upgrade_link',
		    'label' => 'Add Upgrade Link',
		    'type' => 'checkbox'
	    ]);

	    // Lesson has Notation
	    $this->crud->addField([
		     'name' => 'notation',
		     'label' => 'Has Notation - Use Top Controls',
		     'type' => 'checkbox'
	    ]);

	    // Display SoundSlice Keyboard video
	    $this->crud->addField([
		     'name' => 'keyboard',
		     'label' => 'Display Keyboard Video',
		     'type' => 'checkbox'
	    ]);

        // ------ CRUD COLUMNS
        // $this->crud->addColumn(); // add a single column, at the end of the stack
        // $this->crud->addColumns(); // add multiple columns, at the end of the stack
        // $this->crud->removeColumn('column_name'); // remove a column from the stack
        // $this->crud->removeColumns(['column_name_1', 'column_name_2']); // remove an array of columns from the stack
        // $this->crud->setColumnDetails('column_name', ['attribute' => 'value']); // adjusts the properties of the passed in column (by name)
        // $this->crud->setColumnsDetails(['column_1', 'column_2'], ['attribute' => 'value']);

	    $this->crud->addColumns(['title', 'description', 'member_link', 'free_link', 'share_link', 'og_image']);

	    $this->crud->addColumn([
		    'name' => 'upgrade_link', // The db column name
		    'label' => "Upgrade Link", // Table column heading
		    'type' => 'check'
	    ]);

	    $this->crud->addColumn([
		    'name' => 'notation', // The db column name
		    'label' => "Notation", // Table column heading
		    'type' => 'check'
	    ]);

	    $this->crud->addColumn([
		    'name' => 'keyboard', // The db column name
		    'label' => "Keyboard", // Table column heading
		    'type' => 'check'
	    ]);

	    $this->crud->addColumn([
		    'name' => 'og_image', // The db column name
		    'label' => "OG Image", // Table column heading
		    'type' => 'image',
		    'prefix' => 'uploads/lesson-images/',
		    // optional width/height if 25px is not ok with you
		     'height' => '30px',
		     'width' => '30px',
	    ]);

	    $this->crud->addColumn([
		    'name' => 'files', // The db column name
		    'label' => "File(s)", // Table column heading
		    'type' => 'array'
	    ]);

	    $this->crud->addColumn([
		    'name' => 'categories', // The db column name
		    'label' => "Categories", // Table column heading
		    'type' => 'select_multiple',
		    'attribute' => 'name',
		    'entity' => 'categories',
		    'model' => "App\Models\Category"
	    ]);

        // ------ CRUD BUTTONS
        // possible positions: 'beginning' and 'end'; defaults to 'beginning' for the 'line' stack, 'end' for the others;
        // $this->crud->addButton($stack, $name, $type, $content, $position); // add a button; possible types are: view, model_function
        // $this->crud->addButtonFromModelFunction($stack, $name, $model_function_name, $position); // add a button whose HTML is returned by a method in the CRUD model
        // $this->crud->addButtonFromView($stack, $name, $view, $position); // add a button whose HTML is in a view placed at resources\views\vendor\backpack\crud\buttons
        // $this->crud->removeButton($name);
        // $this->crud->removeButtonFromStack($name, $stack);
        // $this->crud->removeAllButtons();
        // $this->crud->removeAllButtonsFromStack('line');

        // ------ CRUD ACCESS
        // $this->crud->allowAccess(['list', 'create', 'update', 'reorder', 'delete']);
        // $this->crud->denyAccess(['list', 'create', 'update', 'reorder', 'delete']);

        // ------ CRUD REORDER
        // $this->crud->enableReorder('label_name', MAX_TREE_LEVEL);
        // NOTE: you also need to do allow access to the right users: $this->crud->allowAccess('reorder');

        // ------ CRUD DETAILS ROW
        // $this->crud->enableDetailsRow();
        // NOTE: you also need to do allow access to the right users: $this->crud->allowAccess('details_row');
        // NOTE: you also need to do overwrite the showDetailsRow($id) method in your EntityCrudController to show whatever you'd like in the details row OR overwrite the views/backpack/crud/details_row.blade.php

        // ------ REVISIONS
        // You also need to use \Venturecraft\Revisionable\RevisionableTrait;
        // Please check out: https://laravel-backpack.readme.io/docs/crud#revisions
        // $this->crud->allowAccess('revisions');

        // ------ AJAX TABLE VIEW
        // Please note the drawbacks of this though:
        // - 1-n and n-n columns are not searchable
        // - date and datetime columns won't be sortable anymore
        // $this->crud->enableAjaxTable();

        // ------ DATATABLE EXPORT BUTTONS
        // Show export to PDF, CSV, XLS and Print buttons on the table view.
        // Does not work well with AJAX datatables.
        // $this->crud->enableExportButtons();

        // ------ ADVANCED QUERIES
        // $this->crud->addClause('active');
        // $this->crud->addClause('type', 'car');
        // $this->crud->addClause('where', 'name', '==', 'car');
        // $this->crud->addClause('whereName', 'car');
        // $this->crud->addClause('whereHas', 'posts', function($query) {
        //     $query->activePosts();
        // });
        // $this->crud->addClause('withoutGlobalScopes');
        // $this->crud->addClause('withoutGlobalScope', VisibleScope::class);
        // $this->crud->with(); // eager load relationships
        // $this->crud->orderBy();
        // $this->crud->groupBy();
        // $this->crud->limit();
    }

    public function store(StoreRequest $request)
    {

        $redirect_location = parent::storeCrud($request);
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        return $redirect_location;
    }

    public function update(UpdateRequest $request)
    {
        // your additional operations before save here
        $redirect_location = parent::updateCrud($request);
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        return $redirect_location;
    }
}
