@extends('elements.base')

@section('title', 'Profile')
    
@section('content')
<div class="container mx-auto p-4">
    <h2 class="text-2xl font-bold mb-4">Profile</h2>
    <form id="updateProfileForm" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        <div class="mb-4">
            <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Name</label>
            <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="name" name="name" value="{{ Auth::user()->name }}">
        </div>
        <div class="mb-4">
            <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email</label>
            <input type="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="email" name="email" value="{{ Auth::user()->email }}">
        </div>
        <button type="button" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" id="updateProfileButton">Update Profile</button>
    </form>

    <h2 class="text-2xl font-bold mb-4">Delete Account</h2>
    <form id="deleteAccountForm" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        <div class="mb-4">
            <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Password</label>
            <input type="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="password" name="password">
        </div>
        <div class="mb-4">
            <label for="confirmPassword" class="block text-gray-700 text-sm font-bold mb-2">Confirm Password</label>
            <input type="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="confirmPassword" name="confirmPassword">
        </div>
        <button type="button" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" id="deleteAccountButton">Delete Account</button>
    </form>
</div>
@endsection

@push('scripts')
$(document).ready(function() {
    $('#updateProfileButton').click(function() {
        var name = $('#name').val();
        var email = $('#email').val();
        // Add AJAX call to update user profile
        $.ajax({
            url: '{{ route("profile.update") }}',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                name: name,
                email: email
            },
            success: function(response) {
                alert('Profile updated successfully');
            },
            error: function(response) {
                alert('Error updating profile');
            }
        });
    });

    $('#deleteAccountButton').click(function() {
        var password = $('#password').val();
        var confirmPassword = $('#confirmPassword').val();
        if (password !== confirmPassword) {
            alert('Passwords do not match');
            return;
        }
        // Add AJAX call to delete user account
        $.ajax({
            url: '{{ route("profile.destroy") }}',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                password: password
            },
            success: function(response) {
                alert('Account deleted successfully');
                window.location.href = '{{ route("home") }}';
            },
            error: function(response) {
                alert('Error deleting account');
            }
        });
    });
});
@endpush
