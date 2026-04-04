<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contenu extends Model
{
    protected $fillable = ['titre', 'texte', 'lien_ressource', 'sous_chapitre_id'];

    public function sousChapitre()
    {
        return $this->belongsTo(SousChapitre::class);
    }
}