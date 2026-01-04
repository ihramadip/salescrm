<?php

namespace App\Observers;

use App\Models\Lead;
use Illuminate\Support\Facades\Auth;

class LeadObserver
{
    /**
     * Handle the Lead "created" event.
     */
    public function created(Lead $lead): void
    {
        $this->logActivity($lead, 'created', 'created a new lead');
    }

    /**
     * Handle the Lead "updated" event.
     */
    public function updated(Lead $lead): void
    {
        $changes = $lead->getChanges();
        $original = $lead->getOriginal();

        if (array_key_exists('status', $changes)) {
            $this->logActivity($lead, 'status_changed', "changed the lead status from '{$original['status']}' to '{$changes['status']}'");
        }

        if (array_key_exists('user_id', $changes)) {
            $oldUser = \App\Models\User::find($original['user_id'])->name ?? 'Unassigned';
            $newUser = \App\Models\User::find($changes['user_id'])->name ?? 'Unassigned';
            $this->logActivity($lead, 'owner_changed', "changed the lead owner from '{$oldUser}' to '{$newUser}'");
        }
    }

    /**
     * Handle the Lead "deleted" event.
     */
    public function deleted(Lead $lead): void
    {
        $this->logActivity($lead, 'deleted', 'deleted the lead');
    }

    /**
     * Log activity for the lead.
     *
     * @param Lead $lead
     * @param string $type
     * @param string $description
     */
    private function logActivity(Lead $lead, string $type, string $description): void
    {
        $user = Auth::user();
        if ($user) {
            $lead->activities()->create([
                'user_id' => $user->id,
                'type' => $type,
                'description' => $description,
            ]);
        }
    }
}
