<div class="form-group">
    <label class="col-sm-3 control-label">Name</label>
    <div class="col-sm-9">
        <input type="text" name="name" class="form-control" placeholder="Name"
               value="{{ isset($user) ? $user->name : '' }}">
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

<div class="form-group">
    <label class="col-sm-3 control-label">Role</label>
    <div class="col-sm-9">
        <select name="role" class="form-control" required id="role">
            <option value="admin" {{ (isset($user) && $user->role == 'admin') ? ' selected' : '' }}>Admin</option>
            <option value="manager" {{ (isset($user) && $user->role == 'manager') ? ' selected' : '' }}>Manager</option>
            <option value="user" {{ (isset($user) && $user->role == 'user') ? ' selected' : '' }}>User</option>
        </select>
    </div>
</div>

<div class="form-group">
    <label class="col-sm-3 control-label">Category</label>
    <div class="col-sm-9">
        <select name="category" class="form-control" required>
            <option value="community" {{ (isset($user) && $user->category == 'community') ? ' selected' : '' }}>
                Community
            </option>
            <option value="facility" {{ (isset($user) && $user->category == 'facility') ? ' selected' : '' }}>Facility
            </option>
            <option value="both" {{ (isset($user) && $user->category == 'both') ? ' selected' : '' }}>Both</option>
        </select>
    </div>
</div>

    <div class="form-group">
        <label class="col-sm-3 control-label">Facility</label>
        <div class="col-sm-9">
            {{--<select name="facility_id" class="form-control" required>--}}
            <select name="facility_id" class="form-control">
                <option value="">Select Facility</option>
                @foreach($facilities as $facility)
                    <option value="{{ $facility->id }}" {{ (isset($user) && $user->facility_id == $facility->id) ? ' selected' : '' }}>{{ $facility->facility_id }}</option>
                @endforeach
            </select>
        </div>
    </div>


<div class="form-group">
    <label class="col-sm-3 control-label">Facility (Multiple for Manager only)</label>
    <div class="col-sm-9">
        <select name="mfacility_id[]" class="form-control show-tick selectpicker"
                data-live-search="true" multiple>
            <option value="">Select Facility (Multiple)</option>
            @foreach($facilities as $fac)
                <option value="{{ $fac->id }}">{{ $fac->facility_id }}</option>
            @endforeach
        </select>
    </div>
</div>


<div class="form-group">
    <label class="col-sm-3 control-label">Password</label>
    <div class="col-sm-9">
        <input type="password" name="password" class="form-control" placeholder="Password">
    </div>
</div>