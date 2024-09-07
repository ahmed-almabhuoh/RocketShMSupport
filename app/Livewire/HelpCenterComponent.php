<?php

namespace App\Livewire;

use Livewire\Component;

class HelpCenterComponent extends Component
{
    public function render()
    {
        return view('livewire.help-center-component')->title('Rocket Support');
    }
}
