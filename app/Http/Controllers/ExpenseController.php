<?php

namespace App\Http\Controllers;

use App\Models\AcademicYear;
use App\Models\Expense;
use App\Models\Log;
use App\Models\Term;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ExpenseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function expenseIndex(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $termId = $request->input('term_id');
        $academicYearId = $request->input('academic_year_id');

        $schoolId=Auth()->user()->school_id;
        $role=Auth()->user()->role;

        $academicYears=AcademicYear::where('school_id', $schoolId)->orderBy('name', 'asc')->get();
        $terms=Term::where('school_id', $schoolId)->orderBy('name', 'asc')->get();

        if ($role == "Cashier")
        {
            $userId = Auth()->user()->id;

            $expensesQuery = Expense::where('school_id', $schoolId)->where('user_id', $userId )->orderBy('created_at', 'desc');

            // Apply filters if provided
            if ($startDate && $endDate) {
                $expensesQuery->whereBetween('payment_date', [$startDate, $endDate]);
            }

            if ($termId) {
                $expensesQuery->where('term_id', $termId);
            }

            if ($academicYearId) {
                $expensesQuery->where('academic_year_id', $academicYearId);
            }

            // Now paginate the filtered expenses
            $expenses = $expensesQuery->paginate(50);

        }else{


        $expensesQuery = Expense::where('school_id', $schoolId)->orderBy('created_at', 'desc');

            // Apply filters if provided
            if ($startDate && $endDate) {
                $expensesQuery->whereBetween('payment_date', [$startDate, $endDate]);
            }

            if ($termId) {
                $expensesQuery->where('term_id', $termId);
            }

            if ($academicYearId) {
                $expensesQuery->where('academic_year_id', $academicYearId);
            }

            // Now paginate the filtered expenses
            $expenses = $expensesQuery->paginate(50);
        }

        return view('accounts.expenses.index', compact('expenses', 'startDate', 'endDate', 'termId', 'academicYearId', 'terms', 'academicYears','role'));
    }

    public function expenseStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'amount' => 'required',
            'payment_date' => 'required',
            'term_id' => 'required',
            'academic_year_id' => 'required',
            'category' => 'required|in:1, 2, 3',
            'description' => 'required',
        ], [
            'amount.required' => 'State the expense amount',
            'payment_date.required' => 'State the expense date',
            'term_id.required' => 'Term is required',
            'academic_year_id.required' => 'Year is required',
            'category.required' => 'Select an apporpirate category',
            'description.required' => 'Description is required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
            ->withErrors($validator)
            ->withInput()
            ->with('error', 'Check your inputs.');
        }

        $input = $request->all();

        $expense = Expense::create($input);

            //LOG
            $user = Auth::user()->id;
            $staff_no = User::where('id', $user)->value('staff_number');
            $description = "User ". $staff_no . " created a expense ". $expense->id;
            $action = "Create";

            $log = Log::create([
                'school_id'=> $request->school_id,
                'user_id' => $user,
                'action' => $action,
                'description' => $description,
            ]);


        return redirect()->route('expense.index')->with('success', 'Expense added successfully.');
    }

    public function getExpenseDetails($expenseId)
    {
        $expense = Expense::find($expenseId);
        return response()->json($expense);
    }



    public function expenseUpdate (Request $request)
    {
        $validator = Validator::make($request->all(), [
            'amount' => 'required',
            'payment_date' => 'required',
            'term_id' => 'required',
            'academic_year_id' => 'required',
            'category' => 'required|in:1, 2, 3',
            'description' => 'required',
        ], [
            'amount.required' => 'State the expense amount',
            'payment_date.required' => 'State the expense date',
            'term_id.required' => 'Term is required',
            'academic_year_id.required' => 'Year is required',
            'category.required' => 'Select an apporpirate category',
            'description.required' => 'Description is required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
            ->withErrors($validator)
            ->withInput()
            ->with('error', 'Check your inputs.');
        }

        $id = $request->input('selectedExpenseId');
        $expense = Expense::findOrFail($id);
        $expense->academic_year_id = $request->academic_year_id;
        $expense->payment_date = $request->payment_date;
        $expense->description = $request->description;
        $expense->category = $request->category;
        $expense->amount = $request->amount;
        $expense->save();

            //LOG
            $user = Auth::user()->id;
            $staff_no = User::where('id', $user)->value('staff_number');
            $description = "User ". $staff_no . " updated a expense ". $expense->serial_no;
            $action = "Update";

            $log = Log::create([
                'school_id'=> $request->school_id,
                'user_id' => $user,
                'action' => $action,
                'description' => $description,
            ]);


        return redirect()->route('expense.index')->with('success', 'Expense updated successfully.');

    }

    public function expenseDelete(Request $request)
    {
        $expense_id = $request->input('selectedExpenseId');
        $expense = Expense::find($expense_id);
        $expense->delete();

        $user = Auth::user()->id;
        $staff_no = User::where('id', $user)->value('staff_number');
        $description = "User ". $staff_no . " deleted expense " .$expense->expense_number;
        $action = "Delete";

        $log = Log::create([
            'school_id'=> $request->school_id,
            'user_id' => $user,
            'action' => $action,
            'description' => $description,
        ]);


        return redirect()->route('expense.index')->with('success', 'Expense deleted successfully.');
    }

}
