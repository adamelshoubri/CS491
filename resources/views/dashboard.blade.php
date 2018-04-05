@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card mt-3 mb-3">
      <h4 class="card-header">Dashboard</h4>
      <div class="card-body">
          <table class="table">
              <thead>
                  <tr>
                      <th>My Surveys</th>
                  </tr>
              </thead>
              <tbody>
                  @foreach($surveys as $survey)
                      <tr>
                          <td>{{ $survey->title }}
                      </tr>
                  @endforeach
              </tbody>
          </table>
          <a class="btn btn-primary" href="{{ route('surveys.create') }}">New Survey</a>
      </div>
    </div>
</div>
@endsection
