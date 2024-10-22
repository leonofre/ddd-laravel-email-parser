<?php

namespace App\Http\Controllers;

use App\Domains\SuccessfulEmail\Services\SuccessfulEmailService;
use App\Domains\SuccessfulEmail\Entities\SuccessfulEmail;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class SuccessfulEmailController extends Controller
{
    private SuccessfulEmailService $service;

    public function __construct(SuccessfulEmailService $service)
    {
        $this->service = $service;
    }

    /**
     * Store a newly created record in the successful_emails table.
     */
    public function store(Request $request): JsonResponse
    {
        $successfulEmail = $this->service->createEmail($request->all());

        return response()->json($successfulEmail->toArray());
    }

    /**
     * Display the specified record by ID.
     */
    public function show($id): JsonResponse
    {
        $successfulEmail = $this->service->getById((int) $id);

        return response()->json($successfulEmail->toArray());
    }

    /**
     * Update the specified record in the successful_emails table.
     */
    public function update(Request $request, $id): JsonResponse
    {
        $successfulEmail = $this->service->updateEmail($id, $request->all());

        if (! $successfulEmail) {
            return response()->json(['message' => 'Not found'], 404);
        }

        return response()->json($successfulEmail->toArray());
    }

    /**
     * Display a listing of all records excluding deleted items.
     */
    public function index(Request $request): JsonResponse
    {
        $emails = $this->service->getAll();
        return response()->json($emails);
    }

    /**
     * Soft delete the specified record by ID.
     */
    public function destroy($id): JsonResponse
    {
        if (! $this->service->delete($id)) {
            return response()->json(['message' => 'Not found'], 404);
        }

        return response()->json(['message' => 'Record deleted successfully']);
    }
}
