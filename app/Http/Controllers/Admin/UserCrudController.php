<?php
namespace App\Http\Controllers\Admin;

use Backpack\PermissionManager\app\Http\Controllers\UserCrudController as CoreUserCrudController;

use Backpack\PermissionManager\app\Http\Requests\UserStoreCrudRequest as StoreRequest;
use Backpack\PermissionManager\app\Http\Requests\UserUpdateCrudRequest as UpdateRequest;

class UserCrudController extends CoreUserCrudController
{
	public function setup()
	{
		parent::setup();

		$this->crud->addColumn([
                'name'  => 'parent_id',
                'label' => 'Parent',
                'type'  => 'select',
                'entity'    => 'parent', // the method that defines the relationship in your Model
                'attribute' => "name", // foreign key attribute that is shown to user
                'model'     => "App\User",
            ]);
        $this->crud->addClause('whereIn', 'id', \App\User::getAllChildren(backpack_auth()->id()));

	}

	public function create()
	{
        $possibleParents = \App\User::with('children')
        ->where('parent_id',backpack_auth()->id())->pluck('name', 'id')

        ->prepend(backpack_auth()->user()->name, backpack_auth()->user()->id)->toArray();
		$this->crud->addField([
            // 1-n relationship
            'label'     => "Parent", // Table column heading
            'type'      => "select_from_array",
            'name'      => 'parent_id', // the column that contains the ID of that 
            'options' => $possibleParents
        ]);
        return parent::create();
	}

	public function edit($id)
	{
       $possibleParents = \App\User::with('children')
        ->where('parent_id',backpack_auth()->id())->pluck('name', 'id')

        ->prepend(backpack_auth()->user()->name, backpack_auth()->user()->id)->toArray();
		$this->crud->addField([
            // 1-n relationship
            'label'     => "Parent", // Table column heading
            'type'      => "select_from_array",
            'name'      => 'parent_id', // the column that contains the ID of that 
            'options' => $possibleParents
        ]);
        return parent::edit($id);
        
	}

    /**
     * Store a newly created resource in the database.
     *
     * @param StoreRequest $request - type injection used for validation using Requests
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreRequest $request)
    {
        //$request->merge(['parent_id' => $request->input('parent_id')]);
        
        return parent::store($request);
    }

    /**
     * Update the specified resource in the database.
     *
     * @param UpdateRequest $request - type injection used for validation using Requests
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRequest $request)
    {
    	
        return parent::update($request);
    }

}

