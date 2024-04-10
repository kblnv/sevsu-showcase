<div>
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

  <h1 class="mt-8 text-2xl">Банк задач по выбранной дисциплине:</h1>

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
      />
    @endforeach
  </div>
</div>
