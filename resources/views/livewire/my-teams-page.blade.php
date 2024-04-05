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
  <h1 class="text-2xl">Все команды, в которых Вы состоите:</h1>
  <div class="mt-4 space-y-8">
    <x-entities.team-card
      :tags="['Веб-программирование', 'Профессиональный трек']"
      :persons="$persons"
      flow="Проектирование в профессиональной сфере"
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

    <x-entities.team-card
      :tags="['Веб-программирование', 'Профессиональный трек']"
      :persons="$persons"
      flow="Веб-технологии РГР"
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

    <x-entities.team-card
      :tags="['Веб-программирование', 'Профессиональный трек']"
      :persons="$persons"
      flow="Курсовой проект УД"
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
