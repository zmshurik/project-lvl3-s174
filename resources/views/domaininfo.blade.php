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
    <li class="list-group-item"><b>Code of response</b> {{ empty($domain->response_code) ? 'NA' :  $domain->response_code }}</li>
    <li class="list-group-item"><b>Content length</b> {{ empty($domain->content_length) ? 'NA' :  $domain->content_length}}</li>
    <li class="list-group-item"><b>First main header of page</b> {{ empty($domain->main_header) ? 'NA' :  $domain->main_header}}</li>
    <li class="list-group-item"><b>Keywords:</b> {{ empty($domain->meta_keywords) ? 'NA' :  $domain->meta_keywords}}</li>
  </ul>
</div>
@endsection