<?php

declare(strict_types=1);

namespace App\Console\Commands;

use Illuminate\Console\Command;

final class Welcome extends Command
{
    protected $signature = 'app:welcome';

    protected $description = 'Introduction message on installation of the starter kit';

    public function handle(): void
    {
        $orangeColor = "\x1b[33m";
        $resetColor = "\x1b[0m";

        $this->line($orangeColor.'██╗      █████╗ ██████╗  █████╗ ███╗   ███╗███████╗███╗   ██╗████████╗'.$resetColor);
        $this->line($orangeColor.'██║     ██╔══██╗██╔══██╗██╔══██╗████╗ ████║██╔════╝████╗  ██║╚══██╔══╝'.$resetColor);
        $this->line($orangeColor.'██║     ███████║██████╔╝███████║██╔████╔██║█████╗  ██╔██╗ ██║   ██║   '.$resetColor);
        $this->line($orangeColor.'██║     ██╔══██║██╔══██╗██╔══██║██║╚██╔╝██║██╔══╝  ██║╚██╗██║   ██║   '.$resetColor);
        $this->line($orangeColor.'███████╗██║  ██║██║  ██║██║  ██║██║ ╚═╝ ██║███████╗██║ ╚████║   ██║   '.$resetColor);
        $this->line($orangeColor.'╚══════╝╚═╝  ╚═╝╚═╝  ╚═╝╚═╝  ╚═╝╚═╝     ╚═╝╚══════╝╚═╝  ╚═══╝   ╚═╝   '.$resetColor);
        $this->line($orangeColor.'                                                                      '.$resetColor);
    }
}
