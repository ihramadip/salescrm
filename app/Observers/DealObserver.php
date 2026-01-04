<?php

namespace App\Observers;

use App\Models\Deal;
use Illuminate\Support\Facades\Auth;

class DealObserver
{
    /**
     * Handle the Deal "created" event.
     */
    public function created(Deal $deal): void
    {
        $this->logActivity($deal, 'created', 'created a new deal');
    }

    /**
     * Handle the Deal "updated" event.
     */
    public function updated(Deal $deal): void
    {
        $changes = $deal->getChanges();
        $original = $deal->getOriginal();

        if (array_key_exists('stage', $changes)) {
            $this->logActivity($deal, 'stage_changed', "changed the deal stage from '{$original['stage']}' to '{$changes['stage']}'");
        }
        
        if (array_key_exists('user_id', $changes)) {
            $oldUser = \App\Models\User::find($original['user_id'])->name ?? 'Unassigned';
            $newUser = \App\Models\User::find($changes['user_id'])->name ?? 'Unassigned';
            $this->logActivity($deal, 'owner_changed', "changed the deal owner from '{$oldUser}' to '{$newUser}'");
        }
    }

    /**
     * Handle the Deal "deleted" event.
     */
    public function deleted(Deal $deal): void
    {
        $this->logActivity($deal, 'deleted', 'deleted the deal');
    }

    /**
     * Log activity for the deal.
     *
     * @param Deal $deal
     * @param string $type
     * @param string $description
     */
    private function logActivity(Deal $deal, string $type, string $description): void
    {
        $user = Auth::user();
        if ($user) {
            $deal->activities()->create([
                'user_id' => $user->id,
                'type' => $type,
                'description' => $description,
            ]);
        }
    }
}
