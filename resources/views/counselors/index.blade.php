@extends('layouts.app')

@section('head')
  <title>All Counselors</title>
@endsection

@section('header-title')
  All Counselors
@endsection

@section('tray-links')

@endsection

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12 table-responsive">
      {{-- <TABLE> --}}
      <table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp">
        <thead>
          <tr>
            <th class="mdl-data-table__cell--non-numeric">Name</th>
            <th class="mdl-data-table__cell--non-numeric">Troop</th>
            <th class="mdl-data-table__cell--non-numeric">District</th>
            <th class="mdl-data-table__cell--non-numeric">Council</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($counselors as $counselor)
            <tr onClick="location='/counselors/{{ $counselor->id }}/show'">
              <td class="mdl-data-table__cell--non-numeric">{{ $counselor->name }}</td>
              <td class="mdl-data-table__cell--non-numeric">{{ $counselor->unit_num }}</td>
              <td class="mdl-data-table__cell--non-numeric">{{ $counselor->district->name }}</td>
              <td class="mdl-data-table__cell--non-numeric">{{ $counselor->district->council->name }}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
      {{-- </TABLE> --}}
			<div class="text-center">
				{{ $counselors->links() }}
			</div>
      <button onClick="location='/counselors/add'" id="add_counselor_fab" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--fab mdl-button--colored">
        <i class="material-icons">add</i>
      </button>
    </div>
  </div>
</div>
@endsection
