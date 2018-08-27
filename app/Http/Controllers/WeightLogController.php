<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\WeightLog;
use Auth;
use App\Http\Requests\StoreWeightLog;
use App\Http\Requests\UpdateWeightLog;

class WeightLogController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $viewData = [
            'weight_logs' => WeightLog::getUserWeightLogs($user),
            'weight_logs_average' => WeightLog::getAverageUserWeightLogs($user)
        ];

        return view('weight-log.index', $viewData);
    }

    public function show(WeightLog $weightLog)
    {
        return view('weight-log.show', compact('weightLog'));
    }

    public function create()
    {
        return view('weight-log.create');
    }

    public function store(StoreWeightLog $request)
    {
        $validated = $request->validated();

        $user = Auth::user();

        $weightLog = new WeightLog;
        $weightLog->user_id = $user->id;
        $weightLog->log_date = $validated['log_date'];
        $weightLog->min = $validated['min'];
        $weightLog->max = $validated['max'];
        $weightLog->variance = $validated['max'] - $validated['min'];
        $weightLog->save();

        return redirect()->route('weight-log.index')->with('message', 'Data added successfully');
    }

    public function edit(WeightLog $weightLog)
    {
        return view('weight-log.edit', compact('weightLog'));
    }

    public function update(UpdateWeightLog $request, WeightLog $weightLog)
    {
        $validated = $request->validated();

        $weightLog->min = $request['min'];
        $weightLog->max = $request['max'];
        $weightLog->variance = $request['max'] - $request['min'];
        $weightLog->save();

        return redirect()->route('weight-log.index')->with('message', 'Data updated successfully');
    }

    public function destroy(WeightLog $weightLog)
    {
        $weightLog->delete();

        return redirect()->route('weight-log.index')->with('message', 'Data deleted successfully');
    }
}
