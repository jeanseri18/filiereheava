<?php

namespace App\Services;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use App\Models\Document;
use App\Models\ShareGroup;
use App\Models\SharedUser;

class NotificationService
{
    /**
     * Notifier la création d'un nouveau document
     * 
     * @param \App\Models\Document $document Le document créé
     * @param \App\Models\User $creator L'utilisateur créateur du document
     * @return void
     */
    public function notifyDocumentCreation(Document $document, User $creator): void
    {
        try {
            // Récupérer les destinataires pour la création de document
            $recipients = $this->getDocumentCreationRecipients();
            
            foreach ($recipients as $recipient) {
                Mail::send('emails.document_created', [
                    'document' => $document,
                    'creator' => $creator,
                    'recipient' => $recipient
                ], function ($message) use ($recipient, $document) {
                    $message->to($recipient->email, $recipient->nom)
                           ->subject('Nouveau document créé : ' . $document->nom);
                });
            }
            
            Log::info('Notifications de création de document envoyées', [
                'document_id' => $document->id,
                'recipients_count' => count($recipients)
            ]);
            
        } catch (\Exception $e) {
            Log::error('Erreur lors de l\'envoi des notifications de création de document', [
                'error' => $e->getMessage(),
                'document_id' => $document->id
            ]);
        }
    }

    /**
     * Notifier le partage d'un document
     * 
     * @param \App\Models\Document $document Le document partagé
     * @param \App\Models\User $sharedUsers L'utilisateur avec qui le document est partagé
     * @param \App\Models\User $creator L'utilisateur qui partage le document
     * @param string $shareType Le type de partage
     * @return void
     */
    public function notifyDocumentShared(Document $document, User $sharedUsers, User $creator, string $shareType): void
    {
        try {
            $recipients = [];
            
            if ($shareType === 'public') {
                // Pour les documents publics, notifier uniquement les rôles spécifiques
                $recipients = User::
                // whereIn('role', ['vise', 'directeurexecutif', 'pca', 'admin'])
                                where('status', 'actif')
                                ->get();
            } elseif ($shareType === 'privé') {
                // Pour les documents privés, notifier uniquement les utilisateurs concernés avec les bons rôles
                $userIds = collect($sharedUsers)->pluck('id_user');
                $recipients = User::whereIn('id', $userIds)
                                ->whereIn('role', ['vise', 'directeurexecutif', 'pca', 'admin'])
                                ->where('status', 'actif')
                                ->get();
            } elseif ($shareType === 'groupe') {
                // Pour les groupes, récupérer les membres du groupe avec les bons rôles
                $groupIds = collect($sharedUsers)->pluck('id_group');
                $groupMembers = SharedUser::whereIn('id_group', $groupIds)->pluck('id_user');
                $recipients = User::whereIn('id', $groupMembers)
                                ->whereIn('role', ['vise', 'directeurexecutif', 'pca', 'admin'])
                                ->where('status', 'actif')
                                ->get();
            }
            
            foreach ($recipients as $recipient) {
                Mail::send('emails.document_shared', [
                    'document' => $document,
                    'creator' => $creator,
                    'recipient' => $recipient,
                    'shareType' => $shareType
                ], function ($message) use ($recipient, $document) {
                    $message->to($recipient->email, $recipient->nom)
                           ->subject('Document partagé : ' . $document->nom);
                });
            }
            
            Log::info('Notifications de partage de document envoyées', [
                'document_id' => $document->id,
                'share_type' => $shareType,
                'recipients_count' => count($recipients)
            ]);
            
        } catch (\Exception $e) {
            Log::error('Erreur lors de l\'envoi des notifications de partage de document', [
                'error' => $e->getMessage(),
                'document_id' => $document->id
            ]);
        }
    }

    /**
     * Notifier la validation ou le rejet d'une demande
     * 
     * @param \Illuminate\Database\Eloquent\Model $model Le modèle de la demande
     * @param string $type Le type de demande
     * @param bool $isValidated True si validé, false si rejeté
     * @param \App\Models\User $validator L'utilisateur qui valide/rejette
     * @return void
     */
    public function notifyValidation($model, string $type, bool $isValidated, User $validator): void
    {
        try {
            // Récupérer l'utilisateur concerné par la demande
            $user = User::find($model->id_user ?? $model->user_id);
            
            if (!$user) {
                Log::warning('Utilisateur non trouvé pour la notification de validation', [
                    'model_id' => $model->id,
                    'type' => $type
                ]);
                return;
            }
            
            Mail::send('emails.validation_notification', [
                'model' => $model,
                'type' => $type,
                'isValidated' => $isValidated,
                'validator' => $validator,
                'user' => $user
            ], function ($message) use ($user, $type, $isValidated) {
                $status = $isValidated ? 'validée' : 'rejetée';
                $message->to($user->email, $user->nom)
                       ->subject('Votre ' . $type . ' a été ' . $status);
            });
            
            Log::info('Notification de validation envoyée', [
                'model_id' => $model->id,
                'type' => $type,
                'user_id' => $user->id,
                'is_validated' => $isValidated
            ]);
            
        } catch (\Exception $e) {
            Log::error('Erreur lors de l\'envoi de la notification de validation', [
                'error' => $e->getMessage(),
                'model_id' => $model->id,
                'type' => $type
            ]);
        }
    }

    /**
     * Notifier la création d'une nouvelle demande
     * 
     * @param \Illuminate\Database\Eloquent\Model $model Le modèle de la demande
     * @param string $type Le type de demande
     * @param \App\Models\User $creator L'utilisateur créateur de la demande
     * @return void
     */
    public function notifyNewRequest($model, string $type, User $creator): void
    {
        try {
            $recipients = collect();
            
            // Inclure seulement les validateurs concernés par ce type de demande
            $concernedValidators = $this->getConcernedValidators($type, $creator->id_service);
            $recipients = $recipients->merge($concernedValidators);
            
            // Logique pour les supérieurs
            if (isset($model->id_superieur) && $model->id_superieur) {
                // Si un supérieur spécifique est assigné
                $specificSuperior = User::find($model->id_superieur);
                if ($specificSuperior && $specificSuperior->status === 'actif') {
                    $recipients->push($specificSuperior);
                }
            } else {
                // Sinon, notifier les supérieurs du même service que le créateur
                $superiors = User::where('permissionrh', 'superieur')
                               ->where('id_service', $creator->id_service)
                               ->where('status', 'actif')
                               ->get();
                $recipients = $recipients->merge($superiors);
            }
            
            // Supprimer les doublons
            $recipients = $recipients->unique('id');
            
            foreach ($recipients as $recipient) {
                Mail::send('emails.new_request', [
                    'model' => $model,
                    'type' => $type,
                    'creator' => $creator,
                    'recipient' => $recipient
                ], function ($message) use ($recipient, $type, $creator) {
                    $message->to($recipient->email, $recipient->nom)
                           ->subject('Nouvelle ' . $type . ' de ' . $creator->nom);
                });
            }
            
            Log::info('Notifications de nouvelle demande envoyées', [
                'model_id' => $model->id,
                'type' => $type,
                'creator_id' => $creator->id,
                'recipients_count' => count($recipients)
            ]);
            
        } catch (\Exception $e) {
            Log::error('Erreur lors de l\'envoi des notifications de nouvelle demande', [
                'error' => $e->getMessage(),
                'model_id' => $model->id,
                'type' => $type
            ]);
        }
    }

    /**
     * Récupérer les validateurs concernés par un type de demande spécifique
     * 
     * @param string $type Le type de demande
     * @param int $serviceId L'ID du service du créateur
     * @return \Illuminate\Database\Eloquent\Collection
     */
    private function getConcernedValidators(string $type, int $serviceId)
    {
        return User::where(function ($query) use ($serviceId) {
                        // Validateurs du même service ou validateurs généraux
                        $query->where(function ($subQuery) use ($serviceId) {
                            $subQuery->whereIn('permissionrh', ['validateur', 'rh', 'valideur'])
                                   ->where('status', 'actif')
                                   ->where(function ($serviceQuery) use ($serviceId) {
                                       $serviceQuery->where('id_service', $serviceId)
                                                  ->orWhereNull('id_service'); // Validateurs généraux
                                   });
                        })
                        // Ou utilisateurs avec des rôles spécifiques (tous reçoivent toutes les notifications)
                        ->orWhere(function ($subQuery) {
                            $subQuery->whereIn('role', ['vise', 'directeurexecutif', 'pca', 'admin'])
                                   ->where('status', 'actif');
                        })
                        // Ou utilisateurs RH (reçoivent toutes les notifications peu importe le service)
                        ->orWhere(function ($subQuery) {
                            $subQuery->whereIn('permissionrh', ['rh', 'valideur'])
                                   ->where('status', 'actif');
                        });
                    })
                    ->get();
    }

    /**
     * Récupérer les destinataires pour la création de document
     * 
     * @return \Illuminate\Database\Eloquent\Collection
     */
    private function getDocumentCreationRecipients()
    {
        return User::where(function ($query) {
                        $query->whereIn('permissionrh', ['superieur', 'validateur','rh'])
                              ->orWhereIn('role', ['vise', 'directeurexecutif', 'pca', 'admin']);
                    })
                    ->where('status', 'actif')
                    ->get();
    }
}