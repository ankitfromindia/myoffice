<?php

namespace App\Http\Controllers\Admin\Filters;

use App\Models\ {
    Module,
    TestCase
};

/**
 *
 * @author ankit
 */
trait TestCaseFilter
{

    public function addFilters()
    {
        $this->addFilterJira();
        $this->addFilterModule();
        $this->addFilterReleaseVersion();
        
    }
    
    public function addFilterModule()
    {
        $this->crud->addFilter([// select2 filter
            'name'  => 'module_id',
            'type'  => 'select2',
            'label' => 'Module'
                ], function(){
            return Module::all()->pluck('name', 'id')->toArray();
        }, function($value){ // if the filter is active
            $this->crud->addClause('where', 'module_id', $value);
        });
    }

    public function addFilterJira()
    {
        $this->crud->addFilter([// select2 filter
            'name'  => 'jira_id',
            'type'  => 'select2',
            'label' => 'Jira ID',
                ], function(){
            return TestCase::select('jira_id')->groupBy('jira_id')->pluck('jira_id', 'jira_id')->toArray();
        }, function($value){ // if the filter is active
            $this->crud->addClause('where', 'jira_id', $value);
        });
    }
    
    public function addFilterReleaseVersion()
    {
        $this->crud->addFilter([// select2 filter
            'name'  => 'release_version',
            'type'  => 'select2',
            'label' => 'Release Version'
                ], function(){
            return TestCase::groupBy('release_Version')->pluck('release_version', 'release_version')->toArray();
        }, function($value){ // if the filter is active
            $this->crud->addClause('where', 'release_version', $value);
        });
    }

}
