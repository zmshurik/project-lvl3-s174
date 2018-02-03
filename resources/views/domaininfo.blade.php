@extends('layouts.main')

@section('content')
<table class='table'>
@include('shared.thead')
  <tbody>  
    <tr>
    <th scope="row">{{ $domain->id }}</th>
      <td>{{ $domain->name }}</td>
      <td>{{ $domain->created_at }}</td>
      <td>{{ $domain->updated_at }}</td>
    </tr>  
  </tbody>
</table>
<div class="container">
  <ul class="list-group text-center">
    <li class="list-group-item">Code of response <b>{{ empty($domain->response_code) ? 'NA' :  $domain->response_code }}</b></li>
    <li class="list-group-item">Content length <b>{{ empty($domain->content_length) ? 'NA' :  $domain->content_length}}</b></li>
  </ul>
</div>
@endsection