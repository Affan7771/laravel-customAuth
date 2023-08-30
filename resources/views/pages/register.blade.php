@extends('layout.main')
@section('title')
    Registration page
@endsection
@section('content')
    <div class="registerForm container mt-5">
        <div class="row">
            <div class="col-sm-8">
                @auth
                    <div class="alert alert-success" role="alert">
                        You are already logged in!!
                    </div>
                @else
                    @if ($errors->any())
                        <div class="alert alert-danger" role="alert">
                            <strong>Whoops!</strong> There were some problems with your input.<br><br>
                            <ul>
                                @foreach ( $errors->all() as $error )
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form method="POST" action="{{ Route('registerUser') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="firstName" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="firstName" value="{{ old('firstName') }}" name="firstName">
                            @error('firstName')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="lastName" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="lastName" value="{{ old('lastName') }}" name="lastName">
                            @error('lastName')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}">
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="gender" class="form-label">Gender</label>
                            <div class="form-check">
                                <input class="form-check-input" value="male" type="radio" name="gender" id="gender" {{ old('gender') == 'male' ? 'checked' : '' }}>
                                <label class="form-check-label" for="gender">Male</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" value="female" name="gender" id="gender" {{ old('gender') == 'female' ? 'checked' : '' }}>
                                <label class="form-check-label" for="gender">Female</label>
                            </div>
                            @error('gender')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="country" class="form-label">Country</label>
                            <select class="form-select" name="country">
                                <option value="null">- Select Your Country -</option>
                                <option value="india" {{ old('country') == 'india' ? 'selected' : '' }}>India</option>
                                <option value="australia" {{ old('country') == 'australia' ? 'selected' : '' }}>Australia</option>
                                <option value="germany" {{ old('country') == 'germany' ? 'selected' : '' }}>Germany</option>
                            </select>
                            @error('country')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="hobbies" class="form-label">Hobbies</label>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="hobby[]" value="hobby1" @if( is_array(old('hobby')) && in_array('hobby1', old('hobby')) ) checked @endif >
                                <label class="form-check-label" for="flexCheckDefault">
                                    Hobby 1
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="hobby[]" value="hobby2" @if(is_array(old('hobby')) && in_array('hobby2', old('hobby'))) checked @endif>
                                <label class="form-check-label" for="flexCheckChecked">
                                    Hobby 2
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="hobby[]" value="hobby3" @if(is_array(old('hobby')) && in_array('hobby3', old('hobby'))) checked @endif>
                                <label class="form-check-label" for="flexCheckChecked">
                                    Hobby 3
                                </label>
                            </div>
                            @error('hobby')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password">
                            @error('password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="avatar" class="form-label">Profile Image</label>
                            <input type="file" class="form-control" id="avatar" name="avatar">
                            @error('avatar')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" name="terms" id="terms">
                            <label class="form-check-label" for="tc">Terms & Conditions</label><br>
                            @error('terms')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Register</button>
                    </form>
                @endauth
            </div>
        </div>

    </div>
@endsection
