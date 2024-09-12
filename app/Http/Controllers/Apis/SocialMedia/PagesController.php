<?php

namespace App\Http\Controllers\Apis\SocialMedia;

use App\Http\Controllers\ApiResponseTrait;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ImageTrait;
use App\Http\Resources\PostsResource\PostsResource;
use App\Models\Activities;
use App\Models\AdvertisingTeacher;
use App\Models\Post;
use App\Models\Setting;
use App\Models\User;

class PagesController extends Controller
{
    use ApiResponseTrait;
    use ImageTrait;

    public function private_page(int $id = null)
    {
        if ($id) {
            $user = User::find($id);
            if ($user) {
                $posts = Post::whereUserId($user->id)->whereConfirmed(true)->wherePrivate(false)->latest()->get();
                // posts count
                $data['postsCount'] = $posts->count();
                // posts like count
                $postslikesCount = 0;
                foreach ($posts as $post) {

                    $postslikesCount += $post->likesCount();
                }
                $data['postslikesCount'] = $postslikesCount;
                // recource posts
                $data['posts'] = PostsResource::collection($posts);
                return $this->apiResponse($data);
            } else {
                return $this->notFound();
            }
        }
        $posts = Post::whereUserId(auth()->user()->id)->whereConfirmed(true)->latest()->get();
        // posts count
        $data['postsCount'] = $posts->count();
        // posts like count
        $postslikesCount = 0;
        foreach ($posts as $post) {

            $postslikesCount += $post->likesCount();
        }
        $data['postslikesCount'] = $postslikesCount;
        // recource posts
        $data['posts'] = PostsResource::collection($posts);
        return $this->apiResponse($data);
    }

    public function advertising()
    {
        $settings = Setting::first();
        $data['about us'] = $settings->about_us;
        $data['activities'] = Activities::get()->map(function ($activity) {
            return [
                'image' => $activity->image,
                'name' => $activity->name,
                'rete' => $activity->rate,
                'description' => $activity->description,

            ];
        })->toArray();
        $data['educationl missions'] = $settings->educational_missions;
        $data['educationl vision'] = $settings->educational_vision;

        $data['our teachers'] = AdvertisingTeacher::get()->map(function ($row) {
            return [
                'image' => $row->teacher->image,
                'name' => $row->teacher->name.' '.$row->teacher->last_name,
                'about me' => $row->teacher->about_me,

            ];
        })->toArray();
        $data['trip'] = [
            'description' => $settings->trip_description,
            'youtupe link' => $settings->link_trip,
        ];

        return $this->apiResponse($data);

    }

}
