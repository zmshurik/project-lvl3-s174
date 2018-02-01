@extends('layouts.main')

@section('domains', 'active')

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
      <td>{{ $domain->name }}</td>
      <td>{{ $domain->created_at }}</td>
      <td>{{ $domain->updated_at }}</td>
    </tr>    
  @endforeach    
  </tbody>
</table>
@if(!is_array($domains))
  {{ $domains->links() }}
@endif
@endsection