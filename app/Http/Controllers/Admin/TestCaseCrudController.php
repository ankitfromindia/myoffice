<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;
// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\TestCaseRequest as StoreRequest;
use App\Http\Requests\TestCaseRequest as UpdateRequest;
use Backpack\CRUD\CrudPanel;
use App\Http\Controllers\Admin\Filters\TestCaseFilter;
use App\Services\ImportAwareTrait;
use App\Models\Module;

/**
 * Class TestCaseCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class TestCaseCrudController extends CrudController
{
    use TestCaseFilter;
    use ImportAwareTrait;
    
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
        //$this->crud->setCreateView('testcase.create');
        $this->crud->enableBulkActions();
        $this->addFilters();
        $this->crud->allowAccess(['list', 'create', 'update', 'delete', 'revisions', 'reorder', 'show', 'details_row', 'clone']);
         $this->crud->allowAccess('show');
        
        $fiels = config('fields.testcase');

        $this->crud->addFields($fiels);


        $this->crud->addColumns(config('columns.col_testcase'));
        $this->crud->setFromDb();
        $this->crud->removeColumn('user_id');
        $this->crud->removeField('user_id');

        // add asterisk for fields that are required in TestCaseRequest
        $this->crud->setRequiredFields(StoreRequest::class, 'create');
        $this->crud->setRequiredFields(UpdateRequest::class, 'edit');
        $this->crud->addButtonFromView('bottom', 'bulk_clone', 'bulk_clone', 'end');
        $this->crud->addButtonFromView('bottom', 'bulk_delete', 'bulk_delete', 'end');
        $this->crud->addButtonFromView('bottom', 'bulk_update', 'bulk_update', 'end');
        $this->crud->addButtonFromView('bottom', 'import', 'import', 'end');
        $this->crud->addButtonFromView('top', 'bulk_clone', 'bulk_clone', 'end');
        $this->crud->addButtonFromView('top', 'bulk_delete', 'bulk_delete', 'end');
        $this->crud->addButtonFromView('top', 'bulk_update', 'bulk_update', 'end');
        $this->crud->addButtonFromView('top', 'import', 'import', 'end');
    }


    public function store(StoreRequest $request)
    {
        //dd($request->all());
        // your additional operations before save here
        $request->merge([
            'jira_id' => $request->input('jira_id'),
            'release_version' => config('setting.release_version_prefix') . $request->input('release_version'),
            'user_id' => backpack_auth()->id()
        ]);
        $redirect_location = parent::storeCrud($request);
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        return $redirect_location->withInput($request->all());
    }

    public function update(UpdateRequest $request)
    {
        // your additional operations before save here
        $redirect_location = parent::updateCrud($request);
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        return $redirect_location;
    }
    
    public function importSampleFilename(): string
    {
        return 'test_case_sample.csv';
    }
    
    public function importInstructions(): array
    {
        return ['instruction'];
    }
    
    public function importValidationRules(): array
    {
        return config('setting.validation.testcase_importable');
    }
    
    public function importValidationMessages(): array
    {
        return [
            'data' => 'Test Data',
        ];
    }
    
    public function importCreate($entity)
    {

        if(is_string($entity['module_id']))
        {
            if(Module::where('name', $entity['module_id'])->exists())
            {
                $module = Module::where('name', $entity['module_id'])->first();
            }
            else
            {
                $module = Module::create([
                   'user_id' => backpack_auth()->id(),
                   'name' => $entity['module_id'] 
                ]);
            }
            $moduleId = $module->id;
        }
        elseif(is_int($entity['module_id']))
        {
            if(Module::where('id', $entity['module_id'])->exists())
            {
                $moduleId = $module->id;
            }
        }
        $entity['module_id'] = $moduleId;
        $entity['is_regression'] = $entity['is_regression'] ?? false;
        $entity['user_id']= backpack_auth()->id();
        $entity['status']=0;
        if(is_int($entity['module_id']))
        {
            return \App\Models\TestCase::updateOrCreate($entity, $entity);
        }
    }
    
    public function bulkEdit() 
    {
        $this->crud->hasAccessOrFail('update');

        // get the info for that entry
        //$this->data['entry'] = $this->crud->getEntry('bulk_edit');
        $this->data['crud'] = $this->crud;
        $this->data['title'] = 'Bulk Update '.$this->crud->entity_name;
        $this->data['modules'] = Module::where('user_id', backpack_auth()->id())->pluck('id', 'name');

        return view('testcase.bulk_edit', $this->data);
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
    
    public function show($id)
    {
        $content = parent::show($id);

        $this->crud->removeColumn('user_id');

        return $content;
    }
}
