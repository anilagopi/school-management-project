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

        <form action="{{route('student_marks.store')}}" method="post" enctype="multipart/form-data"
              class="form-validate-summernote">
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-2">
                        <div class="card-body">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label class="form-label">Select Student *</label>
                                    @if($allStudents)
                                        <select name="student_id" id="student_id"
                                                class="selectpicker form-select custom-select {{ $errors->has('gender') ? 'is-invalid' : '' }}">
                                            <option value="" selected="selected">{{__('students.dropdown_select')}}</option>
                                            @foreach($allStudents as $student)
                                                <option value="{{ $student->id }}" {{ old('student_id') == $student->id ? "selected":"" }}>{{ $student->name }}</option>
                                            @endforeach
                                        </select>
                                    @endif
                                    <small class="invalid-feedback text-danger">{{ $errors->first('student_id') }}</small>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label">Select Term *</label>
                                    @if($terms)
                                        <select name="term_id" id="term_id"
                                                class="selectpicker form-select custom-select {{ $errors->has('term_id') ? 'is-invalid' : '' }}">
                                            <option value="" selected="selected">{{__('students.dropdown_select')}}</option>
                                            @foreach($terms as $term)
                                                <option value="{{ $term->id }}" {{ old('term_id') == $term->id ? "selected":"" }}>{{ $term->name }}</option>
                                            @endforeach
                                        </select>
                                    @endif
                                    <small class="invalid-feedback text-danger">{{ $errors->first('term_id') }}</small>
                                </div>
                                @if($subjects)
                                    @foreach($subjects as $subject)
                                        <div class="form-group col-md-6">
                                        <label class="form-label"> {{ $subject->name }}</label>
                                        <input type="number" name="mark[{{ $subject->id }}]"
                                               class="form-control" placeholder="{{ $subject->name }} Mark"
                                               required>
                                        </div>
                                    @endforeach
                                @endif
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
