<?php

namespace App\Http\Controllers;

use App\Models\AutorisationAbsence;
use App\Models\User; // Pour récupérer les utilisateurs
use App\Services\NotificationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AutorisationAbsenceController extends Controller
{
    protected $notificationService;

    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }
    public function index()
    {
        $user = Auth::user();

        $autorisations = in_array($user->permissionrh, ['rh', 'validateur'])
            ? AutorisationAbsence::all()
            : AutorisationAbsence::where('id_user', $user->id)->get();
    
        return view('autorisations.index', compact('autorisations'));
    }

    public function create()
    {
        $users = User::all(); // Récupérer tous les utilisateurs
        return view('autorisations.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_user' => 'required',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date',
            'nombre_jours' => 'required|integer',
            'raison' => 'required',
        ]);

        $autorisation = AutorisationAbsence::create($request->all());
        
        // Envoyer notification aux RH, supérieurs et validateurs
        $this->notificationService->notifyNewRequest($autorisation, 'autorisation d\'absence', Auth::user());
        
        return redirect()->route('autorisations.index');
    }

public function show($id)
{
        set_time_limit(300);

    $autorisation = AutorisationAbsence::findOrFail($id);
    $pdf = \PDF::loadView('autorisations.show', compact('autorisation'));
    
    // Optional: Set custom header/footer options if needed
    $pdf->setPaper('a4');
    $pdf->setOption('dpi', 96); // Réduire la résolution
    $pdf->setOption('defaultFont', 'DejaVu Sans');
    $pdf->setOption('isRemoteEnabled', false); // Désactiver les ressources distantes
    $pdf->setOption('debugKeepTemp', false);
    $pdf->setOption('debugCss', false);
    $pdf->setOption('debugLayout', false);
    
    return $pdf->stream('autorisation_absence_'.$id.'.pdf');
}

    public function edit($id)
    {
        $autorisation = AutorisationAbsence::findOrFail($id);
        $users = User::all(); // Récupérer tous les utilisateurs
        return view('autorisations.edit', compact('autorisation', 'users'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_user' => 'required',
          
            'date_debut' => 'required|date',
            'date_fin' => 'required|date',
            'nombre_jours' => 'required|integer',
            'raison' => 'required',
        ]);

        $autorisation = AutorisationAbsence::findOrFail($id);
        $autorisation->update($request->all());
        return redirect()->route('autorisations.index');
    }

    public function destroy($id)
    {
        $autorisation = AutorisationAbsence::findOrFail($id);
        $autorisation->delete();
        return redirect()->route('autorisations.index');
    }
    public function valider($id)
    {
        // Trouver l'autorisation par son ID
        $autorisation = AutorisationAbsence::findOrFail($id);

        // Mettre à jour la validation du directeur
        $autorisation->validation_directeur = true;
        $autorisation->date_validation = now(); // Ajoutez la date de validation
        $autorisation->save();

        // Envoyer notification de validation à l'utilisateur
        $this->notificationService->notifyValidation($autorisation, 'autorisation d\'absence', true, Auth::user());

        // Rediriger vers la liste des autorisations avec un message de succès
        return redirect()->route('autorisations.index')->with('success', 'L\'autorisation a été validée avec succès.');
    }

    public function rejeter($id)
    {
        // Trouver l'autorisation par son ID
        $autorisation = AutorisationAbsence::findOrFail($id);

        // Mettre à jour la validation du directeur
        $autorisation->validation_directeur = false;
        $autorisation->date_validation = null; // Annuler la date de validation
        $autorisation->save();

        // Envoyer notification de rejet à l'utilisateur
        $this->notificationService->notifyValidation($autorisation, 'autorisation d\'absence', false, Auth::user());

        // Rediriger vers la liste des autorisations avec un message de succès
        return redirect()->route('autorisations.index')->with('error', 'L\'autorisation a été rejetée.');
    }
}
