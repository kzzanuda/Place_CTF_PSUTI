@extends('layouts.main')

@section('content')
<div class="container">
  <div class="row mx-5 mt-2 px-5">
    <div class="col-12">
      <a href="#">Вернуться в меню</a>
    </div>
    <div class="col-12 mt-3">
      <h3>Добавить новую задачу</h3>
    </div>
    <div class="col-12">
      <form>
        <div class="form-group">
          <label for="exampleFormControlInput1">Название</label>
          <input type="text" name="title" class="form-control" id="nameTask">
        </div>
        <div class="form-group">
          <label for="description_short">Краткое описание</label>
          <textarea class="form-control" name="description_short" id="description_short" rows="2"></textarea>
        </div>
        <div class="form-group">
          <label for="description_full">Условие задачи</label>
          <textarea class="form-control" name="description_full" id="description_full" rows="5"></textarea>
        </div>
        <div class="form-group">
          <label for="poinst">Сложность</label>
          <select class="form-control" id="points" name="points">
            <option>1</option>
            <option>2</option>
            <option>3</option>
            <option>4</option>
            <option>5</option>
            <option>6</option>
            <option>7</option>
            <option>8</option>
            <option>9</option>
            <option>10</option>
          </select>
        </div>
        <div class="input-group">
          <div class="custom-file">
            <input type="file" class="custom-file-input" name="file" id="file" aria-describedby="inputGroupFileAddon04">
            <label class="custom-file-label" for="file">Выбрать файл</label>
          </div>
        </div>
        <button type="submit" name="button" class="btn btn-primary w-100 mt-4">Добавить задачу</button>
      </form>
    </div>
  </div>
</div>
@endsection
