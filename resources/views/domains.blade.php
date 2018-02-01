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
 <p align="center">{{ $domains->links() }}</p>
@endif
@endsection