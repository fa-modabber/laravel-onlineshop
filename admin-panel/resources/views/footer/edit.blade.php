@extends('layout.master')
@section('title', 'Footer')
@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h4 class="fw-bold">ویرایش تنظیمات فوتر</h4>
    </div>

    <form class="row gy-4 mb-5" action="{{ route('footer.update', ['footer' => $footer->id]) }}" method="POST">
        @csrf
        @method('PUT')
        <h3>ستون اول</h3>
        <div class="col-md-3">
            <label class="form-label">عنوان</label>
            <input name="col_1_title" value="{{ $footer->col_1_title }}" class="form-control" />
            <div class="form-text text-danger">
                @error('col_1_title')
                    {{ $message }}
                @enderror
            </div>
        </div>
        <div class="col-md-3">
            <label class="form-label">متن اول</label>
            <input name="col_1_body_1" value="{{ $footer->col_1_body_1 }}" class="form-control" />
            <div class="form-text text-danger">
                @error('col_1_body_1')
                    {{ $message }}
                @enderror
            </div>
        </div>
        <div class="col-md-3">
            <label class="form-label">متن دوم</label>
            <input name="col_1_body_2" value="{{ $footer->col_1_body_2 }}" class="form-control" />
            <div class="form-text text-danger">
                @error('col_1_body_2')
                    {{ $message }}
                @enderror
            </div>
        </div>

        <hr>
        <h3>ستون دوم</h3>
        <div class="col-md-3">
            <label class="form-label">عنوان</label>
            <input name="col_2_title" value="{{ $footer->col_2_title }}" class="form-control" />
            <div class="form-text text-danger">
                @error('col_2_title')
                    {{ $message }}
                @enderror
            </div>
        </div>
        <div class="col-md-9">
            <label class="form-label">متن</label>
            <input name="col_2_body" value="{{ $footer->col_2_body }}" class="form-control" />
            <div class="form-text text-danger">
                @error('col_2_body')
                    {{ $message }}
                @enderror
            </div>
        </div>
        <div class="col-12">
            <label class="form-label">شبکه احتماعی ۱</label>
            <input name="social_media_1" value="{{ $footer->social_media_1 }}" class="form-control" />
            <div class="form-text text-danger">
                @error('social_media_1')
                    {{ $message }}
                @enderror
            </div>
        </div>
        <div class="col-12">
            <label class="form-label">شبکه احتماعی ۲</label>
            <input name="social_media_2" value="{{ $footer->social_media_2 }}" class="form-control" />
            <div class="form-text text-danger">
                @error('social_media_2')
                    {{ $message }}
                @enderror
            </div>
        </div>
        <div class="col-12">
            <label class="form-label">شبکه اجتماعی ۳</label>
            <input name="social_media_3" value="{{ $footer->social_media_3 }}" class="form-control" />
            <div class="form-text text-danger">
                @error('social_media_3')
                    {{ $message }}
                @enderror
            </div>
        </div>
        <div class="col-12">
            <label class="form-label">شبکه اجتماعی ۴</label>
            <input name="social_media_4" value="{{ $footer->social_media_4 }}" class="form-control" />
            <div class="form-text text-danger">
                @error('social_media_4')
                    {{ $message }}
                @enderror
            </div>
        </div>
        <hr>
        <h3>ستون سوم</h3>
        <div class="col-md-3">
            <label class="form-label">عنوان</label>
            <input name="col_3_title" value="{{ $footer->col_3_title }}" class="form-control" />
            <div class="form-text text-danger">
                @error('col_3_title')
                    {{ $message }}
                @enderror
            </div>
        </div>
        <div class="col-md-3">
            <label class="form-label">متن</label>
            <input name="col_3_body" value="{{ $footer->col_3_body }}" class="form-control" />
            <div class="form-text text-danger">
                @error('col_3_body')
                    {{ $message }}
                @enderror
            </div>
        </div>
        <hr>
        <div class="col-md-6">
            <label class="form-label">متن کپی رایت </label>
            <input name="copyright" value="{{ $footer->copyright }}" class="form-control" />
            <div class="form-text text-danger">
                @error('copyright')
                    {{ $message }}
                @enderror
            </div>
        </div>
        <div>
            <button type="submit" class="btn btn-outline-dark mt-3">
                ویرایش فوتر
            </button>
        </div>
    </form>
@endsection
