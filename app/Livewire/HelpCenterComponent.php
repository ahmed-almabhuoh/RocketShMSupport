<?php

namespace App\Livewire;

use App\Models\Blog;
use Livewire\Component;

class HelpCenterComponent extends Component
{
    protected $blogs;

    public function mount()
    {
        $this->blogs = Blog::status()->paginate(10);
    }

    public function render()
    {
        return view('livewire.help-center-component')->title('Rocket Support');
    }
}
