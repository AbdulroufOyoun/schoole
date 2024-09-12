<?php

namespace App\Http\Controllers\Apis\SocialMedia;

use App\Http\Controllers\ApiResponseTrait;
use App\Http\Controllers\Controller;

use App\Http\Controllers\ImageTrait;
use App\Http\Requests\Apis\PostsRequest\RejectPostRequest;
use App\Http\Requests\Apis\PostsRequest\StoreCommentRequest;
use App\Http\Requests\Apis\PostsRequest\StorePostRequest;
use App\Http\Requests\Apis\PostsRequest\StoreReportRequest;
use App\Http\Requests\Apis\PostsRequest\UpdatePostRequest;
use App\Http\Resources\PostsResource\PostsResource;
use App\Models\Notification;
use App\Models\Post;
use App\Models\PostComment;
use App\Models\PostImage;
use App\Models\PostLike;
use App\Models\Report;
use App\Models\User;
use App\Notifications\FirebaseNotification;
use Arr;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PostController extends Controller
{
    use ApiResponseTrait;
    use ImageTrait;

    public function create(StorePostRequest $request)
    {
        $data = $request->validated();
        $user = auth()->user();

        if ($user->AccountType == "admin" || $user->AccountType == "editor" || $user->AccountType == "academic") {
            $data['confirmed'] = true;
        }

        $item = Post::create([
            'title' => $data['title'],
            'color' => $data['color'],
            'confirmed' => isset($data['confirmed']) ? $data['confirmed'] : false,
            'confirmed_at' => isset($data['confirmed']) ? Carbon::now() : null,
            'user_id' => $user->id,
            'text' => isset($data['text']) ? $data['text'] : "",
        ]);

        if ($request->hasFile('images')) {

            foreach ($data['images'] as $image) {
                $attachments['image'] = $this->uploadImage($image);
                $attachments['post_id'] = $item->id;
                PostImage::create($attachments);
            }
        }

        return $this->apiResponse('the post stored Successfully');

    }

    public function update(UpdatePostRequest $request)
    {
        $data = $request->validated();
        $item = Post::whereId($data['id'])->first();
        $user = auth()->user();
        if ($user->hasPermissionTo('edit post', 'web') || $user->id == $item->user_id) {

            if ($request->hasFile('images')) {
                $attachments = PostImage::wherePostId($data['id'])->get();
                foreach ($attachments as $attachment) {
                    $this->deleteImage($attachment->image);
                    $attachment->delete();
                }
                foreach ($data['images'] as $image) {
                    $attach['image'] = $this->uploadImage($image);
                    $attach['post_id'] = $item->id;
                    PostImage::create($attach);

                }
            }

            $data = Arr::except($data, ['images']);
            $item->update($data);

            $post = new PostsResource($item);


            return $this->apiResponse($post);
        } else
            return $this->notAllow();

    }

    public function delete($id)
    {
        $post = Post::whereId($id)->first();
        $user = auth()->user();

        if ($post) {
            if ($user->hasPermissionTo('delete post', 'web') || $user->id == $post->user_id) {

                foreach ($post->attachments as $attachment) {
                    $this->deleteImage($attachment->image);
                    $attachment->delete();
                }
                $post->delete();
                return $this->apiResponse("the post deleted Successfully");
            } else
                return $this->notAllow();
        } else {
            return $this->notFound();
        }

    }

    public function like($post_id)
    {

        $user = auth()->user();
        $post = Post::find($post_id);
        if ($post) {

            $exist = PostLike::where(['user_id' => $user->id, 'post_id' => $post_id])->exists();
            if ($exist) {
                PostLike::where(['user_id' => $user->id, 'post_id' => $post_id])->delete();
                return $this->apiResponse("disliked Successfully", true, false, 200);
            }
            PostLike::create(['user_id' => $user->id, 'post_id' => $post_id]);
            return $this->apiResponse("liked Successfully", true, false, 200);

        } else {
            return $this->notFound();
        }


    }

    public function likers($post_id)
    {
        if ($post_id) {
            $post = Post::find($post_id);
            if ($post) {
                $likers = $post->likers->map(function ($liker) {
                    return [
                        'user id' => $liker->id,
                        'name' => $liker->name .' '.$liker->last_name,
                        'image' => $liker->image,
                    ];
                })->toArray();
                return $this->apiResponse($likers, true, null, 200);
            } else {
                return $this->notFound();
            }

        } else {
            return $this->notFound();
        }

    }

    public function add_comment(StoreCommentRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->user()->id;
        PostComment::create($data);
        return $this->apiResponse("the comment stored successfully");
    }

    public function delete_comment($id)
    {
        $user = auth()->user();
        $comment = PostComment::find($id);
        if ($user->hasPermissionTo('delete comment', 'web') || $user->id == $comment->user_id) {
            $comment->delete();
            return $this->apiResponse("the comment deleted successfully");
        } else {
            return $this->notAllow();
        }

    }

    public function comments(int $id)
    {
        $post = Post::find($id);
        if ($post) {
            $comments = PostComment::wherePostId($id)->with('user')
                ->get()->map(function ($comment) {
                    return [
                        'id' => $comment->id,
                        'user id' => $comment->user->id,
                        'user name' => $comment->user->name ." ". $comment->user->last_name ,
                        'user image' => $comment->user->image,
                        'comment' => $comment->comment,
                    ];
                })->toArray();
            return $this->apiResponse($comments);

        }
        return $this->notFound();
    }

    public function unprocessed_posts()
    {
        $posts = Post::where(['confirmed' => false, 'reason_reject' => null])->get();
        $data = PostsResource::collection($posts);
        return $this->apiResponse($data);
    }

    public function confirm_post(int $id)
    {
        $post = Post::find($id);
        if ($post) {
            if ($post->confirmed == true || $post->reason_reject != null) {
                return $this->apiResponse(null, false, "The post has been processed before", 400);
            }

            $user = User::find($post->user_id);
            $fcm_tokens[] = $user->fcm_token;
            $users_ids[] = $user->id;

            if (!isset($fcm_tokens[0]))
                return $this->apiResponse(null, false, "the user don't have fcm_token", 460);
            $message = [
                'title' => 'Your post is accepted',
                'body' => 'Your post has been accepted and will appear on the home page',
                'type' => 'social media',
                'url' => url('api/pages/private-page/' . $user->id),

            ];
            \Notification::send(null, new FirebaseNotification($fcm_tokens, $message, $users_ids));
            $post->update([
                'confirmed' => true,
                'confirmed_at' => Carbon::now(),
                'confirmed_by' => auth()->user()->id
            ]);
            return $this->apiResponse('The post confirmed successfully and notification sent');


        }
        return $this->notFound();

    }

    public function reject_post(RejectPostRequest $request)
    {
        $data = $request->validated();
        $post = Post::find($data['id']);
        if ($post->confirmed == true || $post->reason_reject != null) {
            return $this->apiResponse(null, false, "The post has been processed before", 400);
        }
        $user = User::find($post->user_id);
        $fcm_tokens[] = $user->fcm_token;
        $users_ids[] = $user->id;
        if (!isset($fcm_tokens[0]))
            return $this->apiResponse(null, false, "the user don't have fcm_token", 500);
        $message = [
            'title' => 'Your post rejected',
            'body' => 'Your post has been rejected because of ' . $data['reason_reject'],
            'type' => 'social media',
            'url' => url('api/user/notifications'),

        ];
        \Notification::send(null, new FirebaseNotification($fcm_tokens, $message, $users_ids));
        $post->update(['confirmed' => false, 'reason_reject' => $data['reason_reject'], 'confirmed_by' => auth()->user()->id]);
        return $this->apiResponse('the post rejected successfully and notification sent');

    }

    public function updateAndConfirm(UpdatePostRequest $request)
    {
        $data = $request->validated();
        $data['confirmed'] = true;
        $data['confirmed_at'] = Carbon::now();

        $post = Post::find($data['id']);
        if ($post->confirmed == true || $post->reason_reject != null) {
            return $this->apiResponse(null, false, "The post has been processed before", 400);
        }
        if ($request->hasFile('images')) {
            $attachments = PostImage::wherePostId($data['id'])->get();
            foreach ($attachments as $attachment) {
                $this->deleteImage($attachment->image);
                $attachment->delete();
            }
            foreach ($data['images'] as $image) {
                $attach['image'] = $this->uploadImage($image);
                $attach['post_id'] = $post->id;
                PostImage::create($attach);

            }

        }

        $user = User::find($post->user_id);
        $fcm_tokens[] = $user->fcm_token;
        $users_ids[] = $user->id;
        if (!isset($fcm_tokens[0]))
            return $this->apiResponse(null, false, "the user don't have fcm_token", 500);
        $message = [
            'title' => 'Your post is accepted',
            'body' => 'Your post has been updated and accepted and will appear on the home page',
            'type' => 'social media',
            'url' => url('api/pages/private-page/' . $user->id),

        ];
        \Notification::send(null, new FirebaseNotification($fcm_tokens, $message, $users_ids));

        $data = Arr::except($data, ['images']);
        $post->update($data);
        return $this->apiResponse("the post updated and confirmed successfully");

    }

    public function home()
    {
        $posts = Post::whereConfirmed(true)->wherePrivate(false)->latest()->paginate(10);
        $nextPageUrl = $posts->nextPageUrl();
        $previousPageUrl = $posts->previousPageUrl();
        $data = PostsResource::collection($posts);
        $data = $data->toArray(request());
        $data['next_page_url'] = $nextPageUrl;
        $data['previous_page_url'] = $previousPageUrl;
        return $this->apiResponse($data);
    }

    public function setPostPrivate(int $id)
    {
        $user = auth()->user();
        $post = Post::find($id);
        if ($user->id != $post->user_id)
            return $this->notAllow();
        if ($post->private == 1) {
            $post->update(['private' => false]);
            return $this->apiResponse('The post has become public successfully');
        }
        $post->update(['private' => true]);
        return $this->apiResponse('The post has become private successfully');

    }

    public function createReportPost(StoreReportRequest $request)
    {
        $data = $request->validated();
        Report::create([
            'post_id' => $data['post_id'],
            'user_id' => auth()->user()->id,
            'message' => $data['message'],
            'type' => 'posts',
        ]);
        return $this->apiResponse('The report has been sent successfully');
    }


}
