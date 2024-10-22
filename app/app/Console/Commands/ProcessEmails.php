<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\SuccessfulEmail;
use App\Jobs\ParseSuccessfulEmail;

class ProcessEmails extends Command
{
    protected $signature = 'emails:process';
    protected $description = 'Parse emails to get raw text';

    public function handle()
    {
        // Busca e-mails não processados
        $emails = SuccessfulEmail::where('raw_text', null)->get();

        foreach ($emails as $email) {
            // Enfileira cada job para ser processado
            ParseSuccessfulEmail::dispatch($email);
            $this->info("Parsed email ID: {$email->id}.");
        }

        $this->info('Sended emails to parser.');
    }
}
