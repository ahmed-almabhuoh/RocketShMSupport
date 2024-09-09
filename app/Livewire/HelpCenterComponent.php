<?php

namespace App\Livewire;

use App\Models\Blog;
use App\Models\CommonQuestionCategory;
use Livewire\Component;

class HelpCenterComponent extends Component
{
    protected $blogs;

    public function mount()
    {
        $this->blogs = Blog::status()->orderBy('created_at', 'desc')->paginate(10);
    }

    public function render()
    {
        return view('livewire.help-center-component', [
            'blogs' => $this->blogs,
            'categories' => CommonQuestionCategory::status()->orderBy('created_at', 'desc')->paginate(),
        ])->title('Rocket Support');
    }
}
