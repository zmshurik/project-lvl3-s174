@extends('layouts.main')

@if(!$isSingleRow)
    @section('domains', 'active')
@endif


@section('content')
<table class='table'>
<thead>
    <tr>
      <th scope="col">id</th>
      <th scope="col">domain</th>
      <th scope="col">created</th>
      <th scope="col">updated</th>
    </tr>
  </thead>
  <tbody>
  @foreach ($domains as $domain)
    <tr>
      <th scope="row">{{ $domain->id }}</th>
      <td>@if($isSingleRow)
            {{ $domain->name }}
          @else
          <a href={{ route('domains.show', ['id' => $domain->id]) }}>{{ $domain->name }}</a>
          @endif
      </td>
      <td>{{ $domain->created_at }}</td>
      <td>{{ $domain->updated_at }}</td>
    </tr>
  @endforeach
  </tbody>
</table>
@if(!$isSingleRow)
  {{ $domains->links('paginator.custom', ['paginator' => @domains]) }}
@else
<div class="container">
  <ul class="list-group text-center">
    <li class="list-group-item">Code of response <b>{{ empty($domains[0]->response_code) ? 'NA' :  $domains[0]->response_code }}</b></li>
    <li class="list-group-item">Content length <b>{{ empty($domains[0]->content_length) ? 'NA' :  $domains[0]->content_length}}</b></li>
  </ul>
</div>
@endif
@endsection