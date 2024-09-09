<div class="container my-5">

    <div class="subheader py-3 py-lg-8" id="kt_subheader">
        <div class="d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center mr-1">
                <!--begin::Page Heading-->
                <div class="d-flex align-items-baseline flex-wrap mr-5">

                    <!--begin::Page Title-->
                    <h2 class="d-flex align-items-center text-dark font-weight-bold my-1 mr-3">
                        {{ __('Rocket Help Center') }}
                    </h2>
                    <!--end::Page Title-->

                </div>
                <!--end::Page Heading-->
            </div>
            <!--end::Info-->

        </div>
    </div>

    <!-- Blog Post Card -->
    <div class="card border-primary shadow-lg">
        <img src="{{ $blog->admin->avatar }}" alt="{{ $blog->admin->fname }}" class="rounded-circle me-3" width="50"
            height="50">

        <div class="card-body">
            <!-- Title and Metadata -->
            <h1 class="card-title text-primary mb-4"> {{ $blog->title_en }} </h1>
            <div class="mb-4 text-muted">
                <span>{{ __('By') }}
                    <a href="https://rocket-shm.hophearts.com/public/u/person/profile/overview/{{ Crypt::encrypt($blog->admin->id) }}"
                        class="text-primary text-decoration-none">
                        {{ $blog->admin->fname . ' ' . $blog->admin->lname }}
                    </a>
                </span>
                <span class="mx-2">• {{ __('Published on') }}
                    @if ($blog->published_at)
                        <time datetime="2024-09-09">{{ $blog->published_at?->diffForHumans() }}</time>
                    @else
                        <time datetime="2024-09-09">{{ $blog->created_at->diffForHumans() }}</time>
                    @endif
                </span>
            </div>

            <!-- Content -->
            <div class="content mb-4">
                @php
                    $parsedown = new Parsedown();
                    $blogContent = $parsedown->text($blog->content);
                @endphp

                {!! $blogContent !!}
            </div>

            <!-- Interaction Buttons -->
            <div class="d-flex justify-content-start mb-4">
                <button class="btn btn-outline-primary me-3" wire:click="addLike">
                    <svg class="bi bi-heart-fill" width="24" height="24" fill="currentColor">
                        <path
                            d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
                    </svg>
                    <span class="ms-2"> {{ __('Likes') }} </span>
                </button>

                <div class="d-flex align-items-center mx-2">
                    <svg class="bi bi-eye" width="24" height="24" fill="currentColor">
                        <path
                            d="M12 7.5a4.5 4.5 0 0 0-4.5 4.5 4.5 4.5 0 0 0 9 0A4.5 4.5 0 0 0 12 7.5zM12 15a6.5 6.5 0 0 1-6.5-6.5A6.5 6.5 0 0 1 12 2.5 6.5 6.5 0 0 1 18.5 9 6.5 6.5 0 0 1 12 15z" />
                    </svg>
                    <span class="ms-2">
                        {{ format_number_short($blog->views) }} {{ __('Views') }}
                    </span>
                </div>


                <div class="d-flex align-items-center mx-2">
                    <svg class="bi bi-eye" width="24" height="24" fill="currentColor">
                        <path
                            d="M12 7.5a4.5 4.5 0 0 0-4.5 4.5 4.5 4.5 0 0 0 9 0A4.5 4.5 0 0 0 12 7.5zM12 15a6.5 6.5 0 0 1-6.5-6.5A6.5 6.5 0 0 1 12 2.5 6.5 6.5 0 0 1 18.5 9 6.5 6.5 0 0 1 12 15z" />
                    </svg>
                    <span class="ms-2">
                        {{ format_number_short($blog->likes) }} {{ __('Likes') }}
                    </span>
                </div>
            </div>

            <!-- Comments Section -->
            <div class="border-top pt-4">
                <h3 class="h5 mb-3">Comments</h3>
                <div class="mb-4">
                    <div class="border-bottom pb-3 mb-3">
                        <p class="fw-bold mb-1">John Doe</p>
                        <p class="text-muted mb-0">This is a great blog post! Thanks for sharing.</p>
                    </div>
                    <div class="border-bottom pb-3 mb-3">
                        <p class="fw-bold mb-1">Jane Smith</p>
                        <p class="text-muted mb-0">I found this very insightful. Looking forward to more posts!</p>
                    </div>
                </div>
                <form>
                    <div class="mb-3">
                        <textarea class="form-control" rows="3" placeholder="Add a comment..."></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Post Comment</button>
                </form>
            </div>
        </div>
    </div>
</div>
