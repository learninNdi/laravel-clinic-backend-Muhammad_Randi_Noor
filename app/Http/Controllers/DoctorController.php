<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctor;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class DoctorController extends Controller
{
    // index
    public function index(Request $request)
    {
        $doctors = DB::table('doctors')
        ->when($request->input('name'), function ($query, $doctor_name) {
            return $query->where('doctor_name', 'like', '%' . $doctor_name . '%');
        })
        ->orderBy('id', 'desc')
        ->paginate(10);

        return view('pages.doctors.index', compact('doctors'));
    }

    // create
    public function create()
    {
        return view('pages.doctors.create');
    }

    // store
    public function store(Request $request)
    {

        $request->validate([
            'doctor_name' => 'required',
            'doctor_specialist' => 'required',
            'doctor_phone' => 'required',
            'doctor_email' => 'required|email',
            'sip' => 'required',
            'photo' => 'nullable|image|mimes:jpeg,jpg,png,',
            'address' => 'nullable',
        ]);

        $doctor = new Doctor();
        $doctor->doctor_name = $request->doctor_name;
        $doctor->doctor_specialist = $request->doctor_specialist;
        $doctor->doctor_phone = $request->doctor_phone;
        $doctor->doctor_email = $request->doctor_email;
        $doctor->sip = $request->sip;

        if (is_file($request->photo))
        {

            // upload file
            // $request->photo->storeAs('assets/upload/photo', time() . "." . $request->photo->extension());
            $doctor->photo = time() . "." . $request->photo->extension();
            // Storage::put(time() . "." . $request->photo->extension(), 'Contents');
            Storage::disk('public')->put(time() . "." . $request->photo->extension(), 'Contents');
        }

        if ($request->address)
        {
            $doctor->address = $request->address;
        }

        $doctor->save();

        return redirect()->route('doctors.index')->with('success', 'Doctor created successfully');
    }

    // show
    public function show($id)
    {
        $doctor = Doctor::find($id);

        return view('pages.doctors.show', compact('doctor'));
    }

    // edit
    public function edit($id)
    {
        $doctor = Doctor::find($id);

        return view('pages.doctors.edit', compact('doctor'));
    }

    // update
    public function update(Request $request, $id)
    {

        $request->validate([
            'doctor_name' => 'required',
            'doctor_specialist' => 'required',
            'doctor_phone' => 'required',
            'doctor_email' => 'required|email',
            'sip' => 'required',
            'photo' => 'nullable|image|mimes:jpeg,jpg,png,',
            'address' => 'nullable',
        ]);

        $doctor = Doctor::find($id);
        $doctor->doctor_name = $request->doctor_name;
        $doctor->doctor_specialist = $request->doctor_specialist;
        $doctor->doctor_phone = $request->doctor_phone;
        $doctor->doctor_email = $request->doctor_email;
        $doctor->sip = $request->sip;

        if (is_file($request->photo))
        {

            // upload file
            $request->photo->storeAs('assets/upload/photo', time() . "." . $request->photo->extension());
            $doctor->photo = time() . "." . $request->photo->extension();
        }

        if ($doctor->address)
        {
            $doctor->address = $request->address;
        }

        $doctor->save();

        return redirect()->route('doctors.index')->with('success', 'Doctor updated successfully');
    }

    // destroy
    public function destroy($id)
    {
        $doctor = Doctor::find($id);
        $imageName = $doctor->photo;
        $doctor->delete();

        if (File::exists(asset('storage/app/public/'.$imageName))) {
            File::delete(asset('storage/app/public/'.$imageName));
        }

        return redirect()->route('doctors.index')->with('success', 'Doctor deleted successfully');
    }
}

// storage\app\1709899414.png
