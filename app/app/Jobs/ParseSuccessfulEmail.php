<?php

namespace App\Jobs;

use App\Models\SuccessfulEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ParseSuccessfulEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $email;

    public function __construct(SuccessfulEmail $email)
    {
        $this->email = $email;
    }

    public function handle()
    {
        $content = $this->email->email;
        $parsedContent = SuccessfulEmail::parseEmail($content);

        $this->email->raw_text = $parsedContent;
        $this->email->save();
    }
}
