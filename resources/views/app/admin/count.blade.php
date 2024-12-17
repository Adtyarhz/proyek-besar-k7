@extends('layouts.admin')

@section('title', 'Manage Student Count - Admin')

@section('content')
<div class="content">
  <div class="container">
    <div class="card">
      <div class="card-header d-flex justify-content-between align-items-center">
        <span>Manage Student Count</span>
      </div>
      <div class="card-body">
        {{-- Table to Display All Data --}}
        <h5 class="mb-3">Student Count Data</h5>
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>#</th>
              <th>Year</th>
              <th>Count</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($counts as $index => $data)
        <tr>
          <td>{{ $index + 1 }}</td>
          <td>{{ $data->year }}</td>
          <td>{{ $data->count }}</td>
          <td>
          <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal"
            data-bs-target="#editModal-{{ $data->id }}">
            Edit
          </button>
          </td>
        </tr>

        {{-- Edit Modal for Each Record --}}
        <div class="modal fade" id="editModal-{{ $data->id }}" tabindex="-1"
          aria-labelledby="editModalLabel-{{ $data->id }}" aria-hidden="true">
          <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="editModalLabel-{{ $data->id }}">Edit Student Count</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('updateStudentCount', $data->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="modal-body">
              <div class="form-group mb-3">
              <label for="year">Year</label>
              <input type="number" id="year" name="year" class="form-control"
                value="{{ old('year', $data->year) }}" required>
              @error('year')
          <div class="text-danger">{{ $message }}</div>
        @enderror
              </div>
              <div class="form-group mb-3">
              <label for="count">Count</label>
              <input type="number" id="count" name="count" class="form-control"
                value="{{ old('count', $data->count) }}" required>
              @error('count')
          <div class="text-danger">{{ $message }}</div>
        @enderror
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
            </form>
          </div>
          </div>
        </div>
      @empty
    <tr>
      <td colspan="4" class="text-center">No data available.</td>
    </tr>
  @endforelse
          </tbody>
        </table>

        {{-- Add New Data Form --}}
        <hr>
        <h5 class="mb-3">Add New Student Count</h5>
        <form action="{{ route('addStudentCount') }}" method="POST">
          @csrf
          <div class="form-group mb-3">
            <label for="year">Year</label>
            <input type="number" id="year" name="year" class="form-control" required>
          </div>
          <div class="form-group mb-3">
            <label for="count">Count</label>
            <input type="number" id="count" name="count" class="form-control" required>
          </div>
          <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-primary">Save</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection