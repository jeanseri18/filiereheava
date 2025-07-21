<?php
namespace App\Http\Controllers;

use App\Models\AttestationTravail;
use App\Models\User;
use App\Services\NotificationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttestationTravailController extends Controller
{
    protected $notificationService;

    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }
    // Afficher la liste des attestations de travail
    public function index()
    {
        $user = Auth::user();

    $attestations = in_array($user->permissionrh, ['rh', 'validateur'])
        ? AttestationTravail::all()
        : AttestationTravail::where('id_user', $user->id)->get();

    return view('attestations_travail.index', compact('attestations'));
}
    // Afficher le formulaire de création
    public function create()
    {
        $users = User::all();
        return view('attestations_travail.create', compact('users'));
    }

    // Enregistrer une nouvelle attestation de travail
    public function store(Request $request)
    {
        $request->validate([
            'id_user' => 'required|string',
            'date_embauche' => 'required|date',
            'lieu_travail' => 'required|string',
            'type_contrat' => 'required|string',

        ]);

        $attestation = AttestationTravail::create($request->all());

        // Envoyer notification aux RH, supérieurs et validateurs
        $this->notificationService->notifyNewRequest($attestation, 'attestation de travail', Auth::user());

        return redirect()->route('attestations_travail.index')->with('success', 'Attestation de travail créée avec succès.');
    }

    // Afficher une attestation spécifique
public function show($id)
{
        set_time_limit(300);

    $attestation = AttestationTravail::findOrFail($id);
    $pdf = \PDF::loadView('attestations_travail.show', compact('attestation'));
        $pdf->setPaper('a4');
    $pdf->setOption('dpi', 96); // Réduire la résolution
    $pdf->setOption('defaultFont', 'DejaVu Sans');
    $pdf->setOption('isRemoteEnabled', false); // Désactiver les ressources distantes
    $pdf->setOption('debugKeepTemp', false);
    $pdf->setOption('debugCss', false);
    $pdf->setOption('debugLayout', false);
    
    return $pdf->stream('attestation_travail_'.$id.'.pdf');
}

    // Afficher le formulaire d'édition
    public function edit($id)
    {
        $attestation = AttestationTravail::findOrFail($id);
        $users = User::all();
        return view('attestations_travail.edit', compact('attestation', 'users'));
    }

    // Mettre à jour une attestation
    public function update(Request $request, $id)
    {
        $request->validate([
            'id_user' => 'required|string',
            'date_embauche' => 'required|date',
            'lieu_travail' => 'required|string',
            'type_contrat' => 'required|string',

        ]);

        $attestation = AttestationTravail::findOrFail($id);
        $attestation->update($request->all());

        return redirect()->route('attestations_travail.index')->with('success', 'Attestation de travail mise à jour.');
    }

    // Supprimer une attestation de travail
    public function destroy($id)
    {
        $attestation = AttestationTravail::findOrFail($id);
        $attestation->delete();

        return redirect()->route('attestations_travail.index')->with('success', 'Attestation supprimée.');
    }

    // Valider une attestation
    public function validateAttestation($id)
    {
        $attestation = AttestationTravail::findOrFail($id);
        // Appeler la méthode validateAttestation() dans le modèle
        $attestation->validation_directeur = true;
        $attestation->date_validation = now(); // Ajoutez la date de validation
        $attestation->save();

        // Envoyer notification de validation à l'utilisateur
        $this->notificationService->notifyValidation($attestation, 'attestation de travail', true, Auth::user());

        return redirect()->route('attestations_travail.index')->with('success', 'Attestation validée.');
    }

    // Rejeter une attestation
    public function rejectAttestation($id)
    {
        $attestation = AttestationTravail::findOrFail($id);

        // Appeler la méthode rejectAttestation() dans le modèle
        $attestation->validation_directeur = false;
        $attestation->date_validation = null; // Annuler la date de validation
        $attestation->save();

        // Envoyer notification de rejet à l'utilisateur
        $this->notificationService->notifyValidation($attestation, 'attestation de travail', false, Auth::user());

        return redirect()->route('attestations_travail.index')->with('error', 'Attestation rejetée.');
    }
}
