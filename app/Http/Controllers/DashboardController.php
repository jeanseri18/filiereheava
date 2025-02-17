<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\AttestationStage;
use App\Models\AttestationTravail;
use App\Models\AutorisationAbsence;
use App\Models\CertificatTravail;
use App\Models\DemandeAbsence;
use App\Models\DemandeDepartConges;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Vérifie si l'utilisateur a le rôle de RH validateur
        if ($user->permissionrh === 'valideur') {
            // Récupérer toutes les statistiques globales
            $stats = [
                'attestations_stage' => AttestationStage::count(),
                'attestations_travail' => AttestationTravail::count(),
                'autorisations_absence' => AutorisationAbsence::count(),
                'demandes_absence' => DemandeAbsence::count(),
                'certificats_travail' => CertificatTravail::count(),
                'demandes_depart_conges' => DemandeDepartConges::count(),

                // Statistiques validées et rejetées
                'attestations_stage_validees' => AttestationStage::where('validation_directeur', true)->count(),
                'attestations_stage_rejetees' => AttestationStage::where('validation_directeur', false)->count(),

                'attestations_travail_validees' => AttestationTravail::where('validation_directeur', true)->count(),
                'attestations_travail_rejetees' => AttestationTravail::where('validation_directeur', false)->count(),

                'certificats_travail_validees' => CertificatTravail::where('validation_directeur', true)->count(),
                'certificats_travail_rejetees' => CertificatTravail::where('validation_directeur', false)->count(),

                'demandes_absence_validees' => DemandeAbsence::where('validation_superieur', 'Validé')->count(),
                'demandes_absence_rejetees' => DemandeAbsence::where('validation_superieur', 'Rejeté')->count(),

                'demandes_depart_conges_validees' => DemandeDepartConges::where('avis_superieur', 'Validé')->count(),
                'demandes_depart_conges_rejetees' => DemandeDepartConges::where('avis_superieur', 'Rejeté')->count(),
            ];
        } else {
            // Récupérer les statistiques uniquement pour l'utilisateur connecté et son supérieur
            $superieur = User::where('id_service', $user->id_service)
                            ->where('permissionrh', 'superieur')
                            ->first();

            $ids = [$user->id]; // ID de l'utilisateur connecté

            if ($superieur) {
                $ids[] = $superieur->id; // Ajoute l'ID du supérieur si disponible
            }

            $stats = [
                'attestations_stage' => AttestationStage::whereIn('id_user', $ids)->count(),
                'attestations_travail' => AttestationTravail::whereIn('id_user', $ids)->count(),
                'autorisations_absence' => AutorisationAbsence::whereIn('id_user', $ids)->count(),
                'demandes_absence' => DemandeAbsence::whereIn('id_user', $ids)->count(),
                'certificats_travail' => CertificatTravail::whereIn('id_user', $ids)->count(),
                'demandes_depart_conges' => DemandeDepartConges::whereIn('id_user', $ids)->count(),

                // Statistiques validées et rejetées
                'attestations_stage_validees' => AttestationStage::whereIn('id_user', $ids)->where('validation_directeur', true)->count(),
                'attestations_stage_rejetees' => AttestationStage::whereIn('id_user', $ids)->where('validation_directeur', false)->count(),

                'attestations_travail_validees' => AttestationTravail::whereIn('id_user', $ids)->where('validation_directeur', true)->count(),
                'attestations_travail_rejetees' => AttestationTravail::whereIn('id_user', $ids)->where('validation_directeur', false)->count(),

                'certificats_travail_validees' => CertificatTravail::whereIn('id_user', $ids)->where('validation_directeur', true)->count(),
                'certificats_travail_rejetees' => CertificatTravail::whereIn('id_user', $ids)->where('validation_directeur', false)->count(),

                'demandes_absence_validees' => DemandeAbsence::whereIn('id_user', $ids)->where('validation_superieur', 'Validé')->count(),
                'demandes_absence_rejetees' => DemandeAbsence::whereIn('id_user', $ids)->where('validation_superieur', 'Rejeté')->count(),

                'demandes_depart_conges_validees' => DemandeDepartConges::whereIn('id_user', $ids)->where('avis_superieur', 'Validé')->count(),
                'demandes_depart_conges_rejetees' => DemandeDepartConges::whereIn('id_user', $ids)->where('avis_superieur', 'Rejeté')->count(),
            ];
        }

        return view('dashboard.indexrh', compact('stats'));
    }
}
