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
        $this->crud->denyAccess(['list']);
        $this->crud->setTitle('Bulk Update');
        $this->crud->entity_name="Bulk Update";
        $fiels = config('fields.bulkupdate');

        $this->crud->addFields($fiels);
        

        $this->crud->addColumns(config('columns.col_testcase'));

        // add asterisk for fields that are required in TestCaseRequest
        $this->crud->setRequiredFields(StoreRequest::class, 'create');
        $this->crud->setRequiredFields(UpdateRequest::class, 'edit');
        
        //$this->crud->addButtonFromView('line', 'clone', 'clone', 'beginning');
    }

    public function store(StoreRequest $request)
    {
        $this->crud->hasAccessOrFail('create');

        $entries = session()->pull('bulk_update_entries');
        $toBeUpdated = [];
        if(!empty($request->input('jira_id')))
        {
            $toBeUpdated['jira_id'] = $request->input('jira_id');
        }
        if(!empty($request->input('is_regression')))
        {
            $toBeUpdated['is_regression'] = $request->input('is_regression');
        }

        if(!empty($request->input('release_version')))
        {
            $toBeUpdated['release_version'] = $request->input('release_version');
        }


        $filteredIds = $this->crud->model->where('user_id', backpack_auth()->id())->whereIn('id', explode(',', $entries))->pluck('id');
        $this->crud->model->whereIn('id', $filteredIds)->update($toBeUpdated);
        
        return redirect('/admin/testcase')->with('success', 'your message here');;
    }

    public function update(UpdateRequest $request)
    {
        // your additional operations before save here
        $redirect_location = parent::updateCrud($request);
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        return $redirect_location;
    }

   
    /**
     * Show the form for creating inserting a new row.
     *
     * @return Response
     */
    public function create()
    {
        $this->crud->hasAccessOrFail('create');
        $this->crud->setOperation('create');
        session()->put('bulk_update_entries', request()->get('entries'));
        
        // prepare the fields you need to show
        $this->data['crud'] = $this->crud;
        $this->data['saveAction'] = $this->getSaveAction();
        $this->data['fields'] = $this->crud->getCreateFields();
        $this->data['title'] = $this->crud->getTitle() ?? trans('backpack::crud.add').' '.$this->crud->entity_name;

        // load the view from /resources/views/vendor/backpack/crud/ if it exists, otherwise load the one in the package
        return view($this->crud->getCreateView(), $this->data);
    }
}
