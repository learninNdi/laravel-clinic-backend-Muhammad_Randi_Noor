<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Doctor;
use App\Models\DoctorSchedule;

class DoctorScheduleController extends Controller
{
    // index
    public function index(Request $request)
    {
        $doctorSchedules = DoctorSchedule::with('doctor')
            ->when($request->input('doctor_id'), function ($query, $doctor_id) {
                return $query->where('doctor_id', $doctor_id);
            })
            ->orderBy('doctor_id', 'asc')
            ->paginate(10);

        return view('pages.doctor_schedules.index', compact('doctorSchedules'));
    }

    // create
    public function create()
    {
        $doctors = Doctor::all();

        return view('pages.doctor_schedules.create', compact('doctors'));
    }

    // store
    public function store(Request $request)
    {
        $request->validate([
            'doctor_id' => 'required',
            'day' => 'required',
            'time' => 'required',
            'status' => 'required',
            'note' => 'required',
        ]);

        $doctorSchedule = new DoctorSchedule;
        $doctorSchedule->doctor_id = $request->doctor_id;
        $doctorSchedule->day = $request->day;
        $doctorSchedule->time = $request->time;
        $doctorSchedule->status = $request->status;
        $doctorSchedule->note = $request->note;

        $doctorSchedule->save();

        return redirect()->route('pages.doctor_schedules.index')->with('success', 'Doctor schedule created successfully');
    }

    // edit
    public function edit($id)
    {
        $doctorSchedule = DoctorSchedule::find($id);
        $doctors = Doctor::all();

        return view('pages.doctor_schedules.edit', compact('doctorSchedule', 'doctors'));
    }

    // update
    public function update(Request $request, $id)
    {
        $request->validate([
            'doctor_id' => 'required',
            'day' => 'required',
            'time' => 'required',
            'status' => 'required',
            'note' => 'required',
        ]);

        $doctorSchedule = DoctorSchedule::find($id);
        $doctorSchedule->doctor_id = $request->doctor_id;
        $doctorSchedule->day = $request->day;
        $doctorSchedule->time = $request->time;
        $doctorSchedule->status = $request->status;
        $doctorSchedule->note = $request->note;

        $doctorSchedule->save();

        return redirect()->route('pages.doctor_schedules.index')->with('success', 'Doctor schedule updated successfully');
    }

    // destroy
    public function destroy($id)
    {
        DoctorSchedule::find($id)->delete();

        return redirect()->route('pages.doctor_schedules.index')->with('success', 'Doctor schedule deleted successfully');
    }
}
