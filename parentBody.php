
<?php

echo "
        <div id='panelItemsContainer' class='container-fluid padding20'>

<div style='margin-left:40%;' class='controlPanelItem'>
        <div id='innerShowBusesFamily' class='centerElement'>
            <span class='glyphicon glyphicon-bed'></span>
            <br>
            <p class='pGlobalFont textAlignCenter'>Children maps</p>
        </div>
    </div>
    
    </div>
    
    
    <div class='container-fluid backColorGrey padding10'>
        <div class='container'>


            <div style='margin: 7px;min-height: 456px;' class='col-sm-6 backRgbaOnBlacks boxShadow'>
<br><br>
<div class='padding10 borderSmall'>
<div>
                <label class='pGlobalFont' for='busesList'>Buses: </label>

                <select class='boxShadow' id='busesList' name='busesList'>
                    <option value='BUS201'>BUS201</option>
                    <option value='BUS202'>BUS202</option>

                </select>
                <div class='submitDiv'>Refresh List</div><br>

</div>

                <div class='submitDiv'>Get Info</div>
              

                <div class='padding20 '>
<p  class='pGlobalFont textAlignCenter'>BUS ID: BUS201</p>
                    <p class='pGlobalFont textAlignCenter'>Phone No: +962789629404</p>
                    <p style='color:red;margin-bottom: 23px;' class='pGlobalFont textAlignCenter textShadow'>Name: Mohammed Khalil</p>

</div>




                </div>

            </div>

            <div style=\"margin: 7px;padding: 0px;\" id=\"parentsPanelBoard\" class=\"col-sm-5 boxShadow\"> <!-- MAP Container-->



            </div>


        </div>

    </div>
    
    <script src='https://maps.googleapis.com/maps/api/js?key=AIzaSyBcacGx1xEtAaYseE0M9Q3VAy5xx3bVtl0&callback=initMapParents'
        async defer></script>
";



?>