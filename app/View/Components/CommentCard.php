<?php
namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Doctor;

class CommentCard extends Component
{
    public $doctorId;

    public function __construct($doctorId)
    {
        $this->doctorId = $doctorId;
    }

    public function render()
    {
        $doctor = Doctor::with(['comments' => function($query) {
            $query->orderBy('created_at', 'desc');
        }, 'comments.medicalRecord.patient.user'])->find($this->doctorId);
        
        $comments = $doctor ? $doctor->comments : collect();

        return view('components.comment-card', compact('comments'));
    }
}