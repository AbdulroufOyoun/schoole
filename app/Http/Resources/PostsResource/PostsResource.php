<?php

namespace App\Http\Resources\PostsResource;

use App\Models\PostComment;
use App\Models\PostLike;
use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class PostsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $is_liked = PostLike::where(['user_id'=>auth()->user()->id,'post_id'=>$this->id])->exists();
        $comment = PostComment::wherePostId($this->id)->latest()->first();

        $data = [
            'id' => $this->id,
            'color'=>$this->color,
            'text'=>$this->text,
            'title' => $this->title,
            'private' => $this->private,
            'name of user' => $this->user->name.' '. $this->user->last_name,
            'user id' => $this->user->id,
            'user image' => $this->user->image,
            'accountType' => $this->user->AccountType,
            'created at' => Carbon::create($this->created_at)->format('Y/m/d h:i a'),
            'confirmed at' => Carbon::create($this->confirmed_at)->format('Y/m/d h:i a'),
            'is_liked' => $is_liked,
            'likesCount' =>  $this->likesCount(),


        ];
        if (!empty($this->attachments->isNotEmpty())) {
            $data['images'] = $this->attachments->pluck('image');
        } else {
            $data['images'] = null;
        }
        if ($comment) {
            $latest_comment = [
                'comment' => $comment->comment,
                'user id' => $comment->user->id,
                'user name' => $comment->user->name.' '.$comment->user->last_name,
                'user image' => $comment->user->image,
                'created at' => Carbon::create($comment->created_at)->format('Y/m/d h:i a'),
            ];
            $data['latest comment'] = $latest_comment;
            $data['comments count'] = $this->commentCount();

        } else {
            $data['latest comment'] = "No comments yet.";
            $data['comments count'] = 0;

        }

        return $data;
    }
}
