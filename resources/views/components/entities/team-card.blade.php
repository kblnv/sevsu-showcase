@props(["tags" => []])

<x-shared.card {{ $attributes }}>
  <x-shared.card.header>
    <x-shared.card.tags :tags="$tags" />
  </x-shared.card.header>

  <x-shared.card.body>
    <x-shared.card.title href="#">
      {{ $title }}
    </x-shared.card.title>

    <x-shared.card.subtitle>
      {{ $project }}
    </x-shared.card.subtitle>

    <div class="mt-4">
      <x-shared.card.text>
        {{ $description }}
      </x-shared.card.text>
    </div>
  </x-shared.card.body>

  <x-shared.card.footer class="border-t-2">
    <div class="overflow-x-auto rounded-lg border border-gray-200 text-sm">
      <table class="min-w-full divide-y-2 divide-gray-200 bg-white">
        <thead>
          <tr>
            <td class="px-4 py-2 font-bold">№</td>
            <td class="px-4 py-2 font-bold">ФИО</td>
            <td class="px-4 py-2 font-bold">Роль</td>
            <td class="px-4 py-2 font-bold">Статус</td>
          </tr>
        </thead>

        <tbody class="divide-y divide-gray-200">
          <tr>
            <td class="px-4 py-2">1</td>
            <td class="px-4 py-2">Кабалинов Максим Владимирович</td>
            <td class="px-4 py-2">Front-end разработчик</td>
            <td class="px-4 py-2">Создатель команды</td>
          </tr>

          <tr>
            <td class="px-4 py-2">2</td>
            <td class="px-4 py-2">Аракелян Сурен Рубенович</td>
            <td class="px-4 py-2">Back-end разработчик</td>
            <td class="px-4 py-2">Участник команды</td>
          </tr>

          <tr>
            <td class="px-4 py-2">3</td>
            <td class="px-4 py-2">Семенов Валентин Андреевич</td>
            <td class="px-4 py-2">Back-end разработчик</td>
            <td class="px-4 py-2">Участник команды</td>
          </tr>

          <tr>
            <td class="px-4 py-2">4</td>
            <td class="px-4 py-2">Остапович Андрей Викторович</td>
            <td class="px-4 py-2">Front-end разработчи</td>
            <td class="px-4 py-2">Участник команды</td>
          </tr>
        </tbody>
      </table>

      <div class="rounded-b-lg border-t border-gray-200 px-4 py-2">
        Участников: 4/10
      </div>
    </div>
  </x-shared.card.footer>
</x-shared.card>
