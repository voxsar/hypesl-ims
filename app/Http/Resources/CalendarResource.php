<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CalendarResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $data = [
            'id' => $this->id,
            'title' => $this->title,
            'allDay' => $this->allday,
            'start' => $this->start,
            'end' => $this->end,
            'url' => $this->url,
            'classNames' => $this->classnames,
            'editable' => 1,
            'startEditable' => $this->starteditable,
            'durationEditable' => $this->durationeditable,
            'resourceEditable' => $this->resourceeditable,
            'display' => $this->display,
            'overlap' => $this->overlap,
            'backgroundColor' => $this->backgroundcolor,
            'borderColor' => $this->bordercolor,
            'textColor' => $this->textcolor,
            'extendedProps' => $this->extendedprops,
            'daysOfWeek' => $this->daysofweek,
            'startTime' => $this->starttime,
            'endTime' => $this->endtime,
            'startRecur' => $this->startrecur,
            'endRecur' => $this->endrecur,
        ];
        if($this->appointment_group_id != null){
            $data['groupId'] = $this->appointment_group_id;
        }
        return $data;
    }
}
