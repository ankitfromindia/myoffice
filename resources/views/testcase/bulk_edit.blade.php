@extends('backpack::layout')

@section('header')
<section class="content-header">
    <h1>
        <span class="text-capitalize">{{ $crud->entity_name_plural }}</span>
        <small>{{ trans('backpack::crud.edit').' '.$crud->entity_name }}.</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ url(config('backpack.base.route_prefix'),'dashboard') }}">{{ trans('backpack::crud.admin') }}</a></li>
        <li><a href="{{ url($crud->route) }}" class="text-capitalize">{{ $crud->entity_name_plural }}</a></li>
        <li class="active">Moderate</li>
    </ol>
</section>
@endsection

@section('content')
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <!-- Default box -->
        @if ($crud->hasAccess('list'))
        <a href="{{ url($crud->route) }}"><i class="fa fa-angle-double-left"></i> {{ trans('backpack::crud.back_to_all') }} <span>{{ $crud->entity_name_plural }}</span></a><br><br>
        @endif

        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Moderate</h3>
            </div>
            <div class="box col-md-12 padding-10 p-t-20">
                <!-- load the view from type and view_namespace attribute if set -->

                <!-- text input -->
                <div class="form-group col-xs-12 required">
                    <label>Jira Id</label>

                    <input type="text" name="jira_id" value="" placeholder="JIRA ID" class="form-control">


                    <p class="help-block">Eg: AUGMENTO-786</p>
                </div>


                <div class="form-group col-xs-12 required">

                    <label>Module Name</label>

                    <select name="module_id" style="width: 100%" class="form-control select2_field select2-hidden-accessible" tabindex="-1" aria-hidden="true">

                        @foreach($modules as $module)
                        <option value="1">{{$module->name}}</option>
                        @endforeach
                    </select><span class="select2 select2-container select2-container--bootstrap" dir="ltr" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-labelledby="select2-module_id-nj-container"><span class="select2-selection__rendered" id="select2-module_id-nj-container" title="Module 1">Module 1</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>


                </div>











                <!-- load the view from type and view_namespace attribute if set -->

                <!-- checkbox field -->

                <div class="form-group col-xs-12">
                    <div class="checkbox">
                        <label>
                            <input type="hidden" name="is_regression" value="0">
                            <input type="checkbox" value="1" name="is_regression"> Is Regression?
                        </label>


                    </div>
                </div>
                <!-- load the view from type and view_namespace attribute if set -->

                <!-- text input -->
                <div class="form-group col-xs-12 required">
                    <label>Release/Fix Version</label>

                    <div class="input-group">          <div class="input-group-addon">v</div>         <input type="text" name="release_version" value="" class="form-control">
                    </div> 

                </div>















                <!-- load the view from type and view_namespace attribute if set -->

                <!-- text input -->
                <div class="form-group col-xs-12 required">
                    <label>Test Objective</label>

                    <input type="text" name="objective" value="" class="form-control">


                </div>















                <!-- load the view from type and view_namespace attribute if set -->

                <!-- textarea -->
                <div class="form-group col-xs-12 required">
                    <label>Test Steps</label>
                    <textarea name="steps" class="form-control"></textarea>


                </div>    <!-- load the view from type and view_namespace attribute if set -->

                <!-- textarea -->
                <div class="form-group col-xs-12 required">
                    <label>Test Data</label>
                    <textarea name="data" class="form-control"></textarea>


                </div>    <!-- load the view from type and view_namespace attribute if set -->

                <!-- textarea -->
                <div class="form-group col-xs-12 required">
                    <label>Expected Result</label>
                    <textarea name="expected_result" class="form-control"></textarea>


                </div>    <!-- load the view from type and view_namespace attribute if set -->

                <!-- textarea -->
                <div class="form-group col-xs-12">
                    <label>Actual Result</label>
                    <textarea name="actual_result" class="form-control"></textarea>


                </div>    <!-- load the view from type and view_namespace attribute if set -->

                <!-- number input -->
                <div class="form-group col-xs-12">
                    <label for="user_id">User</label>

                    <input type="number" name="user_id" id="user_id" value="" class="form-control">



                </div>
                <!-- load the view from type and view_namespace attribute if set -->

                <!-- checkbox field -->

                <div class="form-group col-xs-12">
                    <div class="checkbox">
                        <label>
                            <input type="hidden" name="status" value="0">
                            <input type="checkbox" value="1" name="status"> Status
                        </label>


                    </div>
                </div>
                <!-- load the view from type and view_namespace attribute if set -->

                <!-- textarea -->
                <div class="form-group col-xs-12">
                    <label>Remarks</label>
                    <textarea name="remarks" class="form-control"></textarea>


                </div>    </div>
        </div><!-- /.box -->
        </form>
    </div>
</div>
@endsection