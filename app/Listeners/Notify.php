<?php

namespace App\Listeners;


use App\Events\Commented;
use App\Models\Comment;
use App\Models\Joke;
use App\Notifications\CommentJoke;
use App\Notifications\UpVoteComment;
use App\Notifications\UpVoteJoke;
use function GuzzleHttp\Promise\iter_for;
use Ty666\LaravelVote\Events\Voted;
use Notification;

class Notify
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  $event
     * @return void
     */
    public function handle($event)
    {
        if ($event instanceof Voted) { // 点赞
            if ($event->getType() == 'up_vote') {
                $targetModel = $event->getTargetModel();
                if ($event->getUser()->isNot($targetModel->user)) {
                    if ($targetModel instanceof Joke) {
                        // 笑话被点赞发送通知
                        Notification::send($targetModel->user, new UpVoteJoke($targetModel, $event->getUser()));
                    } elseif ($targetModel instanceof Comment) {
                        // 评论被点赞发送通知
                        Notification::send($targetModel->user, new UpVoteComment($targetModel, $event->getUser()));
                    }
                }
            }
        } elseif ($event instanceof Commented) {
            // 笑话被评论发送通知
            if ($event->user->isNot($event->joke->user))
                Notification::send($event->joke->user, new CommentJoke($event->joke, $event->user));
        }
    }
}
