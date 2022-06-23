@extends('layouts.main')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-block">
                    <h4><i class='fa fa-gear'></i> Add Role</h4>
                    <hr>

                    {{ Form::open(array('url' => route('roles.store'))) }}

                    <div class="form-group">
                        {{ Form::label('name', 'Name') }}
                        {{ Form::text('name', null, array('class' => 'form-control')) }}
                    </div>

                    <h5><b>Assign Permissions</b></h5>

                    <div class='form-group'>
                        @foreach ($permissions as $permission)
                            {{ Form::checkbox('permissions[]',  $permission->id ) }}
                            {{ Form::label($permission->name, ucfirst($permission->name)) }}<br>
                        @endforeach
                    </div>

                    {{ Form::submit('Add', array('class' => 'btn btn-primary')) }}
                    <a class="btn btn-danger" href="{{ route('roles.index') }}">Back</a>

                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection();