@extends('layouts.app')

@section('head')
  <title>503 | Down for maintenance</title>
@endsection

@section('header-title')
  Down for maintenance
@endsection

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-4 col-md-offset-4">
      <div class="mdl-card mdl-shadow--4dp">
        <div class="mdl-card__title mdl-card--expand">
          <h2 class="mdl-card__title-text">Down for Maintenance</h2>
        </div>
        <div class="mdl-card__supporting-text">
          <strong>
            Uh oh. <br> Looks like we're down for maintenance. <br> Be back soon.
          </strong>
        </div>
        <div class="mdl-card__actions mdl-card--border">
          <button onClick="location='/'" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">
            Return to safety
          </button>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
