<?php

namespace App\Http\Controllers\Api;

use App\Models\Doctor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\DoctorResource;
use Illuminate\Support\Facades\Validator;

class DoctorController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        // Get all doctors
        $doctors = Doctor::latest()->paginate(5);

        // Return collection of doctors as a resource
        return new DoctorResource(true, 'List Data Doctors', $doctors);
    }

    /**
     * store
     *
     * @param  mixed $request
     * @return void
     */
    public function store(Request $request)
    {
        // Define validation rules
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'specialization' => 'required|string',
            'clinic_name' => 'required|string',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Create doctor
        $doctor = Doctor::create($request->all());

        // Return response
        return new DoctorResource(true, 'Data Doctor Berhasil Ditambahkan!', $doctor);
    }

    /**
     * show
     *
     * @param  mixed $id
     * @return void
     */
    public function show($id)
    {
        // Find doctor by ID
        $doctor = Doctor::find($id);

        // Return single doctor as a resource
        return new DoctorResource(true, 'Detail Data Doctor!', $doctor);
    }

    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $id
     * @return void
     */
    public function update(Request $request, $id)
    {
        // Define validation rules
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'specialization' => 'required|string',
            'clinic_name' => 'required|string',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Find doctor by ID
        $doctor = Doctor::find($id);

        // Check if doctor exists
        if (!$doctor) {
            return response()->json([
                'success' => false,
                'message' => 'Doctor tidak ditemukan.',
            ], 404);
        }

        // Update doctor data
        $doctor->update($request->all());

        // Return response
        return new DoctorResource(true, 'Data Doctor Berhasil Diubah!', $doctor);
    }

    /**
     * destroy
     *
     * @param  mixed $id
     * @return void
     */
    public function destroy($id)
    {
        // Find doctor by ID
        $doctor = Doctor::find($id);

        // Check if doctor exists
        if (!$doctor) {
            return response()->json([
                'success' => false,
                'message' => 'Doctor tidak ditemukan.',
            ], 404);
        }

        // Delete doctor
        $doctor->delete();

        // Return response
        return new DoctorResource(true, 'Data Doctor Berhasil Dihapus!', null);
    }
}
