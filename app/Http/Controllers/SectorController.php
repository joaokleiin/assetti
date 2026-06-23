<?php

namespace App\Http\Controllers;

use App\Models\Sector;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SectorController extends Controller
{
    public function index(): View
    {
        return view('sectors.index', [
            'sectors' => Sector::query()
                ->orderBy('name')
                ->paginate(10),
        ]);
    }

    public function create(): View
    {
        return view('sectors.create', [
            'sector' => new Sector,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:sectors,name'],
            'responsible' => ['nullable', 'string', 'max:255'],
            'location' => ['nullable', 'string', 'max:255'],
        ]);

        Sector::create($validated);

        return redirect()
            ->route('sectors.index')
            ->with('success', 'Setor criado com sucesso.');
    }

    public function edit(Sector $sector): View
    {
        return view('sectors.edit', [
            'sector' => $sector,
        ]);
    }

    public function update(Request $request, Sector $sector): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', Rule::unique('sectors', 'name')->ignore($sector)],
            'responsible' => ['nullable', 'string', 'max:255'],
            'location' => ['nullable', 'string', 'max:255'],
        ]);

        $sector->update($validated);

        return redirect()
            ->route('sectors.index')
            ->with('success', 'Setor atualizado com sucesso.');
    }

    public function destroy(Sector $sector): RedirectResponse
    {
        $sector->delete();

        return redirect()
            ->route('sectors.index')
            ->with('success', 'Setor excluido com sucesso.');
    }
}
