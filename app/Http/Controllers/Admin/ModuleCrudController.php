<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\ModuleRequest as StoreRequest;
use App\Http\Requests\ModuleRequest as UpdateRequest;
use Backpack\CRUD\CrudPanel;

/**
 * Class ModuleCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class ModuleCrudController extends CrudController
{
    public function setup()
    {
        /*
        |--------------------------------------------------------------------------
        | CrudPanel Basic Information
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\Module');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/module');
        $this->crud->setEntityNameStrings('module', 'modules');
        $this->crud->allowAccess(['list', 'create', 'update', 'delete', 'revisions', 'reorder', 'show', 'details_row', 'bulk_edit']);

        /*
        |--------------------------------------------------------------------------
        | CrudPanel Configuration
        |--------------------------------------------------------------------------
        */

        // TODO: remove setFromDb() and manually define Fields and Columns
        $this->crud->setFromDb();

        // add asterisk for fields that are required in ModuleRequest
        $this->crud->setRequiredFields(StoreRequest::class, 'create');
        $this->crud->setRequiredFields(UpdateRequest::class, 'edit');
    }

    public function store(StoreRequest $request)
    {
        // your additional operations before save here
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
    
    public function getMyModules()
    {
        $search_term = request()->input('q');
        $page = request()->input('page');

        if ($search_term)
        {
            $results = \App\Models\Module::where('name', 'LIKE', '%'.$search_term.'%')->paginate(10);
        }
        else
        {
            $results = \App\Models\Module::paginate(10);
        }

        return $results;
    }
}
