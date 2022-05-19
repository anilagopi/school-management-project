@extends('layouts.app')

@section('content')
<div class="container">

    <div><h1>{{$title}}</h1></div>
    <h4 class="d-flex justify-content-between text-right w-100 font-weight-bold py-3 mb-4">
        <a href="{{route('students.create')}}" class="btn btn-primary btn-round d-block">
            <span class="fas fa-plus"></span>&nbsp; {{ __('students.create_title') }}
        </a>
    </h4>

    <div class="card">
        <div class="card-datatable table-responsive">
            <table class="datatables-categories table table-striped table-bordered">
                <thead>
                <tr>
                    <th>{{ __('students.student_tables.id') }}</th>
                    <th>{{ __('students.student_tables.name') }}</th>
                    <th>{{ __('students.student_tables.age') }}</th>
                    <th>{{ __('students.student_tables.gender') }}</th>
                    <th>{{ __('students.student_tables.teacher') }}</th>
                    <th width="15%">{{ __('students.actions') }}</th>
                </tr>
                </thead>

                <tbody>
                    @foreach($allStudents as $student)
                        <tr>
                            <td>{{$student->id}}</td>
                            <td>{{$student->name}}</td>
                            <td>{{$student->age}}</td>
                            <td>{{$student->gender}}</td>
                            <td>{{$student->teacher->name}}</td>
                            <td nowrap>
                                @component('components.edit', [
                                               'object' => $student,
                                               'href_edit' => "/students/".$student->id."/edit/",
                                       ])
                                @endcomponent
                                @component('components.destroy', [
                                               'object' => $student,
                                               'href_destroy' => "/students/".$student->id."/destroy/",
                                       ])
                                @endcomponent
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
