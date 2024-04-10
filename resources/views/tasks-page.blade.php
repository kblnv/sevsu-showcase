<div>
  @if ($selectedFlow == "")
    <x-shared.page-heading>Вы не прикреплены ни к одной дисциплине</x-shared.page-heading>
  @else
    <x-shared.select
      id="flow"
      label="Выберите дисциплину для отображения:"
      wire:model.live="selectedFlow"
    >
      <option value="" disabled>Дисциплина</option>
      @foreach ($flowsNames as $flowName)
        @if ($flowName == $selectedFlow)
          <option value="{{ $flowName }}" selected>{{ $flowName }}</option>
        @else
          <option value="{{ $flowName }}">{{ $flowName }}</option>
        @endif
      @endforeach
    </x-shared.select>

    @if (count($this->flows[$selectedFlow]["tasks"]) == 0)
      <x-shared.page-heading class="mt-8">Нет задач по выбранной дисциплине</x-shared.page-heading>
    @else
      <x-shared.page-heading class="mt-8">Банк задач по выбранной дисциплине:</x-shared.page-heading>

      <div class="mt-4 space-y-8">
        @foreach ($this->flows[$selectedFlow]["tasks"] as $task)
          <x-entities.project-card
            title="{{ $task['title'] }}"
            customer="{{ $task['customer'] }}"
            description="{{ $task['description'] }}"
            takeBefore="{{ $this->flows[$selectedFlow]['takeBefore'] }}"
            finishBefore="{{ $this->flows[$selectedFlow]['finishBefore'] }}"
            maxTeamMembers="{{ $this->flows[$selectedFlow]['maxTeamMembers'] }}"
            maxTeams="{{ $task['maxTeams'] }}"
            :tags="$task['tags']"
          />
        @endforeach
      </div>
    @endif
  @endif
</div>
