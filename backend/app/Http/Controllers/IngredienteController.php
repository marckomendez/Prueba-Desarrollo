<?php

namespace App\Http\Controllers;

use App\Models\Ingrediente;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class IngredienteController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(Ingrediente::all());
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'nombre'            => 'required|string|max:255',
            'descripcion'       => 'nullable|string',
            'fecha_ingreso'     => 'nullable|date',
            'fecha_vencimiento' => 'nullable|date|after_or_equal:fecha_ingreso',
        ]);
        $ingrediente = Ingrediente::create($data);
        return response()->json($ingrediente, 201);
    }

    public function show(int $id): JsonResponse
    {
        return response()->json(Ingrediente::findOrFail($id));
    }

    public function update(Request $request, int $id): JsonResponse
    {
        $ingrediente = Ingrediente::findOrFail($id);
        $data = $request->validate([
            'nombre'            => 'sometimes|required|string|max:255',
            'descripcion'       => 'nullable|string',
            'fecha_ingreso'     => 'nullable|date',
            'fecha_vencimiento' => 'nullable|date|after_or_equal:fecha_ingreso',
        ]);
        $ingrediente->update($data);
        return response()->json($ingrediente);
    }

    public function destroy(int $id): JsonResponse
    {
        $ingrediente = Ingrediente::findOrFail($id);
        $ingrediente->pasteles()->detach();
        $ingrediente->delete();
        return response()->json(['message' => 'Ingrediente eliminado']);
    }
}
