@extends('layouts.main')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-block">
                    <h4><i class='fa fa-user-plus'></i> Edit {{$user->name}}</h4>
                    <hr>

                    {{ Form::model($user, array('route' => array('users.update', $user->id), 'method' => 'PUT')) }}{{-- Form model binding to automatically populate our fields with user data --}}

                    <div class="form-group">
                        {{ Form::label('name', 'Nama Lengkap') }}
                        {{ Form::text('name', null, array('class' => 'form-control')) }}
                    </div>

                    <div class="form-group">
                        {{ Form::label('email', 'Email') }}
                        {{ Form::email('email', null, array('class' => 'form-control')) }}
                    </div>

                    <div class="form-group">
                        {{ Form::label('mobile_number', 'Nomor HP') }}
                        {{ Form::text('mobile_number', null, array('class' => 'form-control')) }}
                    </div>

                    <h5><b>Role</b></h5>

                    <div class='form-group'>
                        <select name="roles" class="form-control">
                                @foreach ($roles as $role)
                                    <option value="{{ $role?->id }}" {{ $user->roles?->first()?->id == $role?->id ? 'selected' : '' }}>{{ ucfirst($role->name) }}</option>
                            @endforeach
                        </select>
                    </div>
                
                    <div class="password_container"></div>

                    <div class="form-group">
                         <label><input type="checkbox" name="with_password" class="change_password"> Ubah User Password </label>
                    </div>

                    {{ Form::submit('Ubah', array('class' => 'btn btn-primary')) }}

                    <a class="btn btn-danger" href="{{ route('users.employee') }}">Back</a>

                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection()

@section('scripts')
    <script>
        $('select[name="package"]').change(function(){

            var checkboxes = $(this).closest('form');
            var subscriber = checkboxes.find(':checkbox:eq(2)');
            var unsubscriber = checkboxes.find(':checkbox:eq(3)');

            if ($(this).val() == 4) {
                subscriber.prop('checked', false);
                unsubscriber.prop('checked', true);
            } else {
                subscriber.prop('checked', true);
                unsubscriber.prop('checked', false);
            }
        });

        $('.change_password').change(function(){
            if ($(this).is(':checked')) {

                $('.password_container').html(`
                    <div class="form-group">
                        {{ Form::label('password', 'Password') }}<br>
                        {{ Form::password('password', array('class' => 'form-control')) }}

                    </div>

                    <div class="form-group">
                        {{ Form::label('password', 'Confirm Password') }}<br>
                        {{ Form::password('password_confirmation', array('class' => 'form-control')) }}

                    </div>
                `);

            }else{

                $('.password_container').empty();
            }
        });
    </script>
@endsection()