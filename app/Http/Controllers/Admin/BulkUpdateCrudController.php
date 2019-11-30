<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\BulkUpdateRequest as StoreRequest;
use App\Http\Requests\BulkUpdateRequest as UpdateRequest;
use Backpack\CRUD\CrudPanel;

/**
 * Class BulkUpdateCrudControllerCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class BulkUpdateCrudController extends CrudController
{
    public function setup()
    {
        /*
          |--------------------------------------------------------------------------
          | CrudPanel Basic Information
          |--------------------------------------------------------------------------
         */
        
        $this->crud->enableExportButtons();
        $this->crud->setModel('App\Models\TestCase');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/testcase/bulkUpdate');
        $this->crud->setEntityNameStrings('testcase', 'Manage Test Case');
        $this->crud->setCreateView('testcase.create');
        $this->crud->enableBulkActions();
        $this->crud->allowAccess(['list', 'create', 'update', 'delete', 'revisions', 'reorder', 'show', 'details_row', 'clone']);
        
        $fiels = config('fields.bulkupdate');

        $this->crud->addFields($fiels);
        

        $this->crud->addColumns(config('columns.col_testcase'));

        // add asterisk for fields that are required in TestCaseRequest
        $this->crud->setRequiredFields(StoreRequest::class, 'create');
        $this->crud->setRequiredFields(UpdateRequest::class, 'edit');
        $this->crud->addButtonFromView('bottom', 'bulk_clone', 'bulk_clone', 'end');
        $this->crud->addButtonFromView('bottom', 'bulk_delete', 'bulk_delete', 'end');
        //$this->crud->addButtonFromView('line', 'clone', 'clone', 'beginning');
    }

    public function store(StoreRequest $request)
    {
        dd($request->all());
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

    public function bulkClone()
    {
        $this->crud->hasAccessOrFail('create');

        $entries = $this->request->input('entries');
        $clonedEntries = [];

        foreach ($entries as $key => $id) {
            if ($entry = $this->crud->model->find($id)) {
                $clonedEntries[] = $entry->replicate()->push();
            }
        }

        return $clonedEntries;
    }

    public function bulkDelete()
    {
        $this->crud->hasAccessOrFail('create');

        $entries = $this->request->input('entries');
        $this->crud->model->whereIn('id', $entries)->delete();
    }
}
