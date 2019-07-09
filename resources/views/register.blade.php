@extends('layouts.app')

@section('content')
<div class="wrapper wrapper-content  animated fadeInRight">
  <div class="row">

    <h2>Register a New Child</h2>
    <div class="col-lg-6">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Registration Information <small>Please fill in all required fields.</small></h5>
                <div class="ibox-tools">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>

                    <a class="close-link">
                        <i class="fa fa-times"></i>
                    </a>
                </div>
            </div>
            <div class="ibox-content">
                <form method="get" class="form-horizontal" action="/followup">
                    <div class="form-group"><label class="col-sm-3 control-label">MNR No</label>

                        <div class="col-sm-9"><input type="text" class="form-control"></div>
                    </div>
                    <div class="form-group"><label class="col-sm-3 control-label">MRC No</label>

                        <div class="col-sm-9"><input type="text" class="form-control"></div>
                    </div>
                    <div class="hr-line-dashed"></div>

                    <div class="form-group"><label class="col-sm-3 control-label">Sub Block Number</label>
                        <div class="col-sm-9"><input type="text" class="form-control">
                        </div>
                    </div>

                    <div class="form-group"><label class="col-sm-3 control-label">Household Number</label>
                        <div class="col-sm-9"><input type="text" class="form-control">
                        </div>
                    </div>
                    <div class="form-group"><label class="col-sm-3 control-label">Lat/Lng</label>
                        <div class="col-sm-3"><input type="text" class="form-control">
                        </div><div class="col-sm-3"><input type="text" class="form-control">
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group"><label class="col-sm-3 control-label">Family Count</label>

                        <div class="col-sm-9"><input type="text" class="form-control" name="family_count"></div>
                    </div>
                    <div class="form-group"><label class="col-sm-3 control-label">Mother's Name</label>

                        <div class="col-sm-9"><input type="text" class="form-control" name="family_count"></div>
                    </div>
                    <div class="form-group"><label class="col-sm-3 control-label">Father's Name</label>

                        <div class="col-sm-9"><input type="text" class="form-control" name="family_count"></div>
                    </div>
                    <div class="form-group"><label class="col-sm-3 control-label">Block Leader</label>
                        <div class="col-sm-9"><input type="text" class="form-control" name="family_count"></div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group"><label class="col-sm-3 control-label">Child Name</label>
                        <div class="col-sm-9"><input type="text" class="form-control" name="family_count"></div>
                    </div>
                    <div class="form-group"><label class="col-sm-3 control-label">Date of Birth</label>
                        <div class="col-sm-9"><input type="text" class="form-control" name="family_count"></div>
                    </div>
                    <div class="form-group"><label class="col-sm-3 control-label">Age</label>
                        <div class="col-sm-9"><input type="text" class="form-control" name="family_count"></div>
                    </div>
                    <div class="form-group"><label class="col-sm-3 control-label">Sex</label>
                        <div class="col-sm-9">
                          <input type="radio" name="sex" value="Male"> Male
                          <input type="radio" name="sex" value="Female"> Female
                          <input type="radio" name="sex" value="Other"> Other
                      </div>
                  </div>
                  <div class="form-group"><label class="col-sm-3 control-label">Phone</label>
                    <div class="col-sm-9"><input type="text" class="form-control" name="family_count"></div>
                </div>
                <div class="form-group"><label class="col-sm-3 control-label">Picture</label>
                    <div class="col-sm-9"><input type="file" class="form-control" name="family_count"></div>
                </div>

                <div class="form-group">
                    <div class="col-sm-4 col-sm-offset-2">

                        <button class="btn btn-primary" type="submit">Register</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
</div>
@endsection
