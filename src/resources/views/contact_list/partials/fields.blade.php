<div class="form-group">
    <label class="col-sm-3 control-label">Full Name</label>
    <div class="col-sm-9">
        <input type="text" name="full_name" class="form-control" placeholder="Full Name"
               value="{{ isset($user) ? $user->full_name : '' }}">
    </div>
</div>

<div class="form-group">
    <label class="col-sm-3 control-label">Email</label>
    <div class="col-sm-9">
        <input type="email" name="email" class="form-control" placeholder="Email"
               value="{{ Request::old('email', isset($user) ? $user->email : '') }}">
        @if($errors->has('email'))
            <span class="text-danger">{{ $errors->first('email') }}</span>
        @endif
    </div>
</div>
