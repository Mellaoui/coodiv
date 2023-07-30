<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMatiereRequest;
use App\Http\Requests\UpdateMatiereRequest;
use App\Models\Matiere;
use Inertia\Response as InertiaResponse;
use Illuminate\Http\RedirectResponse;

class MatiereController extends Controller
{
    public function index(): InertiaResponse
    {
        $this->authorize('viewAny', Matiere::class);

        return inertia()->render('Matiere/MatiereIndex', [
            'matieres' => Matiere::paginate(5)
        ]);
    }

    public function create(): InertiaResponse
    {
        $this->authorize('create', Matiere::class);

        return inertia()->render('Matiere/CreateMatiere');
    }

    public function store(StoreMatiereRequest $request): RedirectResponse
    {
        $this->authorize('create', Matiere::class);

        $matiere = Matiere::create($request->validated());

        return redirect()->route('matieres.show', $matiere)
            ->with('success', 'Matiere created');
    }

    public function show(Matiere $matiere): InertiaResponse
    {
        $this->authorize('view', $matiere);

        return inertia()->render('Matiere/ShowMatiere', [
            'matiere' => $matiere
        ]);
    }

    public function edit(Matiere $matiere): InertiaResponse
    {
        $this->authorize('update', $matiere);

        return inertia()->render('Matiere/EditMatiere', [
            'matiere' => $matiere
        ]);
    }

    public function update(UpdateMatiereRequest $request, Matiere $matiere): RedirectResponse
    {
        $this->authorize('update', $matiere);

        $matiere->update($request->validated());

        $matiere->fresh();

        return redirect()->route('matieres.show', $matiere)
            ->with('success', 'Matiere updated');
    }

    public function destroy(Matiere $matiere): RedirectResponse
    {
        $this->authorize('delete', $matiere);

        $matiere->delete();

        return redirect()->route('matieres.index')
            ->with('success', 'Matiere deleted');
    }
}
