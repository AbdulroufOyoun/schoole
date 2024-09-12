<?php

namespace App\Http\Resources\UserResource;

use App\Models\Follow;
use App\Models\Like;
use App\Models\School;
use Illuminate\Http\Resources\Json\JsonResource;

class ProfileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($user)
    {

        $is_liked = Like::where(['user_id'=>auth()->user()->id,'profile_id'=>$this->id])->exists();
        $is_follower = Follow::where(['user_id'=>auth()->user()->id,'profile_id'=>$this->id])->exists();
        $school = School::find($this->school_id);

        $data = [
            'school_name' =>$school->name,
            'school_logo' =>$school->logo,
            'welcome_screen' =>$school->welcome_screen,
            'school_about_us' =>$school->about_us,
            'id' => $this->id,
            'name' => $this->name.' '.$this->last_name,
            'UserName' => $this->UserName,
            'accountType' => $this->AccountType,
            'UserPermission' => $this->getPermissionsViaRoles()->pluck('name'),
            'email' => $this->email,
            'phone' => $this->phone,
            'image' => $this->image,
        ];

        if ($this->AccountType == 'teacher') {
            $data['teacher section'] = $this->teacher_section;

        }

        if ($this->AccountType == 'student') {

            $data['classroom'] = $this->classroom?$this->classroom->name:null;

        }

        if ($this->AccountType == 'student' || $this->AccountType == 'teacher') {
            $data['hobbies'] = $this->hobbies;
            $data['about_me'] = $this->about_me;
            $data['country'] = $this->country;
            $data['languages'] = $this->languages;
            $data['date_of_birth'] = $this->date_of_birth;
            $data['likesCount'] = $this->likesCount();
            $data['is_liked'] = $is_liked;
            $data['FollowersCount'] = $this->FollowersCount();
            $data['is_follower'] = $is_follower;
            $data['FollowingsCount'] = $this->FollowingsCount();
            $data['gender'] = $this->gender;


        }


        return $data;
    }
}
