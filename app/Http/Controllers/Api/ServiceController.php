<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index(): JsonResponse
    {
        $services = Service::latest()->get();

        return response()->json([
            "success" => true,
            "message" => "Services retrieved successfully",
            "data" => $services
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            "name" => ["required", "string"],
            "price" => ["required", "integer"],
            "description" => ["nullable", "string"],
            "status" => ["nullable", "boolean"]
        ]);

        $service = Service::create($data);

        return response()->json([
            "success" => true,
            "message" => "Service created successfully",
            "data" => $service
        ], 201);
    }

    public function show(int $id): JsonResponse
    {
        $service = Service::find($id);

        if (!$service) {
            return response()->json([
                "success" => false,
                "message" => "Service not found"
            ], 404);
        }

        return response()->json([
            "success" => true,
            "data" => $service
        ]);
    }

    public function update(Request $request, int $id): JsonResponse
    {
        $service = Service::find($id);

        if (!$service) {
            return response()->json([
                "success" => false,
                "message" => "Service not found"
            ], 404);
        }

        $service->update($request->all());

        return response()->json([
            "success" => true,
            "message" => "Service updated successfully",
            "data" => $service
        ]);
    }

    public function destroy(int $id): JsonResponse
    {
        $service = Service::find($id);

        if (!$service) {
            return response()->json([
                "success" => false,
                "message" => "Service not found"
            ], 404);
        }

        $service->delete();

        return response()->json([
            "success" => true,
            "message" => "Service deleted successfully"
        ]);
    }
    public function activate(int $id): JsonResponse
    {
        $service = Service::find($id);

        if (!$service) {
            return response()->json([
                "success" => false,
                "message" => "Service not found"
            ], 404);
        }

        $service->update([
            "status" => true
        ]);

        return response()->json([
            "success" => true,
            "message" => "Service activated successfully",
            "data" => $service
        ]);
    }

    public function deactivate(int $id): JsonResponse
    {
        $service = Service::find($id);

        if (!$service) {
            return response()->json([
                "success" => false,
                "message" => "Service not found"
            ], 404);
        }

        $service->update([
            "status" => false
        ]);

        return response()->json([
            "success" => true,
            "message" => "Service deactivated successfully",
            "data" => $service
        ]);
    }
}
