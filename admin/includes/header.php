
<style>
	.navbar-header a{
		/margin-left:20px;
	}
	#menuToggle i{
		height:40px;
		width:40px;
		/border:1px solid red;
		text-align:center;
		line-heigth:10px;
		border-radius:50%;
		padding:10px 10px;	
		font-size:20px;
	}
	#menuToggle i{
		line-heigth:20px;
	}
	#menuToggle i:hover{
		/border-radius:50%;
		transistion: background 3s;
		background:rgba(0,0,0,0.07);
	}
	.user-avatar:hover {
		border:3px solid rgba(0,0,0,0.07);
	}
</style>
	<?php
	error_reporting(E_ALL);
	include('../includes/dbconnection.php');
	$staffId = $_SESSION['staffId'];
	//$img= $_SESSION['img'];
	$query = mysqli_query($con,"select * from tbladmin where staffId='$staffId'");
    $rows = mysqli_fetch_array($query);
	//$sql = "SELECT `img` FROM `tbladmin` WHERE `staffid`='".$staffId."'";
	//$query= mysqli_query($con,$sql);
	$photo=trim($rows['img']);
	$photo=($photo!='')?$photo:'../img/user.jpg';
	?>
 <header id="header" class="header">
            <div class="top-left">
				<?php 
					//if($photo!=''){echo '../'.$photo;}else{echo '../img/user.jpg';}
					//echo $photo;
				?>
                <div class="navbar-header" style="padding:5px 5px;width:500px;height:54px;margin:0px -20px;">
					<a id="menuToggle" class="menutoggle"><i class="fa fa-bars"></i></a>
					<a class="navbar-brand" style="color:rgb(69,69,69);"href="./"><img style="margin-top:-12px;" height="40px" width="30px" 
					src="../img/philsca-official-logo.png" alt="Logo">
                    Student Information Management System</a>
                </div>
            </div>
            <div class="top-right">
                <div class="header-menu">
                    <div class="header-left">
                        <!-- <button class="search-trigger"><i class="fa fa-search"></i></button> -->
                        <div class="form-inline">
                            <form class="search-form">
                                <input class="form-control mr-sm-2" type="text" placeholder="Search ..."
                                    aria-label="Search">
                                <button class="search-close" type="submit"><i class="fa fa-close"></i></button>
                            </form>
                        </div>

                    <div class="user-area dropdown float-right">
                        <a href="#" class="dropdown-toggle active" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            <img width="40px" height="40px" class="user-avatar rounded-circle" 
							src="<?php echo ''.$photo;?>"
							alt="User Avatar" style="border-radius:50%;">
                            <!-- <img class="user-avatar rounded-circle" src="../images/logo.jpeg" alt="User Avatar"> -->
                        </a>

                        <div class="user-menu dropdown-menu">
                            <a class="nav-link" href="viewProfile.php"><i class="fa fa-user"></i>My Profile</a>
                             <a class="nav-link" href="changePassword.php"><i class="fa fa-cog"></i>Change Password</a>
                            <a class="nav-link" href="logout.php"><i class="fa fa-power-off"></i>Logout</a>
                        </div>
                    </div>

                </div>
            </div>
            
        </header>

        <script src="../assets/js/main.js"></script>
   <script>
        jQuery(document).ready(function ($) {
            "use strict";

            // Pie chart flotPie1
            var piedata = [
                { label: "Desktop visits", data: [[1, 32]], color: '#5c6bc0' },
                { label: "Tab visits", data: [[1, 33]], color: '#ef5350' },
                { label: "Mobile visits", data: [[1, 35]], color: '#66bb6a' }
            ];

            $.plot('#flotPie1', piedata, {
                series: {
                    pie: {
                        show: true,
                        radius: 1,
                        innerRadius: 0.65,
                        label: {
                            show: true,
                            radius: 2 / 3,
                            threshold: 1
                        },
                        stroke: {
                            width: 0
                        }
                    }
                },
                grid: {
                    hoverable: true,
                    clickable: true
                }
            });
            // Pie chart flotPie1  End
            // cellPaiChart
            var cellPaiChart = [
                { label: "Direct Sell", data: [[1, 65]], color: '#5b83de' },
                { label: "Channel Sell", data: [[1, 35]], color: '#00bfa5' }
            ];
            $.plot('#cellPaiChart', cellPaiChart, {
                series: {
                    pie: {
                        show: true,
                        stroke: {
                            width: 0
                        }
                    }
                },
                legend: {
                    show: false
                }, grid: {
                    hoverable: true,
                    clickable: true
                }

            });
            // cellPaiChart End
            // Line Chart  #flotLine5
            var newCust = [[0, 3], [1, 5], [2, 4], [3, 7], [4, 9], [5, 3], [6, 6], [7, 4], [8, 10]];

            var plot = $.plot($('#flotLine5'), [{
                data: newCust,
                label: 'New Data Flow',
                color: '#fff'
            }],
                {
                    series: {
                        lines: {
                            show: true,
                            lineColor: '#fff',
                            lineWidth: 2
                        },
                        points: {
                            show: true,
                            fill: true,
                            fillColor: "#ffffff",
                            symbol: "circle",
                            radius: 3
                        },
                        shadowSize: 0
                    },
                    points: {
                        show: true,
                    },
                    legend: {
                        show: false
                    },
                    grid: {
                        show: false
                    }
                });
            // Line Chart  #flotLine5 End
            // Traffic Chart using chartist
            if ($('#traffic-chart').length) {
                var chart = new Chartist.Line('#traffic-chart', {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                    series: [
                        [0, 18000, 35000, 25000, 22000, 0],
                        [0, 33000, 15000, 20000, 15000, 300],
                        [0, 15000, 28000, 15000, 30000, 5000]
                    ]
                }, {
                    low: 0,
                    showArea: true,
                    showLine: false,
                    showPoint: false,
                    fullWidth: true,
                    axisX: {
                        showGrid: true
                    }
                });

                chart.on('draw', function (data) {
                    if (data.type === 'line' || data.type === 'area') {
                        data.element.animate({
                            d: {
                                begin: 2000 * data.index,
                                dur: 2000,
                                from: data.path.clone().scale(1, 0).translate(0, data.chartRect.height()).stringify(),
                                to: data.path.clone().stringify(),
                                easing: Chartist.Svg.Easing.easeOutQuint
                            }
                        });
                    }
                });
            }
            // Traffic Chart using chartist End
            //Traffic chart chart-js
            if ($('#TrafficChart').length) {
                var ctx = document.getElementById("TrafficChart");
                ctx.height = 150;
                var myChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul"],
                        datasets: [
                            {
                                label: "Visit",
                                borderColor: "rgba(4, 73, 203,.09)",
                                borderWidth: "1",
                                backgroundColor: "rgba(4, 73, 203,.5)",
                                data: [0, 2900, 5000, 3300, 6000, 3250, 0]
                            },
                            {
                                label: "Bounce",
                                borderColor: "rgba(245, 23, 66, 0.9)",
                                borderWidth: "1",
                                backgroundColor: "rgba(245, 23, 66,.5)",
                                pointHighlightStroke: "rgba(245, 23, 66,.5)",
                                data: [0, 4200, 4500, 1600, 4200, 1500, 4000]
                            },
                            {
                                label: "Targeted",
                                borderColor: "rgba(40, 169, 46, 0.9)",
                                borderWidth: "1",
                                backgroundColor: "rgba(40, 169, 46, .5)",
                                pointHighlightStroke: "rgba(40, 169, 46,.5)",
                                data: [1000, 5200, 3600, 2600, 4200, 5300, 0]
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        tooltips: {
                            mode: 'index',
                            intersect: false
                        },
                        hover: {
                            mode: 'nearest',
                            intersect: true
                        }

                    }
                });
            }
            //Traffic chart chart-js  End
            // Bar Chart #flotBarChart
            $.plot("#flotBarChart", [{
                data: [[0, 18], [2, 8], [4, 5], [6, 13], [8, 5], [10, 7], [12, 4], [14, 6], [16, 15], [18, 9], [20, 17], [22, 7], [24, 4], [26, 9], [28, 11]],
                bars: {
                    show: true,
                    lineWidth: 0,
                    fillColor: '#ffffff8a'
                }
            }], {
                grid: {
                    show: false
                }
            });
            // Bar Chart #flotBarChart End
        });

        // Menu Trigger
$('#menuToggle').on('click', function(event) {
  var windowWidth = $(window).width();   		 
  if (windowWidth<1010) { 
    $('body').removeClass('open'); 
    if (windowWidth<760){ 
      $('#left-panel').slideToggle(); 
    } else {
      $('#left-panel').toggleClass('open-menu');  
    } 
  } else {
    $('body').toggleClass('open');
    $('#left-panel').removeClass('open-menu');  
  } 
     
}); 

 
$(".menu-item-has-children.dropdown").each(function() {
  $(this).on('click', function() {
    var $temp_text = $(this).children('.dropdown-toggle').html();
    $(this).children('.sub-menu').prepend('<li class="subtitle">' + $temp_text + '</li>'); 
  });
});
    </script>