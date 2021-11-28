@extends('layouts_comp.main')

@section('content')
<div class="container my-3">
        <h2 class="my-2 mb-4">Соревнования по информационной безопасности</h2>
        <div class="red-line">
          <p>ПГУТИ совместно с Региональным отделением ФУМО ВО ИБ в рамках реализации Федерального проекта «Информационная безопасность» национальной программы «Цифровая экономика Российской Федерации» со 2 декабря 2021 года по 4 декабря 2021 года проводит открытые соревнования в области информационной безопасности среди учащихся образовательных организаций ВО и СПО.</p>
          <p>Соревнования проводятся в формате CTF.</p>
          <p>К участию в Соревнованиях приглашаются команды, представляющие образовательные организации ВО и СПО Приволжского федерального округа, состоящие не более чем из пяти участников.</p>
          <p>По окончании мероприятия выдаются сертификаты, подтверждающие участие в соревнованиях, дипломы за призовые места, а также подарки победителям.</p>
          <p>Регистрация, для участия в зачёте, осуществляется по ссылке:
          <a href="https://forms.gle/2f2KGSGDVgNHX2ov7">https://forms.gle/2f2KGSGDVgNHX2ov7</a></p>

          <p>Ознакомиться с программой мероприятия можно - <a target="_blank" href="{{asset('storage/docs/progr_ctf.pdf')}}">здесь</a></p>
          <p>Telegram-чат для оперативной связи с организаторами: <a target="_blank" href="https://t.me/joinchat/Rq1Rh-N7wdJmMjU6">https://t.me/joinchat/Rq1Rh-N7wdJmMjU6</a></p>
          <h3 class="mt-5">Правила соревнований</h3>
          <h5>Запрещено:</h5>
          <ol>
            <li>проводить атаки на серверы жюри и инфраструктуру Олимпиады.</li>
            <li>генерировать неоправданно большой объем трафика.</li>
            <li>сообщать условия задач, а также значения флагов, кому-либо, за исключением членов своей команды.</li>
            <li>использовать уязвимости системы приёма флагов в любых целях.</li>
            <li>вмешиваться в систему поддержки сервисов и изменять флаги, даже если организаторы не ограничили эту возможность.</li>
            <li>проводить атаки на другие команды и их участников.</li>
          </ol>
          <h5>Необходимо:</h5>
          <ol>
            <li>сообщать организаторам об ошибках в системе приёма флагов или сервисах (за что мы можем вас отблагодарить бонусными баллами).</li>
            <li>сдавать корректные флаги и получать за них очки.</li>
            <li>получать удовольствие от любимых соревнований в формате CTF! :D</li>
          </ol>
        </div>
</div>
@endsection