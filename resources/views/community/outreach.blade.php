@extends('layouts.app')
@section('content')
<div class="row" style="margin-top: 20px;">
    <div class="col-md-12">
      <div class="row">
        <div class="col-lg-12">
          <div class="row">
            <div class="col-lg-3">
                <a href="{{ route('community') }}">
                    <div class="widget style1 lazur-bg">
                        <div class="row">
                            <div class="col-xs-4">
                                <i class="fa fa-plus fa-5x"></i>
                            </div>
                            <div class="col-xs-8 text-right">

                                <h2 class="font-bold">Volunteer log</h2>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3">
                <a href="{{ route('community.outreach') }}">
                    <div class="widget style1 lazur-bg">
                        <div class="row">
                            <div class="col-xs-4">
                                <i class="fa fa-plus fa-5x"></i>
                            </div>
                            <div class="col-xs-8 text-right">

                                <h2 class="font-bold">Outreach Supervisor</h2>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

          </div>
        </div>

      </div>
        <div class="row">
          <div class="col-lg-12">
              <div class="ibox">
                  <div class="ibox-title">
                      <h2>Outreach Monthly Report
                        <a href="{{ route('community.create') }}" class="pull-right">
                            <button type="button" class="btn btn-primary btn-sm btn-block"><i class="fa fa-plus"></i> Add Supervisor</button>
                        </a>
                      </h2>
                  </div>
                  <div class="ibox-content">

                      <div class="full-height-scroll">
                        <div class="table-responsive">
                            <table class="table dataTables table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Month</th>
                                        <th>Pregnant women</th>
                                        <th>0 to 6 months</th>
                                        <th>6 to 24 months</th>
                                        <th>Grandmothers</th>
                                        <th>Adolescent</th>
                                        <th>Referral</th>

                                    </tr>
                                </thead>
                                <tbody>

                                    <tr class="montly-reach">
                                        <td><a class="client-link">Manish Shrestha</a></td>
                                        <td>November 2019</td>
                                        <td>24</td>
                                        <td>22</td>
                                        <td>23</td>
                                        <td>10</td>
                                        <td>15</td>
                                        <td>5</td>

                                    </tr>
                                    <tr class="montly-reach">
                                        <td><a class="client-link">Manish Shrestha</a></td>
                                        <td>December 2019</td>
                                        <td>25</td>
                                        <td>20</td>
                                        <td>22</td>
                                        <td>12</td>
                                        <td>15</td>
                                        <td>5</td>

                                    </tr>
                                    <tr class="montly-reach">
                                        <td><a class="client-link">Manish Shrestha</a></td>
                                        <td>January 2020</td>
                                        <td>24</td>
                                        <td>22</td>
                                        <td>23</td>
                                        <td>10</td>
                                        <td>15</td>
                                        <td>5</td>

                                    </tr>
                                    <tr class="montly-reach">
                                        <td>
                                          <select name="supervisor" class="form-control">
                                            <option value>Select Supervisor</option>
                                            <option value="1">Manish Shrestha</option>
                                            <option value="2">Abu Bakr Siddique</option>
                                            <option value="3">Abid Hasan</option>
                                          </td>
                                        <td>
                                          <input type="text" id="month" name="month" class="monthPicker" />
                                        </td>
                                        <td><input type="text" name="pregnantWomen" style="width:50px" /></td>
                                        <td><input type="text" style="width:50px" /></td>
                                        <td><input type="text" style="width:50px" /></td>
                                        <td><input type="text" style="width:50px" /></td>
                                        <td><input type="text" style="width:50px" /></td>
                                        <td><input type="text" style="width:50px" />
                                          <button  class="btn btn-default btn-sm" type="button" ><i class="fa fa-plus"></i> Submit</button>

                                        </td>

                                    </tr>


                                </tbody>
                            </table>

                        </div>
                      </div>

                  </div>
              </div>
          </div>


        </div>
    </div>
</div> <!-- row -->

@endsection

@push('scripts')
<script src="{{ asset('js/plugins/datapicker/bootstrap-datepicker.js')}}"></script>
<script type="text/javascript">
$(document).ready(function()
{
$(".monthPicker").datepicker({
dateFormat: 'MM yy',
changeMonth: true,
changeYear: true,
showButtonPanel: true,

onClose: function(dateText, inst) {
var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
$(this).val($.datepicker.formatDate('MM yy', new Date(year, month, 1)));
}
});

$(".monthPicker").focus(function () {
$(".ui-datepicker-calendar").hide();
$("#ui-datepicker-div").position({
my: "center top",
at: "center bottom",
of: $(this)
});
});
});
</script>
@endpush
