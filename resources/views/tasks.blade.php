<x-layouts.base title="Банк задач">
  <x-shared.select id="flow" label="Выберите дисциплину для отображения:">
    <option value="" disabled>Дисциплина</option>
    <option value="Веб-технологии РГР">Веб-технологии РГР</option>
    <option value="Проектирование в профессиональной сфере">
      Проектирование в профессиональной сфере
    </option>
    <option value="Курсовой проект">Курсовой проект</option>
  </x-shared.select>

  <h1 class="text-2xl mt-8">Банк задач по выбранной дисциплине:</h1>

  <div class="mt-4 space-y-8">
    <x-entities.project-card
      :tags="['Веб-программирование', 'Профессиональный трек']"
    >
      <x-slot:title>
        Витрина студенческих проектов
      </x-slot>
      <x-slot:customer>СевГУ</x-slot>
      <x-slot:description>
        Витрина должны быть реализована как web-сайт, позволяющий: -
        Аутентифицироваться через СевГУ.Аккаунт; - Публиковать задачи для
        решения студенческими командами (банк задач); - Публиковать проекты
        студенческих команд, указывать их подробную информацию и теги; -
        Создавать студенческие команды, открывать в них вакансии и собирать
        команды на этапе командообразования; - Администратору настраивать
        периоды командообразования, права доступа к созданию задач, проектов и
        команд, получать сводную аналитическую информацию по проектам (по типам,
        институтам, курсам, технологиям). Витрина должна использовать фирменный
        стиль СевГУ.
      </x-slot>

      <x-slot:takeBefore>20 февраля 2024 года</x-slot>
      <x-slot:finishBefore>7 июня 2024 года</x-slot>
      <x-slot:maxTeamMembers>4</x-slot>
      <x-slot:maxTeams>15</x-slot>
    </x-entities.project-card>

    <x-entities.project-card :tags="['VR', 'Профессиональный трек']">
      <x-slot:title>
        Дополненная реальность в ЦГТИ
      </x-slot>
      <x-slot:customer>Литкомс - 1</x-slot>
      <x-slot:description>
        Приложение 'Дополненная реальность в ЦГТИ/Литкомс'. Идея заключается в
        том, чтобы в Центре гуманитанно-технической информации/комикс-центре
        Литкомс - были добавлены в пространство элементы Дополненной реальности,
        которые в экспериментально-игровой форме раскрывали бы особенности,
        историю учреждения, 'проводили экскурсию' по нескольким локациям ЦГТИ.
        Например, возможным появлением на экране гаджета посетителя
        оригинального персонажа, который берёт на себя роль ведущего и
        рассказчика. И, возможно, вовлекающего в подобие игры (разработка
        геймплейной состовляющей) превращая зрителя из пассивного наблюдателя -
        в меру активного участника события. Подчёркивая научно-технические
        особенности данного учреждения, рассказывая о мероприятиях, которые
        здесь регулярно проходят, а также погружая в особенности истории
        появления такой сферы в науке и искусстве, как Дополненная реальность,
        что несомненно будет популяризировать данное явление в виде воплощённого
        проекта в интерьерах действующего государственного заведения - Центра
        гуманитарно-технической информации, библиотеки-филиала N5 для взрослых,
        и интегрированной в неё первой в Севастополе Библиотеке Комиксов -
        Читальном зале комикса и графической литературы, которые посещает
        большое количество читателей, участников перформансов и посетителей
        выставок. На данный момент ЦГТИ и комикс-центр являются пространством, в
        котором уже используются элементы Дополненной реальности в виде
        постоянной настенной и напольной экспозиций. Что вызывает большой
        резонанс у публики и есть идея создать действующий проект на нашей базе,
        как партнёра, силами активных студентов СевГУ, представляющими
        дисциплину AR, возможно в сотрудничестве с нашими художниками, что по
        идее должно хорошо отразиться на имиджевой составляющей начинающих
        специалистов, представляющих область деятельности 'Дополненная
        реальность' и 'Разработка компьютерных игр'.
      </x-slot>

      <x-slot:takeBefore>20 февраля 2024 года</x-slot>
      <x-slot:finishBefore>7 июня 2024 года</x-slot>
      <x-slot:maxTeamMembers>4</x-slot>
      <x-slot:maxTeams>15</x-slot>
    </x-entities.project-card>
  </div>
</x-layouts.base>
