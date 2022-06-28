@extends('layouts.main')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-block">
                    <h4><i class='fa fa-check-square'></i> Add Permission</h4>
                    <br>

                    {{ Form::open(array('url' => route('permissions.store'))) }}

                    <div class="form-group">
                        {{ Form::label('name', 'Name') }}
                        {{ Form::text('name', '', array('class' => 'form-control')) }}
                    </div><br>
                    @if(!$roles->isEmpty()) 
                        <h4>Assign Permission to Roles</h4>

                        @foreach ($roles as $role) 
                            {{ Form::checkbox('roles[]',  $role->id ) }}
                            {{ Form::label($role->name, ucfirst($role->name)) }}<br>

                        @endforeach
                    @endif
                    <br>
                    {{ Form::submit('Add', array('class' => 'btn btn-primary')) }}

                    <a class="btn btn-danger" href="{{ route('permissions.index') }}">Back</a>

                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection()