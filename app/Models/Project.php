<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{

    use HasFactory;
    protected $fillable = ['title', 'image', 'content', 'slogan', 'type_id'];


    // assegno la relazione con le categorie
    public function type()
    {
        return $this->belongsTo(Type::class);
    }
    // assegno la relazione con technologies
    public function technologies()
    {
        return $this->belongsToMany(Technology::class);
    }
}
