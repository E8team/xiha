<?php

namespace App\Http\Controllers\API;

use App\Events\Commented;
use App\Events\CreatedJoke;
use App\Http\Controllers\APIController;
use App\Http\Requests\CommentRequest;
use App\Http\Requests\JokeRequest;
use App\Http\Resources\CommentCollection;
use App\Http\Resources\CommentResource;
use App\Http\Resources\JokeCollection;
use App\Http\Resources\JokeResource;
use App\Models\Joke;
use Illuminate\Http\Request;
use Ty666\LaravelVote\Contracts\VoteController;
use Ty666\LaravelVote\Traits\VoteControllerHelper;

class JokesController extends APIController implements VoteController
{
    use VoteControllerHelper;

    protected $resourceClass = Joke::class;

    public function __construct()
    {
        $this->middleware('auth')->except('index', 'show', 'showComments');
    }

    public function index(Request $request)
    {
        $query = Joke::latest();
        if ($request->has('last_id'))
            $query->where('id', '>', intval($request->get('last_id')));
        $jokes = $query->with('image', 'user', 'user.avatar')->paginate($this->perPage());
        return new JokeCollection($jokes);
    }

    public function show(Joke $joke)
    {
        $joke->load('user', 'user.avatar');
        if ($joke->image_hash) {
            $joke->load('image');
        }
        return new JokeResource($joke);
    }

    public function store(JokeRequest $request)
    {
        $data = $request->validated();
        $data['content'] = isset($data['content']) ? e($data['content']) : '';
        $data['user_id'] = auth()->id();
        $joke = Joke::create($data)->load('image');
        $joke->comments_count = 0;
        $joke->up_votes_count = 0;
        event(new CreatedJoke($joke, auth()->user()));
        return new JokeResource($joke);
    }

    public function storeComment(Joke $joke, CommentRequest $request)
    {
        $data = $request->validated();
        $data['content'] = e($data['content']);
        $data['user_id'] = auth()->id();
        $comment = $joke->comments()->create($data);
        $comment->up_votes_count = 0;
        event(new Commented($comment, $joke, auth()->user()));
        return new CommentResource($comment);
    }

    public function showComments(Joke $joke)
    {
        $comments = $joke->comments()->latest()->with('user', 'user.avatar')->paginate($this->perPage());
        return new CommentCollection($comments);
    }
}
