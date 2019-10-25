<div class="box-body">
  <div class='form-group{{ $errors->has("{$lang}.title") ? ' has-error' : '' }}'>
      {!! Form::label("{$lang}[name]", trans('iredeems::items.form.name')) !!}
      {!! Form::text("{$lang}[name]", old("{$lang}.name"), ['class' => 'form-control', 'data-slug' => 'source', 'placeholder' => trans('iredeems::items.form.name')]) !!}
      {!! $errors->first("{$lang}.name", '<span class="help-block">:message</span>') !!}
  </div>
</div>
