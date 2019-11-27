<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;
// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\TestCaseRequest as StoreRequest;
use App\Http\Requests\TestCaseRequest as UpdateRequest;
use Backpack\CRUD\CrudPanel;
use App\Http\Controllers\Admin\Filters\TestCaseFilter;

/**
 * Class TestCaseCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class TestCaseCrudController extends CrudController
{
    use TestCaseFilter;
    
    public function setup()
    {
        /*
          |--------------------------------------------------------------------------
          | CrudPanel Basic Information
          |--------------------------------------------------------------------------
         */
        
        $this->crud->enableExportButtons();
        $this->crud->setModel('App\Models\TestCase');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/testcase');
        $this->crud->setEntityNameStrings('testcase', 'Manage Test Case');
        $this->crud->setCreateView('testcase.create');
        $this->addFilters();
        
        $fiels = config('fields.testcase');

        $this->crud->addFields($fiels);

        $this->crud->addColumn([
            // 1-n relationship
            'label'     => "Module", // Table column heading
            'type'      => "select",
            'name'      => 'module_id', // the column that contains the ID of that connected entity;
            'entity'    => 'module', // the method that defines the relationship in your Model
            'attribute' => "name", // foreign key attribute that is shown to user
            'model'     => "App\Models\Module", // foreign key model
        ]);
        //$this->jira_id='AUGMENTO-';
        /*
          |--------------------------------------------------------------------------
          | CrudPanel Configuration
          |--------------------------------------------------------------------------
         */

        // TODO: remove setFromDb() and manually define Fields and Columns
        $this->crud->setFromDb();

        // add asterisk for fields that are required in TestCaseRequest
        $this->crud->setRequiredFields(StoreRequest::class, 'create');
        $this->crud->setRequiredFields(UpdateRequest::class, 'edit');
    }

    public function store(StoreRequest $request)
    {
        //dd($request->all());
        // your additional operations before save here
        $request->merge([
            'jira_id' => config('setting.jira_id_prefix') . $request->input('jira_id'),
            'release_version' => config('setting.release_version_prefix') . $request->input('release_version')
        ]);
        $redirect_location = parent::storeCrud($request);
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        return $redirect_location->withInput([
                    'jira_id'         => $request->input('jira_id'),
                    'module_id'       => $request->input('module_id'),
                    'release_version' => $request->input('release_version')
        ]);
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
