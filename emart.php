        @extends('admin.affiliate.master')
        
        @section('content')
        
        <?php 
        
            $user_phone = Auth::user()->phone;
            $user_type = Auth::user()->type;
            
            $get_affid = DB::table('affilate_registration')->where('mobile', $user_phone)->first();
            
            if($get_affid != null){
                $aff_id = $get_affid->aff_id;
            }
            
        $WeekDayArray = $data['WeekDayArray']; $SaleByDateArray = $data['SaleByDateArray']; 
        $monthsArray = $data['monthsArray']; $SaleByMonthArray = $data['SaleByMonthArray'];
            
        ?>
        <style>
            .card .card-body{
                margin: 0 auto;
                padding-left: 0;
                padding-right: 0;
            }
            .card-icon{
                float: left;
            }
            .card-icon i{
                font-size: 50px;
                margin-right: 10px;
            }
            .btnn {
                width: 150px;
                line-height: 40px;
                text-align: center;
                height: 40px;
                border-radius: 55px;
                background-image: linear-gradient(135deg, #FEB692 0%, #EA5455 100%);
                box-shadow: 0 20px 30px -6px rgba(238, 103, 97, 0.5);
                outline: none;
                border: none;
                cursor: pointer;
                font-size: 16px;
                color: white;
                margin-top: 20px;
            }
            a:hover {
                text-decoration: none;
            }
            .btnn:hover {
                -webkit-transform: translatey(2px);
                transform: translatey(2px);
                box-shadow: none;
            }
        </style>
        
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="row">
                <div class="col-12">
                    <div class="">
                      <div class="">
                        <div class="row">
                         
                          <div class="col-lg-3 col-md-6 mt-md-0 mt-4 grid-margin stretch-card">
                            <div class="d-flex card">
                              <div class="wrapper text_center card-body pb-0">
                                <div class="card-icon">
                                    <i class="fa fa-signal text-success"></i>
                                </div>
                                <h3 class="mb-0 font-weight-semibold counter-count">{{$data['total_revenue']}}</h3>
                                <h6 class="mb-0 font-weight-medium text-primary">Revenue</h6>
                                <a href="https://emartway.com.bd/dashboard/payment_history"><div class="btnn">Payment History</div></a>
                                
                              </div>
                              <div class="wrapper my-auto ml-auto ml-lg-4">
                                <canvas height="50" width="100" id="stats-line-graph-4"></canvas>
                              </div>
                            </div>
                          </div>
                          
                          <div class="col-lg-3 col-md-6 mt-md-0 mt-4 grid-margin stretch-card">
                            <div class="d-flex card">
                              <div class="wrapper text_center card-body pb-0">
                                 <div class="card-icon">
                                    <i class="fa fa-clock-o text-primary"></i>
                                </div>
                                <h3 class="mb-0 font-weight-semibold counter-count"><?php echo($data['total_claim']); ?></h3>
                                <h6 class="mb-0 font-weight-medium text-primary">Total Claim</h6>
                                <a href="https://emartway.com.bd/dashboard/new_claim"><div class="btnn">Pending Payments</div></a>
                                
                              </div>
                              <div class="wrapper my-auto ml-auto ml-lg-4">
                                <canvas height="50" width="100" id="stats-line-graph-4"></canvas>
                              </div>
                            </div>
                          </div>
                          
                          <div class="col-lg-3 col-md-6 mt-md-0 mt-4 grid-margin stretch-card">
                            <div class="d-flex card">
                              <div class="wrapper text_center card-body pb-0">
                                  <div class="card-icon">
                                    <i class="fa fa-refresh text-info"></i>
                                </div>
                                <h3 class="mb-0 font-weight-semibold counter-count"><?php echo($data['today_claim']); ?></h3>
                                <h6 class="mb-0 font-weight-medium text-primary">New Claim</h6>
                                <a href="https://emartway.com.bd/dashboard/new_claim"><div class="btnn">Past Claims</div></a>
                                
                              </div>
                              <div class="wrapper my-auto ml-auto ml-lg-4">
                                <canvas height="50" width="100" id="stats-line-graph-4"></canvas>
                              </div>
                            </div>
                          </div>
                          
                          <div class="col-lg-3 col-md-6 mt-md-0 mt-4 grid-margin stretch-card">
                            <div class="d-flex card">
                              <div class="wrapper text_center card-body pb-0">
                                  <div class="card-icon">
                                    <i class="fa fa-check-circle-o text-warning"></i>
                                </div>
                                <h3 class="mb-0 font-weight-semibold counter-count"><?php echo($data['active_links']); ?></h3>
                                <h5 class="mb-0 font-weight-medium text-primary">Active Links</h5>
                                <a href="https://emartway.com.bd/dashboard/allot_link"><div class="btnn">Generate Links</div></a>
                                
                              </div>
                              <div class="wrapper my-auto ml-auto ml-lg-4">
                                <canvas height="50" width="100" id="stats-line-graph-4"></canvas>
                              </div>
                            </div>
                          </div>
                          
                        </div>
                      </div>
                    </div>
                </div>
            </div>
            
            <div class="row">
              <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-header">
                      Weekly Revenue
                  </div>
                  <div class="card-body">
                    
                    
                    <div style="width:400px; height=100px"><canvas id="barChart" width=150 height=70 ></canvas></div>
                    
                  </div>
                </div>
              </div>
              <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-header">
                      Yearly Revenue
                  </div>
                  <div class="card-body d-flex flex-column">
                    <div class="wrapper">
                      
                      <div style="width:400px; height=100px"><canvas id="barChart" width=150 height=70 ></canvas></div>
                      
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
            <div class="row">
                <div class="col-12">
                    
                    <?php $products = $data['products'];?>
                    
                    <h2 style="margin: 20px 0;">Recomended Links</h2>
                    
                    <table class="table table-bordered">
                        
                        @php($i = 1)
                        
                        @foreach($products as $row)
                            
                            <tr><td>{{$i}}</td><td><img src="{{asset('images/products')}}/{{$row->image}}" style="width:70px; height: 70px;"></td>
                            <td><a target = "_blank" href="{{asset('')}}/{{$row->slug}}.html">{{$row->name}}</a></td>
                            <td>{{$row->price}}</td><td>{{$row->aff_rate}}%</td>
                                <?php if($get_affid != null && $user_type == 'affiliator'){ ?><td><input type="button" class="btn btn-primary start_affiliate" data-slug="{{$row->slug}}" data-pid="{{$row->id}}" data-affid="{{$aff_id}}" value="Start Affiliate"></td><?php } ?></tr>
                        
                            @php($i = $i + 1)
                            
                        @endforeach
                
                    </table>
                    
                </div>
            </div>

          </div>
          <!-- content-wrapper ends -->
         
        </div>
        <!-- main-panel ends -->
        
        @endsection
        
        
        @section('page-js-script')

<script type="text/javascript">

    $(document).ready(function(){
        
        $('body').on('click', '.start_affiliate', function(e){
            
            if(confirm("Want to Affiliate?")){
                
                var aff_id = $(this).attr('data-affid');
                var pid = $(this).attr('data-pid');
                var slug = $(this).attr('data-slug');
                
                var url = "https://emartway.com.bd/";
                
                link = url+slug+".html"+"?aff_id="+aff_id;
                
                var formData = new FormData();
                    
                    formData.append('aff_id', aff_id);
                    formData.append('pid', pid);
                    formData.append('link', link);
                    
                    
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    
            		$.ajax({
            		  url: "{{ URL::route('save_allot_link') }}",
                      method: 'post',
                      data: formData,
                      contentType: false,
                      cache: false,
                      processData: false,
                      dataType: "json",
            		  beforeSend: function(){
                			$("#wait").show();
                		},
            		  error: function(ts) {
                          
                          alert(ts.responseText);
                            
                            //location.reload();
                            
                          $("#wait").hide();
                           
                      },
                      success: function(data){
                        $("#wait").hide();
                          
                          //location.reload();
                          
                          alert(data);
                          
                      }
            		   
            		}); 
                
                
            }else{
                e.preventDefault();
            }
        });
        
    });


        var ctx = document.getElementById('wkSaleChart').getContext('2d');
        var data = <?=json_encode($SaleByDateArray);?>; 
        var labels = <?=json_encode($WeekDayArray);?>; 
        
        var chart = new Chart(ctx, {
            
            type: 'bar',
            
            data: {
                labels: labels,
                datasets: [{
                    label: '',
                    backgroundColor: '#00aeef',
                    borderColor: '#2c361f',
                    data: data
                }]
            },
        
            options: {
                legend: {
                    display: false
                },
                tooltips: {
                    callbacks: {
                       label: function(tooltipItem) {
                              return tooltipItem.yLabel;
                       }
                    }
                }
            }
        });
        
        var ctx = document.getElementById('moSaleChart').getContext('2d');
        var data = <?=json_encode($SaleByMonthArray);?>; 
        var labels = <?=json_encode($monthsArray);?>; 
        
        var chart = new Chart(ctx, {
            
            type: 'bar',
            
            data: {
                labels: labels,
                datasets: [{
                    label: '',
                    backgroundColor: '#00aeef',
                    borderColor: '#2c361f',
                    data: data
                }]
            },
        
            options: {
                legend: {
                    display: false
                },
                tooltips: {
                    callbacks: {
                       label: function(tooltipItem) {
                              return tooltipItem.yLabel;
                       }
                    }
                }
            }
        });

    
</script>

@stop