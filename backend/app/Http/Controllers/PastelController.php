<?php

namespace App\Http\Controllers;

use App\Models\Pastel;
use App\Models\Ingrediente;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class PastelController extends Controller
{
    public function index(): JsonResponse
    {
        $pasteles = Pastel::with('ingredientes')->get();
        return response()->json($pasteles);
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'nombre'             => 'required|string|max:255',
            'descripcion'        => 'nullable|string',
            'preparado_por'      => 'nullable|string|max:255',
            'fecha_creacion'     => 'nullable|date',
            'fecha_vencimiento'  => 'nullable|date|after_or_equal:fecha_creacion',
            'ingredientes'       => 'array',
            'ingredientes.*'     => 'integer|exists:ingredientes,id',
        ]);

        $pastel = Pastel::create($data);

        $ingredientes = $data['ingredientes'] ?? [];
        if (!empty($ingredientes)) {
            $pastel->ingredientes()->attach($ingredientes);
        }

        return response()->json($pastel->load('ingredientes'), 201);
    }

    public function show(int $id): JsonResponse
    {
        $pastel = Pastel::with('ingredientes')->findOrFail($id);
        return response()->json($pastel);
    }

    public function update(Request $request, int $id): JsonResponse
    {
        $pastel = Pastel::findOrFail($id);

        $data = $request->validate([
            'nombre'             => 'sometimes|required|string|max:255',
            'descripcion'        => 'nullable|string',
            'preparado_por'      => 'nullable|string|max:255',
            'fecha_creacion'     => 'nullable|date',
            'fecha_vencimiento'  => 'nullable|date|after_or_equal:fecha_creacion',
            'ingredientes'       => 'array',
            'ingredientes.*'     => 'integer|exists:ingredientes,id',
        ]);

        $pastel->update($data);

        if ($request->has('ingredientes')) {
            $pastel->ingredientes()->sync($data['ingredientes'] ?? []);
        }

        return response()->json($pastel->load('ingredientes'));
    }

    public function destroy(int $id): JsonResponse
    {
        $pastel = Pastel::findOrFail($id);
        $pastel->ingredientes()->detach();
        $pastel->delete();

        return response()->json(['message' => 'Pastel eliminado']);
    }
}
