@extends('layouts.main')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-block">
                    <h4><i class='fa fa-gear'></i> Edit Role: {{$role->name}}</h4>
                    <hr>

                    {{ Form::model($role, array('route' => array('roles.update', $role->id), 'method' => 'PUT')) }}

                    <div class="form-group">
                        {{ Form::label('name', 'Role Name') }}
                        {{ Form::text('name', null, array('class' => 'form-control')) }}
                    </div>

                    <h5><b>Assign Permissions</b></h5>
                    @foreach ($permissions as $permission)

                        {{Form::checkbox('permissions[]',  $permission->id, $role->permissions ) }}
                        {{Form::label($permission->name, ucfirst($permission->name)) }}<br>

                    @endforeach
                    <br>
                    {{ Form::submit('Edit', array('class' => 'btn btn-primary')) }}
                    <a class="btn btn-danger" href="{{ route('roles.index') }}">Back</a>

                    {{ Form::close() }} 
                </div>
            </div>
        </div>
    </div>
</div>

@endsection();