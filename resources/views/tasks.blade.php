@extends("layouts.base")

@section("title")
  Банк задач
@endsection

@section("content")
  <label class="block" for="flow">Выберите поток</label>
  <select
    class="mt-2 bg-sevsu-light-gray border-2 border-gray-300 rounded-lg outline-none focus:ring-sevsu-blue focus:border-sevsu-blue p-2.5"
    id="flow"
  >
    <option value="" disabled>Поток</option>
    <option value="Веб-технологии РГР">Веб-технологии РГР</option>
    <option value="Проектирование в профессиональной сфере">
      Проектирование в профессиональной сфере
    </option>
    <option value="Курсовой проект">Курсовой проект</option>
  </select>
@endsection
