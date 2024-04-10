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
  ];
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

  <x-shared.page-heading class="mt-8">Все команды по выбранной дисциплине:</x-shared.page-heading>

  <div class="mt-4 space-y-8">
    <x-entities.team-card
      title="Шенген"
      project="Витрина студенческих проектов"
      description='Команда "Шенген" занимается разработкой веб-ориентированных
      информационных систем. На данный момент является одной из лучших на
      потоке. Нам может дать бой разве что Слава.'
      maxTeamMembers="10"
      :tags="['Веб-программирование', 'Профессиональный трек']"
      :persons="$persons"
    />
  </div>
</div>
