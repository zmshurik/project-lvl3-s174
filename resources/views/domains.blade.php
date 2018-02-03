@extends('layouts.main')

@section('domains', 'active')



@section('content')
<table class='table'>
@include('shared.thead')
  <tbody>
  @foreach ($domains as $domain)
    <tr>
      <th scope="row">{{ $domain->id }}</th>
      <td><a href={{ route('domains.show', ['id' => $domain->id]) }}>{{ $domain->name }}</a></td>
      <td>{{ $domain->created_at }}</td>
      <td>{{ $domain->updated_at }}</td>
    </tr>
  @endforeach
  </tbody>
</table>
  {{ $domains->links('paginator.custom', ['paginator' => @domains]) }}
@endsection