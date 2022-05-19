@extends('layouts.app')

@section('content')
<div class="container">

    <div><h1>{{$title}}</h1></div>
    <h4 class="d-flex justify-content-between text-right w-100 font-weight-bold py-3 mb-4">
        <a href="{{route('student_marks.create')}}" class="btn btn-primary btn-round d-block">
            <span class="fas fa-plus"></span>&nbsp; {{ __('students.create_mark_title') }}
        </a>
    </h4>

    <div class="card">
        <div class="card-datatable table-responsive">
            <table class="datatables-categories table table-striped table-bordered">
                <thead>
                <tr>
                    <th>{{ __('students.student_tables.id') }}</th>
                    <th>{{ __('students.student_tables.name') }}</th>
                    @foreach($subjects as $subject)
                        <th>{{ $subject->name }}</th>
                    @endforeach
                    <th>Term</th>
                    <th>Total Marks</th>
                    <th>Created On</th>
                    <th width="15%">{{ __('students.actions') }}</th>
                </tr>
                </thead>

                <tbody>
                    @foreach($allStudents as $student)
                        @php $totalMark = 0; @endphp
                        <tr>
                            <td>{{ $student->id }}</td>
                            <td>{{ $student->student->name ?? '' }}</td>
                            @if($student->student_marks->isNotEmpty())
                                @foreach($student->student_marks as $marks)
                                    @php $totalMark += $marks->mark;@endphp
                                    <th>{{ $marks->mark ?? 0 }}</th>
                                @endforeach
                            @else
                                @foreach($subjects as $subject)
                                    <td>0</td>
                                @endforeach
                            @endif
                            <td>{{ $student->term->name ?? '' }}</td>
                            <td>{{ $totalMark }}</td>
                            <td>{{ $student->created_at }}</td>
                            <td nowrap>
                                @component('components.edit', [
                                               'object' => $student,
                                               'href_edit' => "#",
                                       ])
                                @endcomponent
                                @component('components.destroy', [
                                               'object' => $student,
                                               'href_destroy' => "/student_marks/".$student->id."/destroy/",
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
