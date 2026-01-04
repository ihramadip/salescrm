<?php

namespace App\Observers;

use App\Models\Contact;
use Illuminate\Support\Facades\Auth;

class ContactObserver
{
    /**
     * Handle the Contact "created" event.
     */
    public function created(Contact $contact): void
    {
        $this->logActivity($contact, 'created', 'created a new contact');
    }

    /**
     * Handle the Contact "updated" event.
     */
    public function updated(Contact $contact): void
    {
        if ($contact->isDirty()) {
            $this->logActivity($contact, 'updated', 'updated the contact details');
        }
    }

    /**
     * Handle the Contact "deleted" event.
     */
    public function deleted(Contact $contact): void
    {
        $this->logActivity($contact, 'deleted', 'deleted the contact');
    }

    /**
     * Log activity for the contact.
     *
     * @param Contact $contact
     * @param string $type
     * @param string $description
     */
    private function logActivity(Contact $contact, string $type, string $description): void
    {
        $user = Auth::user();
        if ($user) {
            $contact->activities()->create([
                'user_id' => $user->id,
                'type' => $type,
                'description' => $description,
            ]);
        }
    }
}
