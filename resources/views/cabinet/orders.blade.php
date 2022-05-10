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
        @if(isset($orders) && $orders != [])
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
        @else
        <tr>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
        </tr>
        @endif
        </tbody>
        <tfoot>
        </tfoot>
      </table>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
@endsection