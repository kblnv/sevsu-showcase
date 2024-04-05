@php
  $persons = [
    [
      "fullName" => "Кабалинов Максим Владимирович",
      "role" => "Front-end разработчик",
      "position" => "Создатель команды",
    ],
    [
      "fullName" => "Аракелян Сурен Рубенович",
      "role" => "Back-end разработчик",
      "position" => "Участник команды",
    ],
    [
      "fullName" => "Семенов Валентин Андреевич",
      "role" => "Back-end разработчик",
      "position" => "Участник команды",
    ],
    [
      "fullName" => "Остапович Андрей Викторович",
      "role" => "Front-end разработчик",
      "position" => "Участник команды",
    ],
  ]
@endphp

<div>
  <x-shared.select id="flow" label="Выберите дисциплину для отображения:">
    <option value="" disabled>Дисциплина</option>
    <option value="Веб-технологии РГР">Веб-технологии РГР</option>
    <option value="Проектирование в профессиональной сфере">
      Проектирование в профессиональной сфере
    </option>
    <option value="Курсовой проект">Курсовой проект</option>
  </x-shared.select>

  <h1 class="mt-8 text-2xl">Все команды по выбранной дисциплине:</h1>

  <div class="mt-4 space-y-8">
    <x-entities.team-card
      :tags="['Веб-программирование', 'Профессиональный трек']"
      :persons="$persons"
    >
      <x-slot:project>
        Витрина студенческих проектов
      </x-slot>
      <x-slot:title>Шенген</x-slot>
      <x-slot:description>
        Команда "Шенген" занимается разработкой веб-ориентированных
        информационных систем. На данный момент является одной из лучших на
        потоке. Нам может дать бой разве что Слава.
      </x-slot>
      <x-slot:maxTeamMembers>10</x-slot>
    </x-entities.team-card>
  </div>
</div>
