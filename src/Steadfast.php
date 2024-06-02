<?php

namespace Shshohagh\SteadfastCourier;

use Illuminate\Support\Facades\Http;

class Steadfast
{
    protected $baseUrl;
    protected $apiKey;
    protected $secretKey;

    public function __construct()
    {
        $this->baseUrl = config('steadfast.base_url');
        $this->apiKey = config('steadfast.api_key');
        $this->secretKey = config('steadfast.secret_key');
    }

    private function makeRequest($method, $endpoint, $data = [])
    {
        $response = Http::withHeaders([
            'Content-Type' => config('steadfast.content_type'),
            'Api-Key' => $this->apiKey,
            'Secret-Key' => $this->secretKey,
        ])->$method($this->baseUrl . $endpoint, $data);

        if ($response->successful()) {
            return $response->json();
        }

        return [
            'error' => true,
            'message' => $response->json()['message'] ?? 'An error occurred',
        ];
    }

    public function placeOrder($data)
    {
        return $this->makeRequest('post', '/create_order', $data);
    }

    public function bulkCreateOrders($data)
    {
        return $this->makeRequest('post', '/create_order/bulk-order', ['data' => json_encode($data)]);
    }

    public function checkDeliveryStatusByConsignmentId($id)
    {
        return $this->makeRequest('get', '/status_by_cid/'.$id);
    }

    public function checkDeliveryStatusByInvoiceId($id)
    {
        return $this->makeRequest('get', '/status_by_invoice/'.$id);
    }

    public function checkDeliveryStatusByTrackingCode($id)
    {
        return $this->makeRequest('get', '/status_by_trackingcode/'.$id);
    }

    public function getCurrentBalance()
    {
        return $this->makeRequest('get', '/get_balance');
    }
}
