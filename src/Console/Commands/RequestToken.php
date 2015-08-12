<?php namespace Upwebdesign\Grovo\Console\Commands;

/**
 * This file is part of Upwebdesign\Grovo,
 * a Laravel package to integrate with Grovo
 *
 * @license MIT
 * @package Upwebdesign\Grovo
 */

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;
use Upwebdesign\Grovo\Api\Token;

class RequestToken extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'grovo:requestToken';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command used to generate a Grovo token';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(Token $token)
    {
        $this->comment('The config/grovo.php config file has been updated with new token:');
        $this->comment(sprintf('Token: %s', $token->getToken()));
    }
}
