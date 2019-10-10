@extends('layouts.app')

@section('content')

<h2></h2>

<div class="row">
        <div class="col-sm-12">
            <div class="ibox">
                
                <div class="ibox-content">                    
                    <div class="text-center">
                        <img src="img/logo-1.gif" class="pull-left" height="70px" />
                        <img src="img/logo-2.gif" height="80px"/>
                        <img src="img/logo-nutrition.png" class="pull-right" height="60px" />
                    </div>
                    <div class="clients-list">
                        <table class="table table-marginless table-striped table-bordered table-hover">
                            <thead>
                                <th class="text-center">OUT Patient Therapeutic Program (OTP) Monthly Report</th>
                            </thead>
                        </table>
                        <table class="table table-marginless table-bordered table-hover">
                            <tbody>
                                <tr>
                                    <td>OTP ID: </td>
                                    <td>Following Expanded Criteria: </td>
                                    <td>Name of Camp: </td>
                                </tr>
                                <tr>
                                    <td>OTP Name: </td>
                                    <td>Program Partner: </td>
                                    <td>Month/Year: </td>
                                </tr>
                                <tr>
                                    <td>Report prepared by: </td>
                                    <td>Organization: </td>
                                    <td>Reporting Duration: </td>
                                </tr>
                            </tbody>
                        </table>
                         <table class="table table-striped table-bordered table-hover dataTables-example x-small small" >
                    <thead>
                    <tr>
                        <th rowspan="3">Age Group</th>
                        <th rowspan="2" colspan="3">Total In Care Begining of month [A]</th>
                        <th rowspan="1" colspan="8">New Enrollment [B]</th>
                        <th rowspan="2" colspan="3">Total New Enrollment</th>
                        <th rowspan="1" colspan="8">Transfer In [C]</th>
                        <th rowspan="2" colspan="3">Total Transfer In [C1+C2+C3+C4]</th>
                        <th rowspan="2" colspan="3">Total Enrollment [D=B+C]</th>
                    </tr>
                    <tr>
                        <th colspan="2">MUAC &lt; 11.5cm(B1)</th>
                        <th colspan="2">WFH &lt; -3SD (B2)</th>
                        <th colspan="2">Edema (B3)</th>
                        <th colspan="2">Relapse (B4)</th>
                        
                        <th colspan="2">Return after Default (C1)</th>
                        <th colspan="2">Transfer in from TSFP (C2)</th>
                        <th colspan="2">Transfer in from SC (C3)</th>
                        <th colspan="2">Transfer from other OTP (C4)</th>
                    </tr>
                    <tr>
                        <!-- Total in Care begining of month A -->
                        <th>M</th>
                        <th>F</th>
                        <th>T</th>
                        
                        <!-- B1 -->
                        <th>M</th>
                        <th>F</th>
                        
                        <!-- B2 -->
                        <th>M</th>
                        <th>F</th>
                        
                        <!-- B3 -->
                        <th>M</th>
                        <th>F</th>
                        
                        <!-- B4 -->
                        <th>M</th>
                        <th>F</th>
                        
                        <!-- Total new enrollment -->
                        <th>M</th>
                        <th>F</th>
                        <th>T</th>
                        
                        <!-- C1 -->
                        <th>M</th>
                        <th>F</th>
                        
                        <!-- C2 -->
                        <th>M</th>
                        <th>F</th>
                        
                        <!-- C3 -->
                        <th>M</th>
                        <th>F</th>
                        
                        <!-- C4 -->
                        <th>M</th>
                        <th>F</th>
                        
                        <!-- Total Transfer In -->
                        <th>M</th>
                        <th>F</th>
                        <th>T</th>
                        
                        <!-- This is for D Total Enrollment -->
                        <th>M</th>
                        <th>F</th>
                        <th>T</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr class="gradeX">
                        <td>6-23 mnths</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>1</td>
                        <td>1</td>
                        <td>0</td>
                        <td>1</td>
                        <td>1</td>
                        <td>0</td>
                        <td>1</td>
                        <td>1</td>
                        
                    </tr>
                    <tr class="gradeX">
                        <td>24-59 mnths</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>1</td>
                        <td>1</td>
                        <td>0</td>
                        <td>1</td>
                        <td>1</td>
                        <td>0</td>
                        <td>1</td>
                        <td>1</td>
                        
                    </tr>
                    <tr class="gradeX">
                        <td>> 5 yrs</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>1</td>
                        <td>1</td>
                        <td>0</td>
                        <td>1</td>
                        <td>1</td>
                        <td>0</td>
                        <td>1</td>
                        <td>1</td>
                        
                    </tr>
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>Total</th>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>1</td>
                        <td>1</td>
                        <td>0</td>
                        <td>1</td>
                        <td>1</td>
                        <td>0</td>
                        <td>1</td>
                        <td>1</td>
                    </tr>
                    </tfoot>
                    </table>
                        
                        

                        
                            
                                <div class="full-height-scroll">
                  
                                    
                                </div>
                            
                        
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- row -->
@endsection

@push('scripts')

    
    <script src="js/plugins/dataTables/datatables.min.js"></script>

  
<script>
    
    $(document).ready(function() {
            
    });
    
</script>
@endpush