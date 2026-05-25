<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CustomerController extends Controller
{
    private string $apiUrl;

    public function __construct()
    {
        $this->apiUrl = rtrim(env('API_BASE_URL', 'http://erp-app.test:8080'), '/') . '/api/customers';
    }

    public function index()
    {
        $response = Http::get($this->apiUrl);

        $customers = $response->successful()
            ? $response->json('data')
            : [];

        return view('customers.index', compact('customers'));
    }

    public function store(Request $request)
    {
        Http::post($this->apiUrl, [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        return redirect()->route('customers.index');
    }

    public function update(Request $request, int $id)
    {
        Http::patch("{$this->apiUrl}/{$id}", [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        return redirect()->route('customers.index');
    }

    public function destroy(int $id)
    {
        Http::delete("{$this->apiUrl}/{$id}");

        return redirect()->route('customers.index');
    }
}
