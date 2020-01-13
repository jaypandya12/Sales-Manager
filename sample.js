$(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
            });
        });
$(document).ready(function () {
            $('#navigateSidebar').on('click', function () {
                $('#sidebar').toggleClass('active');
            });
        });
$('.sidebarlink').click(function() {
    $('.sidebarlink').css({
        'background-color': '#7386D5',
        'color': 'white'
        // 'font-size': '44px'
    });
    $(this).css({
        'background-color': 'white',
        'color': '#7386D5'
        // 'font-size': '44px'
    });
});
    var today = new Date();
            var dd = today.getDate();
            var mm = today.getMonth()+1; //January is 0!
            var yyyy = today.getFullYear();
             if(dd<10){
                    dd='0'+dd
                }
                    if(mm<10){
                    mm='0'+mm
                } 

            today = yyyy+'-'+mm+'-'+dd;
       function generateinvoice() {
        	// $(this).closest('li').css('background-color', 'white');
            document.getElementById('getid').style.display="none";
            document.getElementById('getdate').style.display="none";
            document.getElementById('getdates').style.display="none";
            // document.getElementById('showamount').style.display="none";
            $('#showamount').html('');
            $.ajax({
            type: "POST",
            url: "customerform.php",
            success: function(html) {
            $('#showresult').html(html);
            }
            });
        }
        function addproductindb() {
            $(document).ready(function() {
                $(".various").fancybox({
                    maxWidth    : 800,
                    maxHeight   : 700,
                    fitToView   : false,
                    width       : '70%',
                    height      : '70%',
                    autoSize    : false,
                    closeClick  : false,
                    openEffect  : 'none',
                    closeEffect : 'none'
                });
            });
        }
        function stockupdate() {
            document.getElementById('getid').style.display="none";
            document.getElementById('getdate').style.display="none";
            document.getElementById('getdates').style.display="none";
            // document.getElementById('showamount').style.display="none";
            $('#showresult').html('');
            $('#showamount').html('');
            $.ajax({
            type: "POST",
            url: "stockupdate.php",
            data: {invoiceid: $('#invoiceid').val()},
            success: function(html) {
            $('#showresult').html(html);
            }
            });

        }
        function showinvoice(){
            document.getElementById('getid').style.display="inline";
            document.getElementById('getdate').style.display="none";
            document.getElementById('getdates').style.display="none";
            // document.getElementById('showamount').style.display="none";
            $('#showresult').html('');
            $('#showamount').html('');
        }
        function showreport(){
        	document.getElementById('getdates').style.display="none";
            document.getElementById('getdate').style.display="inline";
            document.getElementById('getid').style.display="none";
            // document.getElementById('showamount').innerHTML="";
            $('#showresult').html('');
            $('#showamount').html('');
        }
        function getreport(){
        	document.getElementById('getdate').style.display="none";
            document.getElementById('getdates').style.display="inline";
            document.getElementById('getid').style.display="none";
            // document.getElementById('showamount').innerHTML="";
            $('#showresult').html('');
            $('#showamount').html('');
        }
        function customerdetail(){
            document.getElementById('getid').style.display="none";
            document.getElementById('getdate').style.display="none";
            document.getElementById('getdates').style.display="none";
            $('#showresult').html('');
            $('#showamount').html('');
            $.ajax({
            type: "POST",
            url: "invoice.php",
            data: {counter: 'customerdetail'},
            success: function(html) {
            $('#showresult').html(html);
            }
            });
        }
        function categorydetail(){
            document.getElementById('getid').style.display="none";
            document.getElementById('getdate').style.display="none";
            document.getElementById('getdates').style.display="none";
            $('#showresult').html('');
            $('#showamount').html('');
            $.ajax({
            type: "POST",
            url: "invoice.php",
            data: {counter: 'categorydetail'},
            success: function(html) {
            $('#showresult').html(html);
            }
            });
        }
        function productdetail(){
            document.getElementById('getid').style.display="none";
            document.getElementById('getdate').style.display="none";
            document.getElementById('getdates').style.display="none";
            $('#showresult').html('');
            $('#showamount').html('');
            $.ajax({
            type: "POST",
            url: "invoice.php",
            data: {counter: 'productdetail'},
            success: function(html) {
            $('#showresult').html(html);
            }
            });
        }
        function generatebarcode(){
        	document.getElementById('getid').style.display="none";
            document.getElementById('getdate').style.display="none";
            document.getElementById('getdates').style.display="none";
            // document.getElementById('showamount').style.display="none";
            $('#showamount').html('');
            $.ajax({
            type: "POST",
            url: "generatebarcode.php",
            success: function(html) {
            $('#showresult').html(html);
            }
            });
        }

    $('#getinvoice').click(function() {
            $.ajax({
            type: "POST",
            url: "invoice.php",
            data: {invoiceid: $('#getinvoiceid').val()},
            success: function(html) {
            $('#showresult').html(html);
            $.ajax({
            type: "POST",
            url: "invoice.php",
            data: { invoiceid: $('#getinvoiceid').val(),
                    counter: "invoiceamount"},
            success: function(getAmount) {
            $('#showamount').html("Total Billing Amount: "+getAmount);
            }
            });
            }
            });


    });
    $('#getreport').click(function() {
            if(document.getElementById('dateofpurchase').value>today){
                alert("Invalid Final Date");
                return false;
            }
            $.ajax({
            type: "POST",
            url: "invoice.php",
            data: { date: $('#dateofpurchase').val()},
            success: function(html) {
            $('#showresult').html(html);
            $.ajax({
            type: "POST",
            url: "invoice.php",
            data: { date: $('#dateofpurchase').val(),
                    counter: "dateamount"},
            success: function(getAmount) {
            $('#showamount').html("Total Sales: "+getAmount);
            }
            });
            }
            });
        });
    $('#getfinalreport').click(function() {
            if(document.getElementById('dateofpurchase1').value>today){
                alert("Invalid Initial Date");
                return false;
            }
            if(document.getElementById('dateofpurchase2').value>today){
                alert("Invalid Final Date");
                return false;
            }
            $.ajax({
            type: "POST",
            url: "invoice.php",
            data: { date1: $('#dateofpurchase1').val(),
        			date2: $('#dateofpurchase2').val()},
            success: function(html) {
            $('#showresult').html(html);
            $.ajax({
            type: "POST",
            url: "invoice.php",
            data: { date1: $('#dateofpurchase1').val(),
        			date2: $('#dateofpurchase2').val(),
                    counter: "dateamount"},
            success: function(getAmount) {
            $('#showamount').html("Total Sales: "+getAmount);
            }
            });
            }
            });
        });
    $('.numericvalidation').keydown(function(event) {
    var allow=[8,32,9,17,46,37,38,39,40,96,97,98,99,100,101,102,103,104,105];
    if(allow.includes(event.keyCode)){

    }
    else if(event.keyCode<48 || event.keyCode>57){
        event.preventDefault();
    }
});
document.getElementById("dateofpurchase").setAttribute("max", today);
document.getElementById("dateofpurchase1").setAttribute("max", today);
document.getElementById("dateofpurchase2").setAttribute("max", today);