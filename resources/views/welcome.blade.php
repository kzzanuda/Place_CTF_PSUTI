@extends('layouts.main')

@section('content')
<div class="container my-3">
  <div class="row">
    <div class="col-12 col-md-3 col-xl-3" style="display: block;margin: auto;text-align: center;">
      <img class="logo-welcome" src="{{asset('storage/logo-psuti.png')}}" alt="">
    </div>
    <div class="col-12 col-md-6 col-xl-6">
      <h2 class="mt-2">Олимпиада по информационной безопасности</h2>
      <h1 class="mb-4">КиберПГУТИ 2022</h1>
    </div>
    <div class="col-12 col-md-3 col-xl-3" style="
    display: block;
    margin: auto;
    ">
      <img class="logo-welcome" src="{{asset('storage/logo-poligon.png')}}" alt="">
    </div>
  </div>

  <div class="red-line">
    <p>Федеральное государственное бюджетное образовательное учреждение высшего образования «Поволжский государственный университет телекоммуникаций и информатики» (ПГУТИ) совместно с
Региональным отделением ФУМО ВО по укрупненной группе специальностей и направлений подготовки 10.00.00 «Информационная безопасность» Приволжского федерального округа (РО ФУМО ВО ИБ по ПФО) и Национальным киберполигоном в рамках реализации Федерального проекта «Информационная безопасность» национальной программы «Цифровая экономика Российской Федерации» <b>с 14 по 15 апреля 2022 года</b> проводит отборочный тур олимпиады <b>«КиберПГУТИ 2022»</b> в области информационной безопасности среди учащихся образовательных организаций высшего профессионального образования.</p>
    <p>Для прохождения в финальный этап участникам предстоит пройти квест по тематике информационной безопасности, продемонстрировать навыки анализа и работы с сетевыми протоколами, расследования в области компьютерных преступлений, поиска различных уязвимостей информационных систем, а также навыки программирования и умение составлять алгоритмы. Финальные соревнования пройдут <b>28-29 апреля</b> в формате киберучений на <b>Национальном киберполигоне</b>.</p>
    <p>Победители и призеры финального этапа олимпиады допускаются к участию во Всероссийских киберучениях <b>«OpenBonch 2022»</b>, проведение которых запланировано на <b>октябрь 2022 года</b> в г. Санкт-Петербург на базе СПбГУТ.</p>
    {{--<p>По итогам Олимпиады призеры и победители будут награждены дипломами и ценными призами, участники - сертификатами участия.</p>--}}

      <p>Ознакомиться с программой мероприятия можно - <a target="_blank" href="{{asset('storage/docs/progr_olymp2022.pdf')}}">здесь</a></p>
      <p>Telegram-чат для оперативной связи с организаторами: <a target="_blank" href="https://t.me/+P1G5DWzFkzJkYTQ6">https://t.me/+P1G5DWzFkzJkYTQ6</a></p>

      <h4 class="mt-3">Правила олимпиады:</h4>
      <ol>
        <li>Запрещено проводить атаки на серверы жюри и инфраструктуру Олимпиады.</li>
        <li>Запрещено генерировать неоправданно большой объем трафика.</li>
        <li>Запрещено сообщать условия задач, а также их решения, кому-либо, кроме участников своей команды.</li>
        {{--<li>Необходимо указывать в ответе ход решения задачи. Иначе количество баллов за задачу будет снижено.</li>--}}
      </ol>

      <h5 class="mt-3">Принять участие в региональном этапе КиберПГУТИ 2022 могут учащиеся Приволжского федерального округа, Южного федерального округа и  Северо-Кавказского федерального округа. Студенты других регионов приглашаются к участию в олимпиадах, проводимых:</h5>
      <ul>
        <li>Московским техническим университетом связи и информатики (МТУСИ) - Центральный федеральный округ,</li>
        <li>Санкт-Петербургским государственным университетом телекоммуникаций им. проф. М. А. Бонч-Бруевича  (СПбГУТ) - Северо-Западный федеральный округ,</li>
        <li>Сибирским государственным университетом телекоммуникаций и информатики  (СибГУТИ) -Дальневосточный федеральный округ, Сибирский федеральный округ, Уральский федеральный округ.</li>
      </ul>
  </div>
</div>
@endsection
