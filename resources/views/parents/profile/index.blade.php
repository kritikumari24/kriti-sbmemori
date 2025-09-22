@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">My Profile</div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    
                    <div class="row">
                        <div class="col-md-4">
                            <img src="{{ $user->image ?? asset('images/default-avatar.png') }}" 
                                 class="img-fluid rounded-circle" alt="Profile Picture">
                        </div>
                        <div class="col-md-8">
                            <h4>{{ $user->name }}</h4>
                            <p><strong>Email:</strong> {{ $user->email }}</p>
                            <p><strong>Mobile:</strong> {{ $user->mobile_no ?? 'Not provided' }}</p>
                            <p><strong>Role:</strong> Parent</p>
                            <p><strong>Status:</strong> 
                                <span class="badge {{ $user->is_active ? 'bg-success' : 'bg-danger' }}">
                                    {{ $user->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </p>
                            <a href="{{ route('parents.profile.edit') }}" class="btn btn-primary">Edit Profile</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection