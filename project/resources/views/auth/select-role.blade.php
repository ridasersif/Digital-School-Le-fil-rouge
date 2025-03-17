@extends('layouts.auth')

@section('title', 'Choisir un rôle')

@section('content')
<div class="card auth-card">
    <div class="card-body">
        <h4>Choisissez votre rôle</h4>
        <form method="POST" action="{{ route('save-role') }}">
            @csrf
            <div class="mb-3">
                <label for="role" class="form-label">Sélectionnez votre rôle</label>
                <select class="form-select @error('role') is-invalid @enderror" id="role" name="role" >
                    <option value="" disabled selected>Sélectionnez votre rôle</option>
                    @foreach ($roles as $role)
                        @if ($role->id!=1 && $role->id!=4)
                            <option value="{{ $role->id }}" {{ old('role') == $role->id ? 'selected' : '' }}>
                                {{ $role->name }} 
                            </option>
                        @endif
                    @endforeach
                </select>
                @error('role')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Confirmer</button>
        </form>
    </div>
</div>
@endsection
