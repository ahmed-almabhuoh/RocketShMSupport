<?php

namespace App\Livewire;

use App\Models\Blog;
use Livewire\Component;

class BlogComponent extends Component
{
    public $slug;
    public $blog;

    public function mount(string $slug)
    {
        $this->blog = Blog::where('slug', $slug)->first();

        $this->blog->views++;
        $this->blog->save();
    }

    public function addLike () {
        $this->blog->likes++;
        $this->blog->save();
    }

    public function render()
    {
        return view('livewire.blog-component', [
            'slug' => $this->slug,
        ])->title('Blog - ' . $this->blog->title_en);
    }
}
