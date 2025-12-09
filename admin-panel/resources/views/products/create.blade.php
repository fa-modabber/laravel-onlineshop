@extends('layout.master')
@section('title', 'Product Create')

@section('link')
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/@majidh1/jalalidatepicker/dist/jalalidatepicker.min.css">
    <script type="text/javascript" src="https://unpkg.com/@majidh1/jalalidatepicker/dist/jalalidatepicker.min.js"></script>
@endsection

@section('script')
    <script type="text/javascript">
        document.addEventListener('alpine:init', () => {
            Alpine.data('imageViewer', () => ({
                imageUrl: '',

                fileChosen(event) {
                    if (event.target.files.length == 0) return;

                    let file = event.target.files[0];
                    let reader = new FileReader()

                    reader.readAsDataURL(file)
                    reader.onload = e => {
                        this.imageUrl = e.target.result
                    }
                }
            }))
        })
    </script>
    <script>
        jalaliDatepicker.startWatch({
            time: true
        });
    </script>
@endsection

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h4 class="fw-bold">ایجاد محصول</h4>
    </div>

    <form action="{{ route('products.store') }}" enctype="multipart/form-data" method="POST" class="row gy-4 mb-5">
        @csrf

        <div class="col-md-12 mb-5">
            <div class="row justify-content-center">
                <div class="col-md-4" x-data="imageViewer()">
                    <label class="form-label">تصویر اصلی</label>

                    <template x-if="imageUrl">
                        <img :src="imageUrl" class="rounded" width=350 height=220 alt="primary-image">
                    </template>

                    <input name="primary_image" @change="fileChosen" type="file" class="form-control mt-3" />

                    <div class="form-text text-danger">
                        @error('primary_image')
                            {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <label class="form-label">تصاویر محصول</label>
            <input name="images[]" multiple type="file" class="form-control">
        </div>
        @if ($errors->has('images.*'))
            <div class="form-text text-danger">
                @foreach ($errors->get('images.*') as $key => $messages)
                    @foreach ($messages as $message)
                        <p>{{ $message }}</p>
                    @endforeach
                @endforeach
            </div>
        @endif


        <div class="col-md-3">
            <label class="form-label">نام</label>
            <input name="name" value="{{ old('name') }}" type="text" class="form-control" />
            <div class="form-text text-danger">
                @error('name')
                    {{ $message }}
                @enderror
            </div>
        </div>

        <div class="col-md-3">
            <label class="form-label">دسته بندی</label>
            <select name="category_id" class="form-select">
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
            <div class="form-text text-danger">
                @error('category_id')
                    {{ $message }}
                @enderror
            </div>
        </div>

        <div class="col-md-3">
            <label class="form-label">وضعیت</label>
            <select name="status" class="form-select">
                <option {{ old('status') == 1 ? 'selected' : '' }} value="1">فعال</option>
                <option {{ old('status') == 0 ? 'selected' : '' }} value="0">غیر فعال</option>
            </select>
            <div class="form-text text-danger">
                @error('status')
                    {{ $message }}
                @enderror
            </div>
        </div>

        <div class="col-md-3">
            <label class="form-label">قیمت</label>
            <input type="text" name="price" value="{{ old('price') }}" class="form-control">
            <div class="form-text text-danger">
                @error('price')
                    {{ $message }}
                @enderror
            </div>
        </div>

        <div class="col-md-3">
            <label class="form-label">تعداد</label>
            <input type="text" name="quantity" value="{{ old('quantity') }}" class="form-control">
            <div class="form-text text-danger">
                @error('quantity')
                    {{ $message }}
                @enderror
            </div>
        </div>

        <div class="col-md-12">
            <label class="form-label">توضیحات</label>
            <textarea name="description" rows="5" class="form-control">{{ old('description') }}</textarea>
            <div class="form-text text-danger">
                @error('description')
                    {{ $message }}
                @enderror
            </div>
        </div>

        <hr>
        <h3>حراجی</h3>

        <div class="col-md-4">
            <label class="form-label">قیمت حراجی</label>
            <input type="text" name="sale_price" value="{{ old('sale_price') }}" class="form-control">
            <div class="form-text text-danger">
                @error('sale_price')
                    {{ $message }}
                @enderror
            </div>
        </div>

        <div class="col-md-4">
            <label class="form-label">تاریخ شروع حراجی</label>
            <input data-jdp type="text" name="sale_date_from" class="form-control">
            <div class="form-text text-danger">
                @error('sale_date_from')
                    {{ $message }}
                @enderror
            </div>
        </div>

        <div class="col-md-4">
            <label class="form-label">تاریخ پایان حراجی</label>
            <input data-jdp type="text" name="sale_date_to" class="form-control">
            <div class="form-text text-danger">
                @error('sale_date_to')
                    {{ $message }}
                @enderror
            </div>
        </div>



        <div>
            <button type="submit" class="btn btn-outline-dark mt-3">
                ایجاد محصول
            </button>
        </div>
    </form>
@endsection
