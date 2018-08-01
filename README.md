# pigeon-chart
A dynamic tool to display mysql results in chart form in complement to Highcharts framework.

# Basic Setup
1. Copy this tool into your project root directory then inject our module name *data-ng-app="pigeon-chart"* under HTML tag.
![module name](https://user-images.githubusercontent.com/26452088/36463226-7695f2ac-1703-11e8-8f79-b199da55aa2f.PNG)
 
Make sure you include Pigeon Core, Pigeon Chart, AngularJS, Underscore, Highcharts and Highcharts related JavaScript files under head tag of your project. Take note of the sequences of the files you have included. jQuery, AngularJS, Highcharts and Underscore must be loaded before Pigeon Chart JavaScript.
<br />
![js links](https://user-images.githubusercontent.com/26452088/43463507-4dec42f8-950b-11e8-8dc6-971d70a7cac1.PNG)
  
If your website is running on PHP, you can just insert the "includes.php" file into your PHP project instead of inserting JS file one by one. "includes.php" file is located under "pigeon-chart/php" folder.
<br />
![php includes](https://user-images.githubusercontent.com/26452088/36463203-45f03cac-1703-11e8-891e-a4efda405f02.PNG)

*Note: For having a best experience with our framework, the versions of AngularJS, Highcharts related and Underscore frameworks that we are currently using are as follows:
<br />
-AngularJs v1.6.4
<br />
-Underscore v1.8.3
<br />
-grouped-categories (Highcharts related) v1.1.2

Configure your MySQL hostname, username, password and the database in the "pigeon-core/configdb.php". This PHP must be configured properly in order to communicate with MySQL server.
<br />
![configure db](https://user-images.githubusercontent.com/26452088/43495491-fdad5e3e-956a-11e8-8db5-7cd4bbe74e65.PNG)

# Include pigeon-chart HTML tag
In order to display data in different chart forms whereby on your choice, Pigeon Chart supports 6 chart types: Line, Pie, Column, Bar, Area and Spline. You are required to insert the MySQL query command to retrieve the data from mySQL database. Pigeon chart supports data visualization with 6 different SQL patterns as shown below.
<br />
SQL Patterns
<br />
-SELECT 
-SELECT [x-axis], [y-axis] FROM *table*;
<br />
-SELECT [x-axis], [y-axis-series-1], [y-axis-series-2], [y-axis-series-3] … FROM *table*;
<br />
-SELECT [x-axis], AGG_FUNC([y-axis]) FROM *table* GROUP BY [x-axis];
<br />
-SELECT [series], value (agg/non agg) FROM *table*;
<br />
-SELECT [x-axis], AGG_FUNC([y-axis-series-1]), AGG_FUNC([y-axis-series-2]), … FROM *table* GROUP BY [x-axis];
<br />
-SELECT [x-axis-1], [x-axis-2],… , AGG_FUNC([y-axis-series-1]), AGG_FUNC([y-axis-series-2]), … FROM *table* GROUP BY [x-axis-1], [x-axis-2],…;

<table>
    <tr>
        <th>Attributes</th>
        <th>Description</th>
        <th>Remarks</th>
    </tr>
    <tr>
        <td><strong>query</strong></td>
        <td>A placeholder to specify SQL Select Statement. </td>
        <td>Mandatory</td>
    </tr>
    <tr>
        <td><strong>type</strong></td>
        <td>Defines the type of the charts. Possible value are line, spline, column, bar, pie and area. </td>
        <td>Optional</td>
    </tr>
    <tr>
        <td><strong>title</strong></td>
        <td>Defines the title for the chart. </td>
        <td>Optional</td>
    </tr>
    <tr>
        <td><strong>subtitle</strong></td>
        <td>Defines the sub-title for the chart. </td>
        <td>Optional</td>
    </tr>
    <tr>
        <td><strong>axis-y-title</strong></td>
        <td>Defines the title for y-axis in the chart. </td>
        <td>Optional</td>
    </tr>
    <tr>
        <td><strong>axis-x-title</strong></td>
        <td>Defines the title for x-axis in the chart.</td>
        <td>Optional - Not applicable for pie chart</td>
    </tr>
    <tr>
        <td><strong>show-data-label</strong></td>
        <td>Sets data label to be shown or hidden with TRUE or FALSE value.  </td>
        <td>Default value: false</td>
    </tr>
    <tr>
        <td><strong>show-legend</strong></td>
        <td>Shows or hides legend with FALSE as hiding legend. Possible values for different legend positions are right, left, top and bottom. </td>
        <td>Default value: right</td>
    </tr>
    <tr>
        <td><strong>zoom-type</strong></td>
        <td>Decides the dimensions the user can zoom by dragging the mouse. Possible values are x, y and xy. </td>
        <td>Optional - Not applicable for pie chart</td>
    </tr>
</table>

![pigeon html tag](https://user-images.githubusercontent.com/26452088/43463772-02d6224c-950c-11e8-9897-2ee960732fa9.PNG)

# Chart Display (with examples)
The data will be displayed in chart form with different query and chart type stated. Pigeon Chart also supports displaying multiple charts in one page.
<br />
### 1. Basic Query 
![basic query pie](https://user-images.githubusercontent.com/26452088/43466772-d8d055ce-9512-11e8-9d2a-c2070cc9d7e2.PNG)
<br />
#### Pie
![pie ss](https://user-images.githubusercontent.com/26452088/36462406-206abd18-16fe-11e8-93f4-e70a790fe4ea.PNG)
<br />

### 2. Query with aggregated function
![query agg](https://user-images.githubusercontent.com/26452088/43467461-4fea8df4-9514-11e8-82ac-cab51b1b4f17.PNG)

#### Column
![agg column](https://user-images.githubusercontent.com/26452088/43467618-aadecdc4-9514-11e8-8955-f3588fe92078.png)

### 3. Multi-series
![multi-series line](https://user-images.githubusercontent.com/26452088/43467366-25253e52-9514-11e8-831c-267f6f8f24b0.PNG)

#### Line
![multi-series line ss](https://user-images.githubusercontent.com/26452088/36462626-7e924fe0-16ff-11e8-86cb-9661dcbc6739.PNG)

#### Area
![multy-series area ss](https://user-images.githubusercontent.com/26452088/43466524-4bc5157a-9512-11e8-9cef-8ac81eadbae6.PNG)

### 4. Multi-series with multi-level grouping
![aggregated function query column ss](https://user-images.githubusercontent.com/26452088/43467773-13f2183e-9515-11e8-98a7-236b769e24dd.PNG)

#### Column
![aggregated function query column](https://user-images.githubusercontent.com/26452088/43467810-24d25ea2-9515-11e8-9c3b-d37e1430592a.png)
