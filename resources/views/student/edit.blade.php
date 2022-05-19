@extends('layouts.app')

@section('content')
    @if($errors->any())
        <h4 class="alert-danger text-center">{{$errors->first()}}</h4>
    @endif
<div class="container">
    <div class="card">
        <h4 class="d-flex justify-content-between align-items-center w-100 font-weight-bold mb-4">
            <div>{{ $title }}</div>
        </h4>

        <form action="{{ route('students.update', $student->id) }}" method="post" enctype="multipart/form-data"
              class="form-validate-summernote">
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-2">
                        <div class="card-body">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label class="form-label">Name *</label>
                                    <input type="text" name="name"
                                           class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                           value="{{ $student->name }}" placeholder="Name"
                                           required>
                                    <small class="invalid-feedback text-danger">{{ $errors->first('name') }}</small>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label">Age *</label>
                                    <input type="text" name="age"
                                           class="form-control {{ $errors->has('age') ? 'is-invalid' : '' }}"
                                           value="{{ $student->age }}"
                                           placeholder="Age"
                                           required>
                                    <small class="invalid-feedback text-danger">{{ $errors->first('age') }}</small>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label">Gender *</label>
                                    @if($genders)
                                        <select name="gender" id="gender"
                                                class="selectpicker custom-select {{ $errors->has('gender') ? 'is-invalid' : '' }}">
                                            <option value="" selected="selected"
                                                    disabled>{{__('students.dropdown_select')}}</option>
                                            @foreach($genders as $id => $value)
                                                <option value="{{$id}}" {{ $student->gender == strtolower($value) ? "selected":"" }}>{{$value}}</option>
                                            @endforeach
                                        </select>

                                    @endif
                                    <small class="invalid-feedback text-danger">{{ $errors->first('gender') }}</small>
                                </div>

                                <div class="form-group col-md-6">
                                    <label class="form-label">Reporting Teacher</label>
                                    @if($teachers)
                                        <select name="teacher_id" id="teacher_id"
                                                class="selectpicker custom-select {{ $errors->has('teacher_id') ? 'is-invalid' : '' }}">
                                            <option value="" selected="selected"
                                                    disabled>{{__('students.dropdown_select')}}</option>
                                            @foreach($teachers as $teacher)
                                                <option value="{{$teacher->id}}" {{ $student->teacher_id == $teacher->id ? "selected":"" }}>{{$teacher->name}}</option>
                                            @endforeach
                                        </select>
                                    @endif
                                    <small class="invalid-feedback text-danger">{{ $errors->first('teacher_id') }}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Generic Create Footer -->
            @component('components.generic_create_footer', [
            ])
            @endcomponent

        </form>
    </div>
</div>
@endsection
