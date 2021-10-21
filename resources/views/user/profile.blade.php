@extends('layouts.main')

@section('content')
  {{ $user->name }}
  {{ $user->id }}

  {{ $Auth }}
@endsection
