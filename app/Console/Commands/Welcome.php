<?php

declare(strict_types=1);

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Override;

final class Welcome extends Command
{
    #[Override]
    protected $signature = 'app:welcome';

    #[Override]
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
