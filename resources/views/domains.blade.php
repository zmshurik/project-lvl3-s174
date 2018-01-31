@extends('layouts.main')

@section('home', '')

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
    <tr>
      <th scope="row">{{ $domain->id }}</th>
      <td>{{ $domain->name }}</td>
      <td>{{ $domain->created_at }}</td>
      <td>{{ $domain->updated_at }}</td>
    </tr>
  </tbody>
</table>  
@endsection