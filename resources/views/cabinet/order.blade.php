@extends('layouts.cabinet')

@section('content')
<div class="card">
    <div class="card-body row">
      <div class="col-7">
        <form action="{{ route('review.store') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="inputEmail">ID товара</label>
                <input type="text" id="inputEmail" name="good_id" class="form-control" value="{{ $goodId }}" readonly="readonly" />
            </div>
            <div class="form-group">
                <label for="inputEmail">Заголовок отзыва</label>
                <input type="text" id="inputEmail" name="title" class="form-control" required />
            </div>
            <div class="form-group">
                <label for="inputMessage">Текст отзыва</label>
                <textarea id="inputMessage" class="form-control" name="review" style="resize:none" cols="6" rows="7" required></textarea>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Отправить">
            </div>
        </form>
      </div>
    </div>
  </div>
@endsection