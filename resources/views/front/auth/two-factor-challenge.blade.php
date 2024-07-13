<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('two-factor.login') }}">
        @csrf
        @if($errors->has('code'))
            <div class="alert alert-danger">
                {{$errors->first('code')}}
            </div>
        @endif
        <div class="form-group input-group">
            <label for="">Two Factor Code</label>
            <input type="text" name="code" >
        </div>
        <div class="form-group input-group">
            <label for="">Recovery Code</label>
            <input type="text" name="recovery_code" >
        </div>

        <div class="button">
            <button class="btn" type="submit">Submit</button>
        </div>
    </form>
</x-guest-layout>
