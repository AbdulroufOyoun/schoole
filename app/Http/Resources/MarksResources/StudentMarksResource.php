<?php

namespace App\Http\Resources\MarksResources;

use Illuminate\Http\Resources\Json\JsonResource;

class StudentMarksResource extends JsonResource
{
    public function toArray($request)
    {
        $data = [
            'subject' => $this->subjectMark->subject->name,
            'classwork' => $this->classwork,
            'homework' => $this->homework,
            'exam' => $this->exam,
            'evaluation' => $this->evaluation,
            'total_mark' => $this->total_mark,
            'percentage' => $this->percentage(),
            'grade' => $this->grade(),
            'GPA' => $this->GPA(),

        ];
        return $data;
    }
}
