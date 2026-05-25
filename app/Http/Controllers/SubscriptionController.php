<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SubscriptionController extends Controller
{
    private string $apiUrl;
    private string $customersApiUrl;
    private string $servicesApiUrl;

    public function __construct()
    {
        $base = rtrim(
            env(
                'API_BASE_URL',
                'http://erp-app.test:8080'
            ),
            '/'
        );

        $this->apiUrl =
            $base . '/api/subscriptions';

        $this->customersApiUrl =
            $base . '/api/customers';

        $this->servicesApiUrl =
            $base . '/api/services';
    }

    public function index(): View
    {
        try {

            $response = Http::timeout(5)
                ->get($this->apiUrl);

            $subscriptions =
                $response->successful()
                ? $response->json('data')
                : [];

        } catch (\Throwable $e) {

            Log::error(
                'Failed fetching subscriptions',
                [
                    'err' => $e->getMessage()
                ]
            );

            $subscriptions = [];
        }

        try {

            $customersResponse = Http::timeout(5)
                ->get($this->customersApiUrl);

            $customers =
                $customersResponse->successful()
                ? $customersResponse->json('data')
                : [];

        } catch (\Throwable $e) {

            Log::error(
                'Failed fetching customers',
                [
                    'err' => $e->getMessage()
                ]
            );

            $customers = [];
        }

        try {

            $servicesResponse = Http::timeout(5)
                ->get($this->servicesApiUrl);

            $services =
                $servicesResponse->successful()
                ? $servicesResponse->json('data')
                : [];

        } catch (\Throwable $e) {

            Log::error(
                'Failed fetching services',
                [
                    'err' => $e->getMessage()
                ]
            );

            $services = [];
        }

        return view(
            'subscriptions.index',
            [
                'active' => 'subscriptions',
                'subscriptions' => $subscriptions,
                'customers' => $customers,
                'services' => $services,
            ]
        );
    }

    public function store(
        Request $request
    ): RedirectResponse {

        $response = Http::post(
            $this->apiUrl,
            [
                'customer_id' =>
                    $request->customer_id,

                'service_id' =>
                    $request->service_id,

                'start_date' =>
                    $request->start_date,

                'end_date' =>
                    $request->end_date,

                'status' =>
                    $request->status,
            ]
        );

        if ($response->successful()) {

            return redirect()
                ->route('subscriptions.index')
                ->with(
                    'toast_success',
                    $response->json('message')
                );
        }

        if ($response->status() === 422) {

            return back()
                ->withErrors(
                    $response->json('errors')
                        ?? []
                )
                ->withInput()
                ->with(
                    'toast_error',
                    $response->json('message')
                );
        }

        return back()
            ->withInput()
            ->with(
                'toast_error',
                $response->json('message')
                    ?? 'Something went wrong'
            );
    }

    public function changeStatus(
        Request $request,
        int $id
    ): RedirectResponse {

        $response = Http::patch(
            "{$this->apiUrl}/{$id}/status",
            [
                'status' =>
                    $request->status
            ]
        );

        if ($response->successful()) {

            return redirect()
                ->route('subscriptions.index')
                ->with(
                    'toast_success',
                    $response->json('message')
                );
        }

        return back()->with(
            'toast_error',
            $response->json('message')
                ?? 'Something went wrong'
        );
    }
}