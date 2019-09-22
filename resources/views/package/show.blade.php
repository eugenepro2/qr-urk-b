@extends('layouts.app')

@section('content')
  <div class="container">
      <div class="form-group">
        <label>Название посылки</label>
        <input disabled type="text" class="form-control" value="{{$package->name}}">
      </div>
      <div class="form-group">
        <label>С какого проекта?</label>
        <input disabled type="text" class="form-control" value="{{$package->fromProject['name']}}">
      </div>
      <div class="form-group">
        <label>На какой проект?</label>
        <input disabled type="text" class="form-control" value="{{$package->toProject['name']}}">
      </div>
      <div class="card mb-4">
        <div class="card-body">
          <h5 class="card-title">Добавить товары к посылке</h5>
          <form method="POST" action="{{route('items.store')}}">
            @csrf
            <input type="hidden" name="packages_id" value="{{$package->id}}">
            <div class="form-group">
              <label for="name">Название материала(item)</label>
              <input id="name" name="name" type="text" class="form-control" placeholder="Введите название материала">
            </div>
            <div class="form-group">
              <label for="count">Количество</label>
              <input id="count" name="count" type="text" class="form-control" placeholder="Введите количество">
            </div>
            <button type="submit" class="btn btn-primary">Добавить</button>
          </form>
          <table class="table mt-2">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Наименование</th>
                  <th scope="col">Количество</th>
                  <th scope="col"></th>
                </tr>
              </thead>
              <tbody>
                @foreach ($items as $indexKey => $item)
                  <tr>
                    <th scope="row">{{$indexKey+1}}</th>
                    <td>{{$item->name}}</td>
                    <td>{{$item->count}}</td>
                    <td>
                      <form method="POST" action="{{route('items.destroy', $item->id)}}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Удалить</button>
                      </form>
                    </td>
                  </tr>    
                @endforeach
              </tbody>
            </table>
        </div>
      </div>
      <div class="qr">
          <img src="{{asset('storage/20-qr.svg')}}" alt="">
      </div>
      <a href="{{route('package.edit', $package->id)}}" class="btn btn-primary">Редактировать</a>
  </div>
@endsection