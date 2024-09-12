<?php

namespace App\Http\Controllers\SocialMedia;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ImageTrait;
use App\Models\Post;
use App\Models\Report;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    use ImageTrait;
    public function getRejectedPosts()
    {
        $posts = Post::whereNotNull('reason_reject')->latest()->get();
        return view('admin_panel.socialMedia.rejectedPosts', compact('posts'));
    }

    public function delete(Request $request)
    {
        $request->validate(['id' => ['required', 'exists:posts,id']]);
        $post = Post::find($request->id);
        foreach ($post->attachments as $attachment) {
            $this->deleteImage($attachment->image);
            $attachment->delete();
        }
        $post->delete();;
        $request->session()->flash('success', __('alert.alert_delete'));
        return redirect()->back();

    }


    public function getPostDetails(int $id)
    {
        $post = Post::find($id);
        return view('admin_panel.socialMedia.postDetails', compact('post'));
    }

    public function getPostsRerports()
    {
        $reports = Report::whereType('posts')->latest()->get();
        return view('admin_panel.socialMedia.postsReports', compact('reports'));
    }

    public function deleteReport(Request $request)
    {
        $request->validate(['id' => ['required', 'exists:reports,id']]);
        Report::find($request->id)->delete();
        $request->session()->flash('success', __('alert.alert_delete'));
        return redirect()->back();
    }

}
