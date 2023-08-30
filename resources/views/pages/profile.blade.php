@extends('layout.main')
@section('title')
    Profile
@endsection

@section('content')
    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-sm-8">
                @if ( $message = Session::get('success') )
                <div class="alert alert-success" role="alert">
                    {{ $message }}
                </div>
                @endif

                <form method="POST" action="{{ Route('updateProfile') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="userId" value="{{ $userData->id }}">
                    <input type="hidden" name="oldImage" value="{{ $userData->profile_img }}">
                    <div class="mb-3">
                        <label for="firstName" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="firstName" value="{{ $userData->first_name }}" name="firstName">
                        @error('firstName')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="lastName" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="lastName" value="{{ $userData->last_name }}" name="lastName">
                        @error('lastName')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ $userData->email }}" readonly>
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="gender" class="form-label">Gender</label>
                        <div class="form-check">
                            <input class="form-check-input" value="male" type="radio" name="gender" id="gender" {{ $userData->gender == 'male' ? 'checked' : '' }}>
                            <label class="form-check-label" for="gender">Male</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" value="female" name="gender" id="gender" {{ $userData->gender == 'female' ? 'checked' : '' }}>
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
                            <option value="india" {{ $userData->country == 'india' ? 'selected' : '' }}>India</option>
                            <option value="australia" {{ $userData->country == 'australia' ? 'selected' : '' }}>Australia</option>
                            <option value="germany" {{ $userData->country == 'germany' ? 'selected' : '' }}>Germany</option>
                        </select>
                        @error('country')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        @php
                            $hobbyArr = explode(',', $userData->hobbies);
                        @endphp
                        <label for="hobbies" class="form-label">Hobbies</label>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="hobby[]" value="hobby1" @if( is_array($hobbyArr) && in_array('hobby1', $hobbyArr) ) checked @endif >
                            <label class="form-check-label" for="flexCheckDefault">
                                Hobby 1
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="hobby[]" value="hobby2" @if(is_array($hobbyArr) && in_array('hobby2', $hobbyArr)) checked @endif>
                            <label class="form-check-label" for="flexCheckChecked">
                                Hobby 2
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="hobby[]" value="hobby3" @if(is_array($hobbyArr) && in_array('hobby3', $hobbyArr)) checked @endif>
                            <label class="form-check-label" for="flexCheckChecked">
                                Hobby 3
                            </label>
                        </div>
                        @error('hobby')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="avatar" class="form-label">Profile Image</label><br>
                        <img src="{{ asset('user_images/' . $userData->profile_img) }}" class="img-thumbnail rounded" width="200px">
                        <input type="file" class="form-control" id="avatar" name="avatar">
                        @error('avatar')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
@endsection
