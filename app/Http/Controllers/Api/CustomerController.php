<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(): JsonResponse
    {
        $customers = Customer::latest()->get();

        return response()->json([
            "success" => true,
            "message" => "Customers retrieved successfully",
            "data" => $customers
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            "name" => ["required", "string"],
            "email" => ["required", "email"],
            "phone" => ["nullable", "string"],
            "address" => ["nullable", "string"]
        ]);

        $customer = Customer::create($data);

        return response()->json([
            "success" => true,
            "message" => "Customer created successfully",
            "data" => $customer
        ], 201);
    }

    public function show(int $id): JsonResponse
    {
        $customer = Customer::find($id);

        if (!$customer) {
            return response()->json([
                "success" => false,
                "message" => "Customer not found"
            ], 404);
        }

        return response()->json([
            "success" => true,
            "data" => $customer
        ]);
    }

    public function update(Request $request, int $id): JsonResponse
    {
        $customer = Customer::find($id);

        if (!$customer) {
            return response()->json([
                "success" => false,
                "message" => "Customer not found"
            ], 404);
        }

        $customer->update($request->all());

        return response()->json([
            "success" => true,
            "message" => "Customer updated successfully",
            "data" => $customer
        ]);
    }

    public function destroy(int $id): JsonResponse
    {
        $customer = Customer::find($id);

        if (!$customer) {
            return response()->json([
                "success" => false,
                "message" => "Customer not found"
            ], 404);
        }

        $customer->delete();

        return response()->json([
            "success" => true,
            "message" => "Customer deleted successfully"
        ]);
    }
}