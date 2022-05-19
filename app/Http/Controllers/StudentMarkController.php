<?php

namespace App\Http\Controllers;

use App\Constants\Controller\ConstantsStudentController;
use App\Enums\EnumAlertType;
use App\Enums\EnumValidation;
use App\Http\Helpers\AppHelper;
use App\Services\Validation\ValidationService;
use App\Student;
use App\StudentMark;
use App\StudentTerm;
use App\Subject;
use App\Teacher;
use App\Term;
use Illuminate\Contracts\View\Factory;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class StudentMarkController extends Controller
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
            $allStudentsMark = StudentTerm::with(['Term', 'student', 'student_marks'])->get();
            $subjects        = Subject::select(Subject::COL_ID, Subject::COL_NAME)->get();

            // Get defaults for layout

            $pageData = [
                ConstantsStudentController::TITLE    => __('students.student_mark_list'),
                ConstantsStudentController::STUDENTS => $allStudentsMark,
                ConstantsStudentController::SUBJECTS => $subjects
            ];

            // Load the appropriate view with the array of page data.

            return view('student_mark.index', $pageData);
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
            $students = Student::select(Student::COL_ID, Student::COL_NAME)->get();
            $terms    = Term::select(Term::COL_ID, Term::COL_NAME)->get();
            $subjects = Subject::select(Subject::COL_ID, Subject::COL_NAME)->get();

            // Return the response.

            $data = [
                ConstantsStudentController::TITLE    => __('students.create_mark_title'),
                ConstantsStudentController::STUDENTS => $students,
                ConstantsStudentController::TERMS    => $terms,
                ConstantsStudentController::SUBJECTS => $subjects
            ];

            return view('student_mark.create', $data);
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
                'student_id'           => [
                    EnumValidation::REQUIRED,
                    Rule::unique('student_terms')->where(function (Builder $query) use ($request)
                    {
                        return $query
                            ->where('student_id', $request->get('student_id'))
                            ->where('term_id', $request->get('term_id'));
                    }),
                ],
                'term_id'    => EnumValidation::REQUIRED,
            ]);

            if ($validator !== true)
            {
                return back()->withErrors($validator)->withInput();
            }

            $studentTerm = new StudentTerm([
                'student_id' => $request->get('student_id'),
                'term_id'    => $request->get('term_id')
            ]);

            if ($studentTerm->save())
            {
                if (!empty($request->get('mark')))
                {
                    $markData = [];

                    foreach ($request->get('mark') as $subjectId => $mark)
                    {
                        $existCount = StudentMark::select(StudentMark::COL_ID)
                            ->where(StudentMark::COL_STUDENT_TERM_ID, $studentTerm->id)
                            ->where(StudentMark::COL_SUBJECT_ID, $subjectId)
                            ->count();

                        if ($existCount > 0)
                        {
                            return Redirect::back()->withErrors(['msg' => 'Mark Already Entered']);
                        }
                        else
                        {
                            $markData[] = [
                                StudentMark::COL_STUDENT_TERM_ID => $studentTerm->id,
                                StudentMark::COL_SUBJECT_ID      => $subjectId,
                                StudentMark::COL_MARK            => $mark ?? 0
                            ];
                        }
                    }

                    if (StudentMark::insert($markData))
                    {
                        return redirect('/student_marks')->with($this->setNotificationMessage(
                            __('students.success_create'),
                            EnumAlertType::SUCCESS
                        ));
                    }
                    else
                    {
                        return $this->studentExceptionError();
                    }
                }

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
        echo $student->id;die;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request $request
     * @param  Student $student
     * @return Response
     */
    public function update(Request $request, Student $student)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param StudentTerm $studentTerm
     * @param int $id
     *
     * @return Response
     */
    public function destroy(StudentTerm $studentTerm, int $id)
    {
        try
        {
            $deleteMark = StudentTerm::where('id', $id)->delete();

            if ($deleteMark)
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
