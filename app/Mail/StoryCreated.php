<?php

namespace App\Mail;

use App\Models\Story;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class StoryCreated extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    protected $story;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Story $story)
    {
        $this->story = $story;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.story.created', [
            'preview_url' => route('story.show', $this->story),
            'approval_url' => route('story.approve', $this->story),
        ]);
    }
}
