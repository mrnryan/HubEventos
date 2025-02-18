<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;
    
    protected $table = 'feedbacks'; // Corrigido para o nome correto da tabela

    protected $fillable = ['event_id', 'name', 'comment', 'rating'];

    // Relacionamento com o evento
    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
