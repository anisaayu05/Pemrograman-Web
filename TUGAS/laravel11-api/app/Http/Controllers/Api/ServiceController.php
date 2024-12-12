<?php

namespace App\Http\Controllers\Api;

use App\Models\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ServiceResource;
use Illuminate\Support\Facades\Validator;

class ServiceController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        // Get all services
        $services = Service::latest()->paginate(5);

        // Return collection of services as a resource
        return new ServiceResource(true, 'List Data Services', $services);
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
            'description' => 'required|string',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Create service
        $service = Service::create($request->all());

        // Return response
        return new ServiceResource(true, 'Data Service Berhasil Ditambahkan!', $service);
    }

    /**
     * show
     *
     * @param  mixed $id
     * @return void
     */
    public function show($id)
    {
        // Find service by ID
        $service = Service::find($id);

        // Return single service as a resource
        return new ServiceResource(true, 'Detail Data Service!', $service);
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
            'description' => 'required|string',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Find service by ID
        $service = Service::find($id);

        // Check if service exists
        if (!$service) {
            return response()->json([
                'success' => false,
                'message' => 'Service tidak ditemukan.',
            ], 404);
        }

        // Update service data
        $service->update($request->all());

        // Return response
        return new ServiceResource(true, 'Data Service Berhasil Diubah!', $service);
    }

    /**
     * destroy
     *
     * @param  mixed $id
     * @return void
     */
    public function destroy($id)
    {
        // Find service by ID
        $service = Service::find($id);

        // Check if service exists
        if (!$service) {
            return response()->json([
                'success' => false,
                'message' => 'Service tidak ditemukan.',
            ], 404);
        }

        // Delete service
        $service->delete();

        // Return response
        return new ServiceResource(true, 'Data Service Berhasil Dihapus!', null);
    }
}
