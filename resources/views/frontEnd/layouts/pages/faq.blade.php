@extends('frontEnd.layouts.master')
@section('title', $generalsetting->meta_title)
@section('content')
    <!-- PAGE TITLE START -->
    <section class="custom-breadcrumb">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title">
                        <h2>Frequently Asked Questions</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- PAGE TITLE END -->


    <div class="faq_main_container">
        <div class="container">
            @foreach ($faqs as $key => $value)
                <div class="faq_container">
                    <div class="faq_question">
                        <div class="faq_question-text">
                            <h3>{{ $value->question }}</h3>
                        </div>
                        <div class="icon">
                            <div class="icon-shape"></div>
                        </div>
                    </div>
                    <div class="answercont">
                        <div class="answer">
                            <p>
                                {!! $value->answer !!}
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>


@endsection

@push('script')
    <script>
        let questions = document.querySelectorAll(".faq_question");

        questions.forEach((question) => {
            let icon = question.querySelector(".icon-shape");

            question.addEventListener("click", (event) => {
                const active = document.querySelector(".faq_question.active");
                const activeIcon = document.querySelector(".icon-shape.active");

                if (active && active !== question) {
                    active.classList.toggle("active");
                    activeIcon.classList.toggle("active");
                    active.nextElementSibling.style.maxHeight = 0;
                }

                question.classList.toggle("active");
                icon.classList.toggle("active");

                const answer = question.nextElementSibling;

                if (question.classList.contains("active")) {
                    answer.style.maxHeight = answer.scrollHeight + "px";
                } else {
                    answer.style.maxHeight = 0;
                }
            });
        });
    </script>
@endpush
