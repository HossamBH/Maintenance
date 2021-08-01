<?php

namespace App\Http\Controllers\Admin;

use App\Models\Salary;
use App\Models\Employee;
use App\Models\Report;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Salary\CreateSalaryRequest;
use App\Http\Requests\Admin\Salary\UpdateSalaryRequest;



class SalariesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $salaries = Salary::all();
        return view('Admin.salaries.index', compact('salaries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $employees = Employee::all();
        return view('Admin.salaries.create', compact('employees'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateSalaryRequest $request)
    {
        $employee = Employee::find($request->input('emp_id'));

        $salary = new Salary;
        $salary->month = $request->input('month');
        $salary->emp_id = $request->input('emp_id');
        $salary->salary_date = $request->input('salary_date');
        $salary->total = $employee->salary;

        if ($request->input('bonus')) {
            $salary->bonus = $request->input('bonus');
            $salary->total = $employee->salary + $request->input('bonus');
        }
        if ($request->input('deduction')) {
            $salary->deduction = $request->input('deduction');
            $salary->total = $employee->salary - $request->input('deduction');
        }
        if ($request->input('comments')) {
            $salary->comments = $request->input('comments');
        }
        $salary->user_id = auth()->user()->id;
        $salary->save();

        $report = new Report;
        $report->amount = $salary->total;
        $report->payment_type = 'cash';
        $report->status = 'out';
        $report->type = 'salary';
        $report->entity_id = $salary->id;
        $report->save();

        return redirect(route('admin.salaries.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employees = Employee::all();
        $salary = Salary::findOrFail($id);
        return view('Admin.salaries.edit', compact('employees', 'salary'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSalaryRequest $request, $id)
    {
        $employee = Employee::find($request->input('emp_id'));
        $salary = Salary::findOrFail($id);
        $salary->month = $request->input('month');
        $salary->emp_id = $request->input('emp_id');
        $salary->salary_date = $request->input('salary_date');
        $salary->total = $employee->salary;

        if ($request->input('bonus')) {
            $salary->bonus = $request->input('bonus');
            $salary->total = $employee->salary + $request->input('bonus');
        }
        if ($request->input('deduction')) {
            $salary->deduction = $request->input('deduction');
            $salary->total = $salary->total - $request->input('deduction');
        }
        if ($request->input('comments')) {
            $salary->comments = $request->input('comments');
        }

        $salary->user_id = auth()->user()->id;
        $salary->save();
        $report = Report::where('type', 'salary')->where('entity_id', $salary->id)->first();
        $report->amount = $salary->total;
        $report->payment_type = 'cash';
        $report->status = 'out';
        $report->save();
        return redirect(route('admin.salaries.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $salary = Salary::findOrFail($id);
        $salary->delete();
        return back();
    }
}
