@extends('layouts.cabinet')

@section('content')
<div class="card">
    <!--<div class="card-header">
      <h3 class="card-title">DataTable with minimal features & hover style</h3>
    </div>-->
    <!-- /.card-header -->
    <div class="card-body">
      <table id="example2" class="table table-bordered table-hover">
        <thead>
        <tr>
          <th>ID товара</th>
          <th>Товар</th>
          <th>Упаковка</th>
          <th>Кол-во</th>
          <th>Дата</th>
          <th>Статус</th>
        </tr>
        </thead>
        <tbody>
          @foreach($orders as $key => $value)
            <tr>
              <td>{{ $value['good_id'] }}</td>
              <td>{{ $value['good'] }}</td>
              <td>{{ $value['pack'] }}</td>
              <td>{{ $value['quantity'] }}</td>
              <td>{{ $value['date'] }}</td>
              <td>{{ $value['status'] }}</td>
              <td><a href="{{ route('review.create', $value['good_id']) }}">Оставить отзыв</button></td>
            </tr>
          @endforeach
        </tbody>
        <tfoot>
        </tfoot>
      </table>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->

  <!--<div class="modal fade" id="review">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Напечатайте Ваш отзыв</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" id="modal-body">
          <form action="{{ route('review.store') }}" method="post">
              @csrf
              <input type="text" name="good_id" value="Товар №{{ $value['good_id'] }}" readonly="readonly"> <br>
              <textarea name="review" id="review" cols="50" rows="10" style="resize:none" required></textarea> <br>
              <div class="modal-footer justify-content-between">
                <button type="submit" class="btn btn-default">Отправить</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
              </div>
          </form>
        </div>
      </div>
    </div>
  </div>-->
  <!-- /.modal -->
@endsection