<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deal extends Model
{
    use HasFactory;

    protected $fillable = ['value', 'probability','expected_close_date', 'notes', 'organization_id', 'contact_id'];
     //Yet to include foreign relationships with account, contact and deal_stagestables

     // Define the relationship with the Organization model
    public function organization()
    {
        return $this->belongsTo(Organization::class, 'organization_id');
    }

    // Define the relationship with the Contact model
    public function contact()
    {
        return $this->belongsTo(Contact::class, 'contact_id');
    }
}
