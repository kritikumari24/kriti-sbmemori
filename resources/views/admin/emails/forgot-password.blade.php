{{-- @component('mail') --}}
{{-- @component('mail:message') --}}
Hi, {{ $admin->name }}. Forgot Password ?
<p>It Happens.</p>
{{-- @component('mail:button', ['url' => url('admin/password/reset/' . $admin->remember_token)])
        Reset Password
        @endcomponent --}}
<a href="{{ url('admin/password/reset/' . $admin->remember_token) }}" class="text-white text-center btn btn-info"
    style="background-color:black;  color:white;">Reset Password</a> <br>
Thanx, <br>
{{ config('app.name') }}
{{-- @endcomponent --}}
{{-- @endcomponent --}}
