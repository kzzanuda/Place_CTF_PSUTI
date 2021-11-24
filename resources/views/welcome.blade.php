@extends('layouts.main')

@section('content')
<div class="container my-3">
  <h2 class="my-2 mb-4">Олимпиада по информационной безопасности</h2>
  <div class="red-line">
    <p>ПГУТИ совместно с Региональным отделением ФУМО ВО ИБ в рамках реализации Федерального проекта «Информационная безопасность» национальной программы «Цифровая экономика Российской Федерации» с 24 ноября 2021 года по 26 ноября 2021 года проводит олимпиаду в области информационной безопасности среди учащихся образовательных организаций ВО и СПО.</p>
    <p>Участникам из разных городов ПФО предстоит продемонстрировать навыки решения криптографических задач, анализа и работы с сетевыми протоколами, расследования в области компьютерных преступлений, поиска различных уязвимостей информационных систем, а также навыки программирования и умение составлять алгоритмы.	В рамках олимпиады будут проведены мастер-классы от представителей ведущих организаций Приволжского федерального округа в области информационной безопасности.</p>
    <p>Олимпиада проводится в один тур в дистанционном формате.</p>
    <p>По итогам олимпиады, призеры и победители будут награждены дипломами и ценными призами. Все участники получат сертификат.</p>
    <p style="font-weight:600;">24 ноября будут проведены мастер-классы от ведущих специалистов в области ИБ.</p>
      <p>Ознакомиться с программой мероприятия можно - <a target="_blank" href="{{asset('storage/docs/progr_olymp.pdf')}}">здесь</a></p>
      <p>Telegram-чат для оперативной связи с организаторами: <a target="_blank" href="https://t.me/joinchat/Gz-JDv9hj4NmM2Qy">https://t.me/joinchat/Gz-JDv9hj4NmM2Qy</a></p>

      <h4 class="mt-5">Правила олимпиады:</h4>
      <ol>
        <li>Запрещено проводить атаки на серверы жюри и инфраструктуру Олимпиады.</li>
        <li>Запрещено генерировать неоправданно большой объем трафика.</li>
        <li>Запрещено сообщать условия задач, а также их решения, кому-либо.</li>
        <li>Необходимо указывать в ответе ход решения задачи. Иначе количество баллов за задачу будет снижено.</li>
      </ol>
  </div>
</div>
@endsection
