<div class="box-body">
  <div class='form-group{{ $errors->has("{$lang}.name") ? ' has-error' : '' }}'>
      {!! Form::label("{$lang}[name]", trans('iredeems::items.form.name')) !!}
      <?php $old = $item->hasTranslation($lang) ? $item->translate($lang)->name : '' ?>
      {!! Form::text("{$lang}[name]", old("{$lang}.name",$old), ['class' => 'form-control', 'placeholder' => trans('iredeems::items.form.name')]) !!}
      {!! $errors->first("{$lang}.name", '<span class="help-block">:message</span>') !!}
  </div>
</div>
