<?php

namespace App\Http\Controllers;

use App\Constants\Controller\ConstantsStudentController;
use App\Enums\EnumAlertType;
use App\Enums\EnumValidation;
use App\Http\Helpers\AppHelper;
use App\Services\Validation\ValidationService;
use App\Student;
use App\Teacher;
use Illuminate\Contracts\View\Factory;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class StudentController extends Controller
{
    /**
     * Construct for controller
     */
    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth');
    }

    /**
     * Loads student Index Page
     *
     * @return Factory|View
     */
    public function index()
    {
        try
        {
            $allStudents = Student::with(['teacher'])->get();

            // Get defaults for layout

            $pageData = [
                ConstantsStudentController::TITLE    => __('students.student_list'),
                ConstantsStudentController::STUDENTS => $allStudents
            ];

            // Load the appropriate view with the array of page data.

            return view('student.index', $pageData);
        }
        catch (Exception $e)
        {
            return $this->studentExceptionError();
        }
    }

    /**
     * Show the form for creating the specified resource.
     *
     * @param Request $request
     *
     * @return Factory|RedirectResponse|View
     */
    public function create(Request $request)
    {
        try
        {
            $allTeachers = Teacher::select(Teacher::COL_ID, Teacher::COL_NAME)->get();

            // Return the response.

            $data = [
                ConstantsStudentController::TITLE    => __('students.create_title'),
                ConstantsStudentController::TEACHERS => $allTeachers,
                ConstantsStudentController::GENDERS  => AppHelper::GENDER,
            ];

            return view('student.create', $data);
        }

        catch (Exception $e)
        {
            return $this->studentExceptionError();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     *
     * @return Response|RedirectResponse
     * @throws AuthorizationException
     */
    public function store(Request $request)
    {
        try
        {
            $validator = ValidationService::validate($request, [
                'name'           => [
                    EnumValidation::REQUIRED,
                    Rule::unique('students')->where(function (Builder $query) use ($request)
                    {
                        return $query
                            ->where('name', $request->get('name'))
                            ->where('age', $request->get('age'))
                            ->whereNull('deleted_at');
                    }),
                ],
                'age'        => EnumValidation::INTEGER,
                'teacher_id' => EnumValidation::REQUIRED,
                'gender'     => EnumValidation::REQUIRED
            ]);

            if ($validator !== true)
            {
                return back()->withErrors($validator)->withInput();
            }

            $student = new Student([
                'name'       => $request->get('name'),
                'age'        => $request->get('age'),
                'teacher_id' => $request->get('teacher_id'),
                'gender'     => $request->get('gender'),
            ]);

            if ($student->save())
            {
                return redirect('/')->with($this->setNotificationMessage(
                    __('students.success_create'),
                    EnumAlertType::SUCCESS
                ));
            }
            else
            {
                return $this->studentExceptionError();
            }
        }
        catch (BaseException $e)
        {
            return $this->studentExceptionError();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Student $student
     * @return Response
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Student $student
     * @return Response
     */
    public function edit(Student $student)
    {
        // Get student details

        $student     = Student::findOrFail($student->id);
        $allTeachers = Teacher::select(Teacher::COL_ID, Teacher::COL_NAME)->get();

        try
        {
            $data = [
                ConstantsStudentController::TITLE    => 'Edit student '.$student->name,
                ConstantsStudentController::TEACHERS => $allTeachers,
                ConstantsStudentController::GENDERS  => AppHelper::GENDER,
                ConstantsStudentController::STUDENT  => $student,
            ];

            // Load the appropriate view with the array of page data

            return view('student.edit', $data);
        }
        catch (Exception $e)
        {
            $this->budgetExceptionError($e);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request $request
     * @param  int $id
     * @return Response
     */
    public function update(Request $request, int $id)
    {
        try
        {
            $validator = ValidationService::validate($request, [
                'name'           => [
                    EnumValidation::REQUIRED,
                    Rule::unique('students')->where(function (Builder $query) use ($request, $id)
                    {
                        return $query
                            ->where('name', $request->get('name'))
                            ->where('age', $request->get('age'))
                            ->where('id', '!=', $id)
                            ->whereNull('deleted_at');
                    }),
                ],
                'age'        => EnumValidation::INTEGER,
                'teacher_id' => EnumValidation::REQUIRED,
                'gender'     => EnumValidation::REQUIRED
            ]);

            if ($validator !== true)
            {
                return back()->withErrors($validator)->withInput();
            }

            $student             = Student::find($id);
            $student->name       = $request->get('name');
            $student->age        = $request->get('age');
            $student->teacher_id = $request->get('teacher_id');
            $student->gender     = $request->get('gender');

            if ($student->save())
            {
                return redirect('/')->with($this->setNotificationMessage(
                    __('students.success_create'),
                    EnumAlertType::SUCCESS
                ));
            }
            else
            {
                return $this->studentExceptionError();
            }
        }
        catch (BaseException $e)
        {
            return $this->studentExceptionError();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Student $student
     * @param int $id
     *
     * @return Response
     */
    public function destroy(Student $student, int $id)
    {
        try
        {
            $deleteStudent = Student::where('id', $id)->delete();

            if ($deleteStudent)
            {
                return back()->with(
                    $this->setNotificationMessage(__('students.success_delete'),
                        ConstantsStudentController::ALERT_SUCCESS)
                );
            }
            else
            {
                return $this->studentExceptionError();
            }
        }
        catch (BaseException $e)
        {
            return $this->studentExceptionError();
        }
    }

    /**
     * function for common error throw
     *
     * @return RedirectResponse|Redirector
     */
    public function studentExceptionError()
    {
        return Redirect::back()->withErrors(['msg' => ConstantsStudentController::MSG]);
    }

}
