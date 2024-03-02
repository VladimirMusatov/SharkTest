<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Test</title>
  </head>
  <body>
    
<div class="container">

<div>
    <a href="{{route('index')}}" class="btn mt-3 btn-info">Заказать отправителя</a>
</div>

<div class="mt-3">
    @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
</div>


<div class="row mt-3">
<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Почта клиента</th>
      <th scope="col">Имя отправителя смс</th>
      <th scope="col">Статус</th>
      <th scope="col">Дата Создания</th>
      <th scope="col">Дата Обновления</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    @foreach($orders as $order)
    <tr>
      <th scope="row">{{$order->id}}</th>
      <td>{{$order->email}}</td>
      <td>{{$order->name}}</td>
      <td>{{__('main.' . $order->status )}}</td>
      <td>{{$order->created_at}}</td>
      <td>{{$order->updated_at}}</td>
      <td>
        @if($order->status == 'new')
        <a href="{{route('accept', $order->id)}}" class="btn btn-success">Подтвердить</a>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#staticBackdrop_{{$order->id}}">
                Отказать
            </button>

            <!-- Modal -->
            <div class="modal fade" id="staticBackdrop_{{$order->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{route('decline')}}" id="decline_order_{{$order->id}}">
                        @csrf
                        <input type="hidden" name="id" value="{{$order->id}}">
                        <label for="exampleFormControlTextarea1" class="form-label">Причина отказа</label>
                        <textarea name="text" class="form-control"></textarea>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                    <button type="submit" form="decline_order_{{$order->id}}" class="btn btn-primary">Отказать</button>
                </div>
                </div>
            </div>
            </div>

        @endif
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
</div>
        
</div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>