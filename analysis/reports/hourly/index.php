<?php

require_once '../../lib/php/ServerIO.php';

try
{
    $io = new ServerIO();
    $initiatives = $io->getInitiatives();
}
catch (Exception $e)
{
    echo $e->getMessage();
    die;
}

$initDropDown = '<select name="id" id="initiatives" class="form-control">';
$initDropDown .= '<option value="' . 'default' . '">' . 'Select an Initiative' . '</option>' . "\n";
foreach($initiatives as $init)
{
    $initDropDown .= '<option value="' . $init['id'] . '">' . $init['title'] . '</option>' . "\n";
}

$initDropDown .= '</select>';
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Suma Reports | Hourly</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link href="../../lib/css/bootstrap.min.css" rel="stylesheet">
        <link href="../../lib/css/bootstrap-theme.min.css" rel="stylesheet">
        <link href="../../lib/css/datepicker.css" rel="stylesheet">
        <link href="../../lib/css/non-responsive.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet"  />

        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
          <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
    </head>

    <body>
        <div class="navbar navbar-default navbar-fixed-top">
            <div class="container">
                <a class="navbar-brand" href=".."><img src="../../lib/img/logo.png"></a>
                <ul class="nav navbar-nav">
                    <li><a href="..">Home</a></li>
                    <li><a href="../about.html">About</a></li>
                    <li><a href="../contact.html">Contact</a></li>
                </ul>
            </div>
        </div>

        <div id="main" class="container">
            <div id="calendar-header" class="row">
                <div class="col-xs-12">
                    <div id="error-container"></div>
                    <div id ="welcome" class="alert alert-info alert-block">
                        <h4>Welcome!</h4>
                            Please select an initiative from the select menu below. Once you have chosen an initiative, additional filter options will appear. You can also limit your search by date or time.
                    </div>
                    <div id="loading"><img src="../../lib/img/spinner.gif"></div>
                    <div id="controls" class="pull-right">
                        <a id="line-download" download="suma_hourly_line_chart.png" data-chart-div="chart2" class="btn btn-default btn-sm" target="_blank">Save Line Chart</a>
                        <a id="calendar-download" download="suma_hourly_calendar_chart.png" data-chart-div="chart" class="btn btn-default btn-sm" target="_blank">Save Calendar Chart</a>
                        <a id="csv" download="suma_data_export.csv" class="btn btn-default btn-sm suma-popover" href="" rel="popover">Export Raw Data</a>
                        <div id="avg-sum" class="btn-group" data-toggle="buttons">
                            <label for="avgDays" class="btn btn-default btn-sm" data-state="avgDays">
                                <input type="radio" name="chart-state" id="avgDays" value="avgDays">Avg per Day
                            </label>
                            <label for="avg" class="btn btn-default btn-sm" data-state="avg">
                                <input type="radio" name="chart-state" id="avg" value="avg">Avg of Counts
                            </label>
                            <label for="sum" class="btn btn-default btn-sm active" data-state="sum">
                                <input type="radio" name="chart-state" id="sum" value="sum">Sum
                            </label>
                        </div>
                    </div>
                    <div id="chart2"></div>
                    <div id="chart"></div>
                </div>
            </div>

            <div id="filters" class="row">
                <form id="chartFilters">
                    <fieldset>
                        <div class="col-xs-12">
                            <div class="row">
                                <div class="col-xs-3">
                                    <h3>Modify Chart</h3>
                                </div>
                                <div class="col-xs-3 secondary-filters">
                                    <h3>Initiative Filters</h3>
                                </div>
                                <div class="col-xs-6 summary">
                                    <h3>Summary Statistics</h4>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-3">
                                    <div class="form-group">
                                        <label for="initiatives" class="suma-popover" data-title="Select Initiative" data-content="Select an initiative to reveal additional filters.">Select an Initiative</label>
                                        <?php echo $initDropDown; ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="sdate" class="suma-popover" data-title="Choose Date Range" data-content="Select a start date for your analysis. Defaults to 6 months from current day. Clear fields to retrieve the complete data set.">Start Date</label>
                                        <input type="text" id="sdate" name="sdate" class="form-control"/>
                                        <span class="help-block">YYYY-MM-DD</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="edate" class="suma-popover" data-title="Choose Date Range" data-content="Select an end date for your analysis. Clear fields to retrieve complete data set.">End Date</label>
                                        <input type="text" id="edate" name="edate" class="form-control" />
                                        <span class="help-block">YYYY-MM-DD</span>
                                    </div>
                                </div>
                                <div class="col-xs-3 secondary-loading">
                                    <img id="secondary-spinner" src="../../lib/img/spinner.gif">
                                </div>
                                <div class="col-xs-3 secondary-filters">
                                    <div class="form-group">
                                        <label for="daygroup" class="suma-popover" data-title="Limit Days of the Week" data-content="Filter by Weekday or Weekend.">Limit Days of the Week</label>
                                        <select name="daygroup" id="daygroup" class="form-control">
                                            <option value="all">All</option>
                                            <option value="weekdays">Weekdays Only</option>
                                            <option value="weekends">Weekends Only</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="locations" class="suma-popover" data-title="Limit Locations" data-content="Select which locations to include in your analysis. Selecting a location with children will include all children in the data set.">Limit Locations</label>
                                        <select name="locations" id="locations" class="form-control"></select>
                                    </div>
                                    <div class="form-group">
                                        <label for="activities" class="suma-popover" data-title="Limit Activities" data-content="Select which activities to include in your analysis. Selecting an Activity Group will include all group activities.">Limit Activities</label>
                                        <select name="activities" id="activities" class="form-control"></select>
                                    </div>
                                     <div>
                                        <input type="submit" id="submit" class="btn btn-success" data-default-text ="Submit" data-loading-text="Loading..." value="Submit" />
                                    </div>
                                </div>
                                <div class="col-xs-6 summary">
                                    <table class="table table-hover table-condensed">
                                        <tbody>
                                                <tr>
                                                    <td>Quartiles</td>
                                                    <td id="quartile"></td>
                                                </tr>
                                                <tr>
                                                    <td>Interquartile Range</td>
                                                    <td id="iqr"></td>
                                                </tr>
                                                <tr>
                                                    <td>Lower Outlier Threshold</td>
                                                    <td id="lot"></td>
                                                </tr>
                                                <tr>
                                                    <td>Upper Outlier Threshold</td>
                                                    <td id="uot"></td>
                                                </tr>
                                                <tr>
                                                    <td>Median</td>
                                                    <td id="median"></td>
                                                </tr>
                                        </tbody>
                                    </table>
                                </div>


                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>

        <!-- Templates -->
        <script id="locations-template" type="text/x-handlebars-template">
            <option value="all">All</option>
            {{#each items}}
                <option value="{{id}}">{{indent depth}}{{{title}}}</option>
            {{/each}}
        </script>
        <script id="activities-template" type="text/x-handlebars-template">
            <option value="all">All</option>
            {{#each items}}
                <option value="{{type}}-{{id}}">{{indent depth}}{{{title}}}</option>
            {{/each}}
        </script>
        <script id="error" type="text/x-handlebars-template">
            <div class="alert alert-danger alert-block">
                <h4>Warning!</h4>
                <p>There was a problem retrieving data from the server. Please try again or contact your system administrator.</p>
                {{#each items}}
                    <p>Error Message: {{msg}}</p>
                {{/each}}
            </div>
        </script>

        <!-- Libraries -->
        <script src="../../lib/js/jquery.min.js"></script>
        <script src="../../lib/js/bootstrap.min.js"></script>
        <script src="../../lib/js/bootstrap-datepicker.js"></script>
        <script src="../../lib/js/handlebars.js"></script>
        <script src="../../lib/js/d3.v3.min.js"></script>
        <script src="../../lib/js/lodash.min.js"></script>
        <script src="../../lib/js/moment.js"></script>
        <script src="../../lib/js/canvg.js"></script>

        <!-- Suma Modules -->
        <script src="../../lib/js/Errors.js"></script>
        <script src="../../lib/js/ReportFilters.js"></script>
        <script src="../../lib/js/HourlyLine.js"></script>
        <script src="../../lib/js/HourlyCalendar.js"></script>

        <!-- App -->
        <script src="js/app.js"></script>

    </body>
</html>