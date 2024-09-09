<?php

namespace App\Livewire;

use App\Models\Blog;
use App\Models\CommonQuestion;
use App\Models\CommonQuestionCategory;
use Livewire\Component;

class HelpCenterComponent extends Component
{
    protected $blogs;
    protected $questions;
    public $selectedCategory;

    public function mount()
    {
        $this->blogs = Blog::status()->orderBy('created_at', 'desc')->paginate(10);

        $catId = CommonQuestionCategory::status()->orderBy('created_at', 'desc')->first()->id;
        $this->questions = CommonQuestion::whereHas('category', function ($query) use ($catId) {
            $query->where('id', $catId);
        })->get();
    }

    public function getQuestions($categoryId)
    {
        $this->questions = CommonQuestion::whereHas('category', function ($query) use ($categoryId) {
            $query->where('id', $categoryId);
        })->get();
    }

    public function render()
    {
        return view('livewire.help-center-component', [
            'blogs' => $this->blogs,
            'categories' => CommonQuestionCategory::status()->orderBy('created_at', 'desc')->paginate(),
            'questions' => $this->questions,
        ])->title('Rocket Support');
    }
}
