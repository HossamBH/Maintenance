<?php

namespace App\Http\Controllers\Admin;

use App\Models\Report;
use App\Models\Expense;
use App\Models\ExpenseType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Expense\CreateRequest;
use App\Http\Requests\Admin\Expense\UpdateRequest;



class ExpensesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $expenses=Expense::all();
        return view('Admin.expenses.index',compact('expenses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = ExpenseType::all();

        return view('Admin.expenses.create',compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRequest $request)
    {
        $expense = new Expense;
        $expense->trans_id=rand('100000','999999');
        $expense->total_amount=$request->input('total_amount');
        $expense->user_id=auth()->user()->id;

        $expense->payment_type=$request->input('payment_type');
        $expense->type_id=$request->input('type_id');
        $expense->comments=$request->input('comments');
        if ($request->file('file_attachment')) {
            $expense->file_attachment = $this->upload($request);
        }
        $expense->save();
        $report=new Report;
        $report->entity_id=$expense->id;
        $report->type='expense';
        $report->status='out';
        $report->payment_type=$expense->payment_type;
        $report->amount=$expense->total_amount;
        $report->save();  
        return redirect(route('admin.expenses.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $expense=Expense::FindOrFail($id);
        $types = ExpenseType::all();
        return view('Admin.expenses.show',compact('expense','types'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $expense=Expense::FindOrFail($id);
        $types = ExpenseType::all();
        return view('Admin.expenses.edit',compact('expense','types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id)
    {
        $expense = Expense::findOrFail($id);
        $expense->total_amount=$request->input('total_amount');
        $expense->user_id=auth()->user()->id;

        $expense->payment_type=$request->input('payment_type');
        $expense->type_id=$request->input('type_id');
        $expense->comments=$request->input('comments');
        if ($request->file('file_attachment')) {
            $expense->file_attachment = $this->upload($request);
        }
        $expense->save();
        $report=Report::where('entity_id',$expense->id)->first();
        $report->entity_id=$expense->id;
        $report->type='expense';
        $report->status='out';
        $report->payment_type=$expense->payment_type;
        $report->amount=$expense->total_amount;
        $report->save(); 
        return redirect(route('admin.expenses.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $expenses=Expense::FindOrFail($id);
        $expenses->delete();
        return back();
    }

    public function upload(Request $request)
    {


        $file = $request->file('file_attachment');
        $extension = $file->getClientOriginalExtension();
        $filename = time() . '.' . $extension;
        $file->move('public/uploads/expenses', $filename);
        return $filename;
    }
}
