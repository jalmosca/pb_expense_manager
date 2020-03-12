@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Expenses</div>

                <div class="card-body">

                    <div id="piechart"></div>


                    <div class="container table-responsive">
                        
                        <table class="table table-striped table-bordered">
                            @foreach($categories as $category)
                            <tr>
                                <td>
                                    <h5 class="categoryname" id="{{ $category->name }}">{{ $category->name }}</h5>
                                </td>
                                <td>
                                    <h5 id="{{ $category->name }}total"> &#8369; {{  number_format($category->total,2) }}</h5>
                                    <span class="categorytotal d-none">{{  $category->total }}</span>
                                </td>
                            </tr>
                            @endforeach
                        </table>

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
// Load google charts
google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);

// Draw the chart and set the chart values
function drawChart() {
    var allcategoryname = document.getElementsByClassName("categoryname");
    var allcategorytotal = document.getElementsByClassName("categorytotal");
    console.log("allcategoryname");
    console.log(allcategoryname);   
//   var data = google.visualization.arrayToDataTable([
//   ['Task', 'Hours per Day'],
//   ['Work', 8],
//   ['Eat', 2],
//   ['TV', 4],
//   ['Gym', 2],
//   ['Sleep', 8]
// ]);
    var categoryArray = [["Expense Category" , "Total"]];
    for (var i = 0; i < allcategoryname.length; i++) {
        // categoryArray.push([i])
        var percategorytotal = parseInt(allcategorytotal[i].innerHTML)
        categoryArray.push([ allcategoryname[i].innerHTML , percategorytotal]);
        // categoryArray[i][0] =  allcategoryname[i].innerHTML;
        // categoryArray[i][1] =  allcategorytotal[i].innerHTML;
    }
    console.log("categoryArray")
    console.log(categoryArray)
  var data = google.visualization.arrayToDataTable(categoryArray);


  // Optional; add a title and set the width and height of the chart
  var options = {'title':'My Average Day', 'width':550, 'height':400};

  // Display the chart inside the <div> element with id="piechart"
  var chart = new google.visualization.PieChart(document.getElementById('piechart'));
  chart.draw(data, options);
}
</script>
@endsection
