@extends('layouts.main')

@section('content')
  <table class="mt-5 ml-5 mr-5" style="font-size: 16pt">
    <tr style="font-weight: bold;">
      <td class="border border-dark text-center">№</td>
      <td class="border border-dark text-center">Команда</td>
      <td class="border border-dark text-center">Почта</td>
      <td class="border border-dark text-center">Университет</td>
      <td class="border border-dark text-center">Город</td>
      <td class="border border-dark text-center">Участники</td>
      <td class="border border-dark text-center">Роль</td>
      <td class="border border-dark text-center">Почта подтверждена</td>
    </tr>
    @foreach($users as $key => $user)
      <tr>
        <td class="border border-dark text-center">{{$key + 1}}</td>
        <td class="border border-dark text-center">{{$user->name}}</td>
        <td class="border border-dark text-center">{{$user->email}}</td>
        <td class="border border-dark text-center">{{$user->university}}</td>
        <td class="border border-dark text-center">{{$user->city}}</td>
        <td class="border border-dark text-center">{{$user->members}}</td>
        <td class="border border-dark text-center">{{$user->role}}</td>
        <td class="border border-dark text-center">{{$user->email_verified_at}}</td>
      </tr>
    @endforeach
  </table>
@endsection
